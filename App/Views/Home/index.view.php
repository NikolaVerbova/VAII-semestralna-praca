<?php /** @var \Framework\Support\LinkGenerator $link */ ?>
<main>
  <div class="page-head">
    <h1>Vitajte v domácej knižnici</h1>
    <p class="subtitle">Majte svoje knihy prehľadne usporiadané na jednom mieste.</p>
  </div>
  <section class="content-box" aria-labelledby="obsah">
    <h2 id="obsah">Obsah stránky</h2>
    <div class="tiles">
      <a class="tile" href="<?= $link->url('book.index') ?>">Katalóg kníh</a>
      <a class="tile" href="#">Moje police</a>
      <a class="tile" href="#">Vypožičané knihy</a>
    </div>
  </section>
</main>
