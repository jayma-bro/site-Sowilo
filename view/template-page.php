<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $titre ?></title>
    <link rel="stylesheet" href="style/style.css">
  </head>
  <body>
    <div class="fond">
    </div>
    <header class="topbar">
      <div class="title">
        Sowilo
      </div>
      <nav>
        <a href="<?= $router->generate('home') ?>">Acceuil</a>
        <a href="<?= $router->generate('a_propos') ?>">A propos</a>
        <a href="<?= $router->generate('le_jeu') ?>">Le Jeu</a>
        <a href="<?= $router->generate('leaderboard') ?>">Leaderboard</a>
        <a href="<?= $router->generate('calendrier') ?>">Calendrier</a>
        <a href="<?= $router->generate('contact') ?>">Contact</a>
        <a href="<?= $router->generate('livre_dor') ?>">Livre d'or</a>
      </nav>
      <div class="login">
        <?php if ($_SESSION['id']): ?>
          <a href="<?= $router->generate('home') ?>">deconnection</a>
        <?php else: ?>
          <a href="<?= $router->generate('signin') ?>">inscription</a><br>
          <a href="<?= $router->generate('login') ?>">connection</a>
        <?php endif ?>
      </div>
    </header>
    <div class="content">
      <main class="main">
        <?= $main ?>
      </main>
      <?php if ($sidebar) {
        require 'sidebar.php';
      } ?>
    </div>
  </body>
</html>
