<?php
namespace App;
use DateTime;
/**
 *
 */
class Message
{
  public $username;
  public $message;
  public $email;
  public $date;
  function __construct(string $username,string $email, string $message,string $date = null )
  {
    $this->username = $username;
    $this->email = $email;
    $this->message = $message;
    if (empty($date)) {
      $this->date = new DateTime();
    } else {
      $this->date = new DateTime($date);
    }
  }
  public static function fromJSON(string $json): Message
  {
    $data = json_decode($json, true);
    return new self($data['username'],$data['message'],new DateTime("@" . $data['date']));
  }
  public function isValid():bool
  {
    return strlen($this->username) >= 3 && strlen($this->message) >= 10;
  }
  public function toJSON(): string
  {
    return json_encode([
      'username' => $this->username,
      'message' => $this->message,
      'date' => $this->date->getTimestamp()
    ]);
  }
  public function toHTML(): string
  {
    $username = htmlentities($this->username);
    $email = htmlentities($this->email);
    $message = nl2br(htmlentities($this->message));
    $this->date->setTimezone(new \DateTimeZone('Europe/Paris'));
    $date = $this->date->format('d/m/y à H:i');
    return "<p><strong>$username</strong>  $email  <em>le $date</em><br>$message</p>";
  }
  public function getErrors(): array
  {
    $errors = [];
    if (strlen($this->username) < 3) {
      $errors['username'] = 'votre pseudo est invalide';
    }
    if (strlen($this->message) < 10) {
      $errors['message'] = 'votre message est trop court';
    }
    return $errors;
  }
}
