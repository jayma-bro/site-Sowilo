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
    </header>
    <div class="content">
      <main class="main">
        <?= $main ?>
      </main>
      <nav class="sidebar">
        <div class="social">
          <h2>section dédié au social</h2>
        </div>
        <div class="info-utile">
          <h2>section dédié au info utiles</h2>
        </div>
        <div class="calendrier">
          <h2>section du calendrier des evenements</h2>
        </div>
      </nav>
    </div>
  </body>
</html>
