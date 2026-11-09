<?php
declare(strict_types=1);

$base = __DIR__;

// Proyectos = subcarpetas visibles de htdocs
$projects = [];
foreach (scandir($base) ?: [] as $entry) {
    if ($entry === '.' || $entry === '..' || $entry[0] === '.') {
        continue;
    }
    $path = $base . DIRECTORY_SEPARATOR . $entry;
    if (is_dir($path) && is_file($path . DIRECTORY_SEPARATOR . 'index.php')
        || is_dir($path) && is_file($path . DIRECTORY_SEPARATOR . 'index.html')) {
        $projects[$entry] = hasIndex($path);
    }
}
ksort($projects);

function hasIndex(string $dir): string
{
    if (is_file($dir . '/index.php')) {
        return 'index.php';
    }
    return 'index.html';
}

// Estado de la base de datos
$dbStatus = ['ok' => false, 'message' => 'Sin conexión'];
try {
    $pdo = new PDO(
        'mysql:host=db;port=3306;dbname=app;charset=utf8mb4',
        'app',
        'app',
        [PDO::ATTR_TIMEOUT => 3, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $version = $pdo->query('SELECT VERSION()')->fetchColumn();
    $dbStatus = ['ok' => true, 'message' => 'MariaDB ' . $version];
} catch (Throwable $e) {
    $dbStatus['message'] = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Proyectos PHP · SENA</title>
<style>
  :root { color-scheme: dark; }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    min-height: 100vh;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
    background: radial-gradient(1200px 600px at 20% -10%, #1e3a5f 0%, #0b1220 55%, #070b14 100%);
    color: #e6edf7;
    padding: 3rem 1.5rem;
  }
  main { max-width: 900px; margin: 0 auto; }
  h1 { font-size: clamp(1.6rem, 4vw, 2.4rem); margin: 0 0 .4rem; letter-spacing: -.02em; }
  .sub { color: #8fa3bf; margin: 0 0 2rem; font-size: .95rem; }
  .chips { display: flex; flex-wrap: wrap; gap: .6rem; margin-bottom: 2.2rem; }
  .chip {
    display: inline-flex; align-items: center; gap: .45rem;
    background: #111c2e; border: 1px solid #22304a; border-radius: 999px;
    padding: .4rem .85rem; font-size: .82rem; color: #b7c6dd;
  }
  .dot { width: .55rem; height: .55rem; border-radius: 50%; }
  .ok .dot { background: #34d399; box-shadow: 0 0 8px #34d39988; }
  .bad .dot { background: #f87171; box-shadow: 0 0 8px #f8717188; }
  h2 { font-size: .8rem; text-transform: uppercase; letter-spacing: .12em; color: #7d93b2; margin: 0 0 .8rem; }
  .grid { display: grid; gap: .8rem; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); }
  a.card {
    display: block; text-decoration: none; color: inherit;
    background: linear-gradient(180deg, #131f33 0%, #101a2b 100%);
    border: 1px solid #22304a; border-radius: 14px; padding: 1.1rem 1.2rem;
    transition: transform .15s ease, border-color .15s ease, box-shadow .15s ease;
  }
  a.card:hover {
    transform: translateY(-2px); border-color: #3b82f6;
    box-shadow: 0 10px 30px -12px #3b82f666;
  }
  .card strong { display: block; font-size: 1.02rem; margin-bottom: .3rem; }
  .card span { font-size: .8rem; color: #8fa3bf; }
  .empty {
    border: 1px dashed #2a3a55; border-radius: 14px; padding: 2rem;
    text-align: center; color: #7d93b2; font-size: .9rem;
  }
  code { background: #0a1220; border: 1px solid #1d2a40; border-radius: 6px; padding: .1rem .4rem; font-size: .85em; }
  footer { margin-top: 2.5rem; color: #5f7391; font-size: .78rem; }
</style>
</head>
<body>
<main>
  <h1>Proyectos PHP</h1>
  <p class="sub">Apache + PHP <?= htmlspecialchars(PHP_VERSION) ?> en Docker · carpeta <code>htdocs/</code></p>

  <div class="chips">
    <span class="chip <?= $dbStatus['ok'] ? 'ok' : 'bad' ?>">
      <span class="dot"></span>
      <?= htmlspecialchars($dbStatus['message']) ?>
    </span>
    <span class="chip"><span class="dot" style="background:#60a5fa"></span>Adminer · :8082</span>
    <span class="chip"><span class="dot" style="background:#a78bfa"></span>MySQL · :3307</span>
  </div>

  <h2>Tus proyectos</h2>
  <?php if ($projects === []): ?>
    <div class="empty">
      Aún no hay proyectos. Crea una carpeta dentro de <code>htdocs/</code> con su <code>index.php</code>
      y aparecerá aquí automáticamente.
    </div>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($projects as $name => $entry): ?>
        <a class="card" href="<?= htmlspecialchars(rawurlencode($name)) ?>/">
          <strong><?= htmlspecialchars($name) ?></strong>
          <span><?= htmlspecialchars($entry) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <footer>Los cambios en <code>htdocs/</code> se reflejan al instante, sin reiniciar contenedores.</footer>
</main>
</body>
</html>
