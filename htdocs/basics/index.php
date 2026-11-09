<?php
declare(strict_types=1);

$base = __DIR__;
$files = [];
foreach (glob($base . '/*.php') ?: [] as $path) {
    $name = basename($path);
    if ($name === 'index.php') {
        continue;
    }
    $files[$name] = filesize($path);
}
ksort($files);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Basics · PHP</title>
<style>
  :root { color-scheme: dark; }
  * { box-sizing: border-box; }
  body {
    margin: 0; min-height: 100vh; padding: 3rem 1.5rem;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
    background: radial-gradient(1200px 600px at 20% -10%, #1e3a5f 0%, #0b1220 55%, #070b14 100%);
    color: #e6edf7;
  }
  main { max-width: 860px; margin: 0 auto; }
  .back { color: #8fa3bf; text-decoration: none; font-size: .85rem; }
  .back:hover { color: #cbd8ea; }
  h1 { font-size: clamp(1.5rem, 4vw, 2.2rem); margin: .8rem 0 .3rem; letter-spacing: -.02em; }
  .sub { color: #8fa3bf; margin: 0 0 2rem; font-size: .9rem; }
  ul { list-style: none; padding: 0; margin: 0; display: grid; gap: .6rem; }
  a.item {
    display: flex; justify-content: space-between; align-items: center; gap: 1rem;
    text-decoration: none; color: inherit; padding: .95rem 1.1rem;
    background: linear-gradient(180deg, #131f33 0%, #101a2b 100%);
    border: 1px solid #22304a; border-radius: 12px;
    transition: transform .15s ease, border-color .15s ease;
  }
  a.item:hover { transform: translateX(3px); border-color: #3b82f6; }
  code { font-size: .92rem; }
  .size { font-size: .75rem; color: #6f88a8; white-space: nowrap; }
</style>
</head>
<body>
<main>
  <a class="back" href="../">← Todos los proyectos</a>
  <h1>Basics</h1>
  <p class="sub">Ejercicios base de PHP · <?= count($files) ?> archivos</p>
  <ul>
    <?php foreach ($files as $name => $size): ?>
      <li>
        <a class="item" href="<?= htmlspecialchars(rawurlencode($name)) ?>">
          <code><?= htmlspecialchars($name) ?></code>
          <span class="size"><?= number_format($size / 1024, 1) ?> KB</span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</main>
</body>
</html>
