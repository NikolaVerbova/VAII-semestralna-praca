<?php

/** @var \App\Models\Room[] $rooms */
/** @var int[] $bookCounts */
/** @var \Framework\Support\LinkGenerator $link */
?>
<main>
  <div class="page-head">
    <h1>Moje miestnosti</h1>
    <p class="subtitle">Spravujte miestnosti vo svojej domácej knižnici</p>
  </div>

  <p><a class="btn" href="<?= $link->url('room.add') ?>">+ Pridať miestnosť</a></p>

  <section class="content-box" aria-labelledby="zoznam">
    <h2 id="zoznam">Zoznam miestností (<?= count($rooms) ?>)</h2>
<?php if (count($rooms) === 0) : ?>
    <p class="empty">Zatiaľ nemáte žiadnu miestnosť.</p>
<?php else : ?>
    <div class="room-stack">
    <?php foreach ($rooms as $room) : ?>
      <article class="room-box">
        <div class="room-head">
          <h3><?= e($room->getName() ?? '') ?></h3>
          <span class="room-floor">Poschodie: <?= $room->getFloorNumber() ?></span>
          <span class="room-floor">Počet kníh: <?= $bookCounts[$room->getId()] ?? 0 ?></span>
        </div>
        <p class="room-desc"><?= e($room->getDescription() ?? 'Bez popisu') ?></p>
        <div class="room-buttons">
          <a class="btn btn-outline" href="<?= $link->url('room.edit', ['id' => $room->getId()]) ?>">Upraviť</a>
          <form method="post" action="<?= $link->url('room.delete') ?>">
            <input type="hidden" name="id" value="<?= $room->getId() ?>">
            <button class="btn btn-outline" type="submit">Zmazať</button>
          </form>
        </div>
      </article>
    <?php endforeach ?>
    </div>
<?php endif ?>
  </section>
</main>
