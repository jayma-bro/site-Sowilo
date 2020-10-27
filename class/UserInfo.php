<?php
namespace App;
use PDO;
use DateTime;
/**
 *
 */
class UserInfo
{
  public $id;
  public $username;
  public $email;
  public $date_crea;
  public $birthday;
  // public $pdo = new PDO('mysql:host=localhost;dbname=sowilo-db;charset=utf8', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);

  function __construct(int $id)
  {
    $pdo = new PDO('mysql:host=localhost;dbname=sowilo-db;charset=utf8', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    $query = $pdo->query("SELECT * FROM users WHERE id=$id");
    $user = $query->fetch();
    $this->id = $user['id'];
    $this->username = $user['username'];
    $this->email = $user['email'];
    $this->date_crea = new DateTime($user['date_crea']);
    $this->birthday = new DateTime($user['birthday']);

  }
  public static function logIn(string $name_email, string $password): int
  {
    $pdo = new PDO('mysql:host=localhost;dbname=sowilo-db;charset=utf8', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    $query = $pdo->prepare("SELECT password, id FROM users WHERE username = :username OR email = :email");
    $query->execute([
      "username" => $name_email,
      "email" => $name_email
    ]);
    $users = $query->fetchAll();
    if ($users) {
      foreach ($users as $user) {
        if (password_verify($password, $user['password'])) {
          return $user['id'];
        }
      }
    }
    return 0;
  }
  public static function signIn(string $username, string $email, string $password, string $birthday): UserInfo
  {
    $pdo = new PDO('mysql:host=localhost;dbname=sowilo-db;charset=utf8', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    $query = $pdo->prepare('INSERT INTO users (username, password, email, birthday) VALUES (:username, :password, :email,\''.$birthday.'\')');
    $query->execute([
      'username' => $username,
      'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]),
      'email' => $email
    ]);
    return new UserInfo($pdo->lastInsertId());
  }
  public static function isValid(string $username, string $email, string $password, string $password_conf, string $birthday): bool
  {
    $pdo = new PDO('mysql:host=localhost;dbname=sowilo-db;charset=utf8', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
    $query = $pdo->prepare("SELECT username FROM users WHERE username = :username");
    $query->execute(["username" => $username ]);
    $user = $query->fetch();
    return (!$user && preg_match('#^\S{3,}$#', $username) &&
    preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email) &&
    preg_match('#^\S{6,}$#', $password) &&
    $password === $password_conf &&
    preg_match("#\d{4}-\d{2}-\d{2}#", $birthday));
  }
  public static function call(int $id)
  {
    // code...
  }
}
