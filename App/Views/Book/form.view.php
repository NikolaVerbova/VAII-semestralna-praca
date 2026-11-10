<?php

/** @var \App\Models\Book $book */
/** @var \App\Models\Room[] $rooms */
/** @var string[] $errors */
/** @var \Framework\Support\LinkGenerator $link */
?>
<main>
  <div class="page-head">
    <h1><?= $book->getId() ? 'Úprava knihy' : 'Nová kniha' ?></h1>
    <p class="subtitle">Vyplňte údaje o knihe a vyberte miestnosť, v ktorej sa nachádza</p>
  </div>

<?php if (count($errors) > 0) : ?>
  <div class="alert" role="alert">
<?php foreach ($errors as $error) : ?>
    <p><?= e($error) ?></p>
<?php endforeach ?>
  </div>
<?php endif ?>

  <form class="form-panel" method="post" action="<?= $link->url('book.save') ?>">
    <input type="hidden" name="id" value="<?= $book->getId() ?>">
    <div class="field">
      <label for="title">Názov</label>
      <input id="title" name="title" type="text" maxlength="150" required
             value="<?= e($book->getTitle() ?? '') ?>">
    </div>
    <div class="field">
      <label for="author">Autor</label>
      <input id="author" name="author" type="text" maxlength="100" required
             value="<?= e($book->getAuthor() ?? '') ?>">
    </div>
    <div class="field">
      <label for="publishYear">Rok vydania</label>
      <input id="publishYear" name="publishYear" type="number" step="1"
             value="<?= e((string)$book->getPublishYear()) ?>">
    </div>
    <div class="field">
      <label for="roomId">Miestnosť</label>
      <select id="roomId" name="roomId">
        <option value="">Bez miestnosti</option>
<?php foreach ($rooms as $room) : ?>
        <option value="<?= $room->getId() ?>"<?= $book->getRoomId() === $room->getId() ? ' selected' : '' ?>>
          <?= e($room->getName() ?? '') ?>
        </option>
<?php endforeach ?>
      </select>
    </div>
    <div class="field">
      <label for="shelf">Polica</label>
      <input id="shelf" name="shelf" type="text" maxlength="30"
             value="<?= e($book->getShelf() ?? '') ?>">
    </div>
    <div class="field">
      <label for="isAvailable">Dostupnosť</label>
      <select id="isAvailable" name="isAvailable">
        <option value="1"<?= $book->isAvailable() ? ' selected' : '' ?>>Dostupná</option>
        <option value="0"<?= $book->isAvailable() ? '' : ' selected' ?>>Vypožičaná</option>
      </select>
    </div>
    <div class="form-actions">
      <button class="btn" type="submit">Uložiť</button>
      <a class="btn btn-outline" href="<?= $link->url('book.index') ?>">Späť</a>
    </div>
  </form>
</main>
