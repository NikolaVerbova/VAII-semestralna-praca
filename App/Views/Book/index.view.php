<main>
  <div class="page-head">
    <h1>Katalóg kníh</h1>
    <p class="subtitle">Objavte knihy vo svojej domácej knižnici</p>
  </div>

  <form class="search" action="#" role="search">
    <label for="q" class="visually-hidden">Vyhľadať podľa názvu alebo autora</label>
    <input id="q" type="search" placeholder="Vyhľadať podľa názvu alebo autora…">
    <button class="btn" type="button">Hľadať</button>
  </form>

  <div class="catalog">
    <aside aria-label="Filtre">
      <form class="filters" action="#">
        <h2>Filtre</h2>
        <div class="field">
          <label for="room">Miestnosť</label>
          <select id="room"><option>Všetky miestnosti</option><option>Obývačka</option><option>Detská izba</option><option>Pracovňa</option><option>Spálňa</option></select>
        </div>
        <div class="field">
          <label for="shelf">Polica</label>
          <select id="shelf"><option>Všetky police</option><option>Polica A1</option><option>Polica A2</option><option>Polica B2</option><option>Polica C1</option><option>Polica C2</option><option>Polica D1</option></select>
        </div>
        <fieldset class="field-wide">
          <legend>Dostupnosť</legend>
          <label class="radio"><input type="radio" name="avail" checked> Všetky</label>
          <label class="radio"><input type="radio" name="avail"> Dostupné</label>
          <label class="radio"><input type="radio" name="avail"> Vypožičané</label>
        </fieldset>
        <button class="btn btn-outline btn-block" type="reset">Zrušiť filtre</button>
      </form>
    </aside>

    <section aria-label="Výsledky">
      <div class="toolbar">
        <p>Nájdené knihy: 6</p>
        <div class="sort">
          <label for="sort">Zoradiť podľa</label>
          <select id="sort"><option>Názov</option><option>Autor</option><option>Rok vydania</option></select>
          <small>Názov · Autor · Rok vydania</small>
        </div>
      </div>
      <ul class="book-grid">
        <li><article class="book-card">
          <h3>Malý princ</h3>
          <p class="author">Antoine de Saint-Exupéry</p>
          <p>Rok vydania: 1943</p>
          <p>Obývačka · Polica A1</p>
          <span class="badge">Dostupné</span>
          <a class="btn btn-outline btn-block" href="#">Detail knihy</a>
        </article></li>
        <li><article class="book-card">
          <h3>Harry Potter a Kameň mudrcov</h3>
          <p class="author">J. K. Rowlingová</p>
          <p>Rok vydania: 1997</p>
          <p>Detská izba · Polica B2</p>
          <span class="badge">Vypožičané</span>
          <a class="btn btn-outline btn-block" href="#">Detail knihy</a>
        </article></li>
        <li><article class="book-card">
          <h3>Hobit</h3>
          <p class="author">J. R. R. Tolkien</p>
          <p>Rok vydania: 1937</p>
          <p>Obývačka · Polica A2</p>
          <span class="badge">Dostupné</span>
          <a class="btn btn-outline btn-block" href="#">Detail knihy</a>
        </article></li>
        <li><article class="book-card">
          <h3>1984</h3>
          <p class="author">George Orwell</p>
          <p>Rok vydania: 1949</p>
          <p>Pracovňa · Polica C1</p>
          <span class="badge">Dostupné</span>
          <a class="btn btn-outline btn-block" href="#">Detail knihy</a>
        </article></li>
        <li><article class="book-card">
          <h3>Pýcha a predsudok</h3>
          <p class="author">Jane Austenová</p>
          <p>Rok vydania: 1813</p>
          <p>Spálňa · Polica D1</p>
          <span class="badge">Vypožičané</span>
          <a class="btn btn-outline btn-block" href="#">Detail knihy</a>
        </article></li>
        <li><article class="book-card">
          <h3>Alchymista</h3>
          <p class="author">Paulo Coelho</p>
          <p>Rok vydania: 1988</p>
          <p>Pracovňa · Polica C2</p>
          <span class="badge">Dostupné</span>
          <a class="btn btn-outline btn-block" href="#">Detail knihy</a>
        </article></li>
      </ul>
    </section>
  </div>
</main>
