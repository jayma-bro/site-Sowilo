<?php
require_once '../vendor/autoload.php';
use App\{
  GuestBook,
  Message
};
$titre = "Livre d'or - Sowilo";

$errors = null;
$susses = false;
$guestbook = new GuestBook();
if ( isset( $_POST['username'], $_POST['message'], $_POST['email'])) {
  $message = new Message($_POST['username'],$_POST['email'], $_POST['message']);
  if ($message->isValid()) {
    $guestbook->addMessage($message);
    $susses = true;
    $_POST = [];
  } else {
    $errors = $message->getErrors();
  }
}
$messages = $guestbook->getMessage();
ob_start(); ?>
<h2>livre d'or</h2>
<?php if (!empty($errors)): ?>
  <div class="">
      les champs sont invalides
  </div>
<?php elseif ($susses): ?>
  <div class="">
      merci de votre message
  </div>
<?php endif ?>
<form method="post">
  <?php if (isset($errors['username'])): ?>
    <div class="">
      <?= $errors['username'] ?>
    </div>
  <?php endif ?>
  <label>votre nom</label>
  <input type="text" name="username"><br>
  <label>votre email</label>
  <input type="text" name="email"><br>
  <?php if (isset($errors['message'])): ?>
    <div class="">
      <?= $errors['message'] ?>
    </div>
  <?php endif ?>
  <label>votre commentaire</label>
  <textarea name="message" rows="8" cols="80" placeholder="rentrez votre commentaire"></textarea>
  <button type="submit">envoyer le commentaire</button>
</form>
<?php if (!empty($messages)): ?>
  <div class="">
    <h3>tout les messages</h3>
    <?php foreach ($messages as $message): ?>
      <?= $message->toHTML() ?>
    <?php endforeach ?>
  </div>
<?php endif ?>
<?php $main = ob_get_clean();

require '../view/template-page.php';
 ?>
