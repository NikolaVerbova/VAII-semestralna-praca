'use strict';

/** Odstráni diakritiku a zmení text na malé písmená (pre vyhľadávanie). */
function normalize(text) {
    return text.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim();
}

/** Jedna kniha v katalógu – drží dáta z data-* atribútov a svoj DOM prvok. */
class Book {
    constructor(element) {
        const data = element.dataset;
        this.element = element;
        this.title = data.title ?? '';
        this.author = data.author ?? '';
        this.year = data.year ? parseInt(data.year, 10) : null;
        this.room = data.room ?? '';
        this.shelf = data.shelf ?? '';
        this.available = data.available === '1';
        this.searchText = normalize(`${this.title} ${this.author}`);
    }

    matches(filters) {
        if (filters.query && !this.searchText.includes(filters.query)) return false;
        if (filters.room && this.room !== filters.room) return false;
        if (filters.shelf && this.shelf !== filters.shelf) return false;
        if (filters.availability === 'available' && !this.available) return false;
        if (filters.availability === 'borrowed' && this.available) return false;
        return true;
    }

    setVisible(visible) {
        this.element.style.display = visible ? '' : 'none';
    }
}

/** Riadi filtrovanie, triedenie a vykresľovanie katalógu kníh. */
class BookCatalog {
    constructor() {
        this.grid = document.querySelector('.book-grid');
        this.books = [...this.grid.children].map((li) => new Book(li));
        this.collator = new Intl.Collator('sk');

        this.searchForm = document.querySelector('form.search');
        this.searchInput = document.getElementById('q');
        this.filterForm = document.querySelector('form.filters');
        this.roomSelect = document.getElementById('room');
        this.shelfSelect = document.getElementById('shelf');
        this.sortSelect = document.getElementById('sort');
        this.counter = document.getElementById('result-count');
        this.noResults = document.getElementById('no-results');

        this.shelvesByRoom = this.buildShelfMap();
        this.bindEvents();
        this.update();
    }

    /** Zistí, ktoré police sa nachádzajú v ktorej miestnosti (z dát kníh). */
    buildShelfMap() {
        const map = new Map();
        for (const book of this.books) {
            if (!map.has(book.room)) map.set(book.room, new Set());
            map.get(book.room).add(book.shelf);
        }
        return map;
    }

    bindEvents() {
        //this.searchInput.addEventListener('input', () => this.update());
        this.searchInput.addEventListener('input', () => { if (this.searchInput.value === '') this.update();});
        this.searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            this.update();
        });
        this.searchForm.querySelector('button').addEventListener('click', () => this.update());

        this.roomSelect.addEventListener('change', () => {
            this.updateShelfOptions();
            this.update();
        });
        this.filterForm.addEventListener('change', () => this.update());
        this.filterForm.addEventListener('reset', () => {
            // reset formulára prebehne až po udalosti, preto setTimeout
            setTimeout(() => {
                this.searchInput.value = '';
                this.updateShelfOptions();
                this.update();
            }, 0);
        });
        this.sortSelect.addEventListener('change', () => this.update());
    }

    /** Zobrazí v zozname políc len tie, ktoré patria do vybranej miestnosti. */
    updateShelfOptions() {
        const allowed = this.shelvesByRoom.get(this.roomSelect.value);
        for (const option of this.shelfSelect.options) {
            if (option.value === '') continue;
            const visible = !this.roomSelect.value || (allowed && allowed.has(option.value));
            option.hidden = !visible;
            option.disabled = !visible;
        }
        const selected = this.shelfSelect.selectedOptions[0];
        if (selected && selected.disabled) this.shelfSelect.value = '';
    }

    readFilters() {
        const availability = this.filterForm.querySelector('input[name="avail"]:checked');
        return {
            query: normalize(this.searchInput.value),
            room: this.roomSelect.value,
            shelf: this.shelfSelect.value,
            availability: availability ? availability.value : 'all',
        };
    }

    compare(a, b, key) {
        if (key === 'year') {
            if (a.year === null && b.year === null) return 0;
            if (a.year === null) return 1;   // knihy bez roku idú na koniec
            if (b.year === null) return -1;
            return a.year - b.year;
        }
        return this.collator.compare(a[key], b[key]);
    }

    /** Prepočíta zobrazenie: filtrovanie, triedenie, počítadlo. */
    update() {
        const filters = this.readFilters();
        const key = this.sortSelect.value;
        const sorted = [...this.books].sort((a, b) => this.compare(a, b, key));

        let visibleCount = 0;
        for (const book of sorted) {
            const visible = book.matches(filters);
            book.setVisible(visible);
            this.grid.appendChild(book.element); // zmení poradie v DOM
            if (visible) visibleCount++;
        }

        this.counter.textContent = visibleCount;
        this.noResults.style.display = visibleCount === 0 ? '' : 'none';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // bez kníh sa nevykreslí .book-grid, a teda nie je čo filtrovať
    if (document.querySelector('.book-grid')) new BookCatalog();
});