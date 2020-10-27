<?php
use App\UserInfo;
$titre = "connection sowilo";
$sidebar = true;
if (isset($_POST['user']) && isset($_POST['password'])) {
  $userid = UserInfo::logIn($_POST['user'], $_POST['password']);
  if ($userid) {
    $_SESSION['id'] = $userid;
  }
}


ob_start(); ?>
<form class="sign_in" method="post">
  <div class="">
    <label>votre adresse mail ou nom</label>
    <input type="text" name="user" value="">
  </div>
  <div class="">
    <label>le mot de passe</label>
    <input type="password" name="password" value="">
  </div>
  <button type="submit" name="valider">valider</button>
</form>
<?php
$main = ob_get_clean();
require '../view/template-page.php';
