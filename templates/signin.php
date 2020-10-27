<?php
use App\UserInfo;
$titre = "inscription sowilo";
$sidebar = true;
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_conf']) && isset($_POST['birthday'])) {
  $validation = UserInfo::isValid($_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_conf'], $_POST['birthday']);
  if ($validation) {
    $user = UserInfo::signIn($_POST['username'], $_POST['email'], $_POST['password'], $_POST['birthday']);
    $_SESSION['id']=$user->id;
  }
}

ob_start(); ?>
<?php if (isset($validation)): ?>
  <div class="">
    <?php if ($validation): ?>
      bien recu
    <?php else: ?>
      erreur de remplissage
    <?php endif; ?>
  </div>
<?php endif; ?>
<form class="sign_in" method="post">
  <div class="">
    <label>votre nom</label>
    <input type="text" name="username" value="">
  </div>
  <div class="">
    <label>votre adresse mail</label>
    <input type="text" name="email" value="">
  </div>
  <div class="">
    <label>le mot de passe</label>
    <input type="password" name="password" value="">
  </div>
  <div class="">
    <label>confirmer le mot de passe</label>
    <input type="password" name="password_conf" value="">
  </div>
  <div class="">
    <label>date de naissance</label>
    <input type="date" name="birthday" value="">
  </div>
  <button type="submit" name="valider">valider</button>
</form>
<?php
$main = ob_get_clean();
require '../view/template-page.php';
