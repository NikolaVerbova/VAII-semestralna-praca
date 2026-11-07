<?php

/** @var string $contentHTML */
/** @var LinkGenerator $link */

// Aktuálna stránka (na zvýraznenie položky v menu)
use Framework\Support\LinkGenerator;

$c = strtolower($_GET['c'] ?? 'home');
$current = fn(string $controller) => $c === $controller ? ' aria-current="page"' : '';
?>
<!DOCTYPE html>
<html lang="sk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Domáca knižnica</title>
<link rel="stylesheet" href="<?= $link->asset('css/styles.css') ?>">
</head>
<body>
<header class="site-header">
  <div class="header-inner">
    <a class="brand" href="<?= $link->url('home.index') ?>">
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M12 6c-2-1.5-5-2-8-1.5v13c3-.5 6 0 8 1.5 2-1.5 5-2 8-1.5v-13C17 4 14 4.5 12 6z"/>
        <path d="M12 6v13"/>
      </svg>
      <span>Domáca knižnica</span></a>
    <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-label="Zobraziť menu">
    <label for="nav-toggle" class="nav-button">☰ Menu</label>
    <nav class="main-nav" aria-label="Hlavná navigácia">
      <ul>
        <li><a href="<?= $link->url('home.index') ?>"<?= $current('home') ?>>Domov</a></li>
        <li><a href="<?= $link->url('book.index') ?>"<?= $current('book') ?>>Katalóg kníh</a></li>
        <li><a href="<?= $link->url('room.index') ?>"<?= $current('room') ?>>Moje miestnosti</a></li>
        <li><a href="#">Moje vypožičané knihy</a></li>
        <li><a href="#">Moje hodnotenia</a></li>
        <li><a class="btn" href="#">Prihlásiť sa</a></li>
      </ul>
    </nav>
  </div>
</header>
<?= $contentHTML ?>
<footer class="site-footer">
  <div class="footer-inner">
    <p>Domáca knižnica © 2026</p>
    <p>Nikola Verbová</p>
    <p>Kontakt: <a href="mailto:verbova1@stud.uniza.sk">verbova1@stud.uniza.sk</a></p>
  </div>
</footer>
</body>
</html>
