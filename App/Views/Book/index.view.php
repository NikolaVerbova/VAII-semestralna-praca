<?php

/** @var \App\Models\Book[] $books */
/** @var \App\Models\Room[] $rooms */
/** @var \Framework\Support\LinkGenerator $link */
?>
<main>
    <div class="page-head">
        <h1>Katalóg kníh</h1>
        <p class="subtitle">Objavte knihy vo svojej domácej knižnici</p>
    </div>

    <p><a class="btn" href="<?= $link->url('book.add') ?>">+ Pridať knihu</a></p>

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
                    <select id="room">
                        <option value="">Všetky miestnosti</option> <!-- JS: value="" -->
                        <option>Obývačka</option>
                        <option>Detská izba</option>
                        <option>Pracovňa</option>
                        <option>Spálňa</option>
                    </select>
                </div>
                <div class="field">
                    <label for="shelf">Polica</label>
                    <select id="shelf">
                        <option value="">Všetky police</option> <!-- JS: value="" -->
                        <option>Polica A1</option>
                        <option>Polica A2</option>
                        <option>Polica B2</option>
                        <option>Polica C1</option>
                        <option>Polica C2</option>
                        <option>Polica D1</option>
                    </select>
                </div>
                <fieldset class="field-wide">
                    <legend>Dostupnosť</legend>
                    <!-- JS: pridané value -->
                    <label class="radio"><input type="radio" name="avail" value="all" checked> Všetky</label>
                    <label class="radio"><input type="radio" name="avail" value="available"> Dostupné</label>
                    <label class="radio"><input type="radio" name="avail" value="borrowed"> Vypožičané</label>
                </fieldset>
                <button class="btn btn-outline btn-block" type="reset">Zrušiť filtre</button>
            </form>
        </aside>

        <section aria-label="Výsledky">
            <div class="toolbar">
                <p>Nájdené knihy: <span id="result-count"><?= count($books) ?></span></p> <!-- JS: span -->
                <div class="sort">
                    <label for="sort">Zoradiť podľa</label>
                    <!-- JS: pridané value -->
                    <select id="sort"><option value="title">Názov</option><option value="author">Autor</option><option value="year">Rok vydania</option></select>
                    <small>Názov · Autor · Rok vydania</small>
                </div>
            </div>
            <?php if (count($books) === 0) : ?>
                <p class="empty">V knižnici zatiaľ nie je žiadna kniha.</p>
            <?php else : ?>
                <ul class="book-grid">
                    <?php foreach ($books as $book) : ?>
                        <?php $roomId = $book->getRoomId();
                        $room = $roomId !== null ? ($rooms[$roomId] ?? null) : null; ?>
                        <!-- JS: data-* atribúty na <li> -->
                        <li data-title="<?= e($book->getTitle() ?? '') ?>"
                            data-author="<?= e($book->getAuthor() ?? '') ?>"
                            data-year="<?= $book->getPublishYear() ?? '' ?>"
                            data-room="<?= e($room?->getName() ?? '') ?>"
                            data-shelf="<?= e($book->getShelf() ?? '') ?>"
                            data-available="<?= $book->isAvailable() ? '1' : '0' ?>">
                            <article class="book-card">
                                <h3><?= e($book->getTitle() ?? '') ?></h3>
                                <p class="author"><?= e($book->getAuthor() ?? '') ?></p>
                                <p>Rok vydania: <?= $book->getPublishYear() ?? '—' ?></p>
                                <p><?= e($room?->getName() ?? 'Bez miestnosti') ?> · <?= e($book->getShelf() ?? 'bez police') ?></p>
                                <span class="badge"><?= $book->isAvailable() ? 'Dostupné' : 'Vypožičané' ?></span>
                                <div class="book-buttons">
                                    <a class="btn btn-outline" href="<?= $link->url('book.edit', ['id' => $book->getId()]) ?>">Upraviť</a>
                                    <form method="post" action="<?= $link->url('book.delete') ?>">
                                        <input type="hidden" name="id" value="<?= $book->getId() ?>">
                                        <button class="btn btn-outline" type="submit">Zmazať</button>
                                    </form>
                                </div>
                            </article></li>
                    <?php endforeach ?>
                </ul>
                <!-- JS: správa, keď filtre nič nenájdu -->
                <p class="empty" id="no-results" style="display:none">Žiadna kniha nezodpovedá zadaným filtrom.</p>
            <?php endif ?>
        </section>
    </div>
</main>
<!-- JS: načítanie skriptu -->
<script src="<?= $link->asset('js/catalog.js') ?>" defer></script>
