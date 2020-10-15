<?php
require_once '../vendor/autoload.php';
use App\GuestBook;
$errors = null;
$susses = false;
$guestbook = new GuestBook(dirname(__DIR__) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "messages.json");
if ( isset( $_POST['username'], $_POST['message'])) {
  $message = new Message($_POST['username'], $_POST['message']);
  if ($message->isValid()) {
    $guestbook->addMessage($message);
    $susses = true;
    $_POST = [];
  } else {
    $errors = $message->getErrors();
  }
}
$messages = $guestbook->getMessage();
$titre = "livre d'or - Sowilo";
?>
<?php ob_start(); ?>
<h2>livre d'or</h2>
<?php if (!empty($errors)): ?>
  <div class="">
      les champs sont invalides
  </div>
<?php endif ?>
<?php if ($susses): ?>
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
<?php $main = ob_get_clean(); ?>

<?php
require '../view/template-page.php';
 ?>
