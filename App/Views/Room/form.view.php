<?php

/** @var \App\Models\Room $room */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */
?>
<main>
  <div class="page-head">
    <h1><?= $room->getId() ? 'Úprava miestnosti' : 'Nová miestnosť' ?></h1>
    <p class="subtitle">Vyplňte údaje o miestnosti</p>
  </div>

<?php if (count($errors) > 0) : ?>
  <div class="alert" role="alert">
<?php foreach ($errors as $error) : ?>
    <p><?= e($error) ?></p>
<?php endforeach ?>
  </div>
<?php endif ?>

  <form class="form-panel" method="post" action="<?= $link->url('room.save') ?>">
    <input type="hidden" name="id" value="<?= $room->getId() ?>">
    <div class="field">
      <label for="name">Názov</label>
      <input id="name" name="name" type="text" maxlength="100" required
             value="<?= e($room->getName() ?? '') ?>">
    </div>
    <div class="field">
      <label for="description">Popis</label>
      <textarea id="description" name="description" maxlength="255"><?= e($room->getDescription() ?? '') ?></textarea>
    </div>
    <div class="field">
      <label for="floorNumber">Poschodie</label>
      <input id="floorNumber" name="floorNumber" type="number" step="1" required
             value="<?= e((string)$room->getFloorNumber()) ?>">
    </div>
    <div class="form-actions">
      <button class="btn" type="submit">Uložiť</button>
      <a class="btn btn-outline" href="<?= $link->url('room.index') ?>">Späť</a>
    </div>
  </form>
</main>
