<?php
namespace App;
require_once '../vendor/autoload.php';
use App\Message;
use PDO;
/**
 *
 */
class GuestBook
{
  private $pdo;

  function __construct()
  {
    $pdo = new PDO('mysql:host=localhost;dbname=sowilo-db;charset=utf8', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    $this->pdo = $pdo;
  }

  public function addMessage(Message $message)
  {
    $query = $this->pdo->prepare("INSERT INTO guestbook (id, username, email, message, date_crea) VALUES (NULL,:username,:email,:message,:date_crea)");
    $query->execute([
      'username' => $message->username,
      'email' => $message->email,
      'message' => $message->message,
      'date_crea' => $message->date->format('Y-m-d H:m:s')
    ]);
  }

  public function getMessage()
  {
    $query = $this->pdo->query('SELECT username, email, message, date_crea FROM guestbook ');
    $messages = [];
    if (!$query) {
      return $messages;
    } else {
      $donnees = $query->fetchAll();
      foreach ($donnees as $donnee) {
        $messages[] = new Message($donnee['username'], $donnee['email'], $donnee['message'], $donnee['date_crea']);
      }
      return array_reverse($messages);
    }
  }
}
