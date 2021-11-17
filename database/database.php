<?php

class Database extends PDO {

  public function __construct(string $hostname, string $username, string $password, string $database, string $port) {
    try {
      PDO::__construct("mysql:host=$hostname:$port;dbname=$database", $username, $password);
    } catch (PDOException $exception) {
      throw $exception;
    }
  }

  public function registered(string $table, string $column, string $data): bool {
    $result = $this->prepare("SELECT $column FROM $table WHERE $column = ?");
    $result->execute([$data]);
    return gettype($result->fetch(PDO::FETCH_ASSOC)) === 'boolean' ? false : true;
  }

  public function insert(string $table, string ...$params): bool {
    $statement = $this->prepare("INSERT INTO $table VALUES (?, ?, ?)");
    return $statement->execute(array(...$params));
  }

  public function get_password(string $username): string {
    $statement = $this->prepare("SELECT password FROM Users WHERE username = ?");
    $statement->execute([$username]);
    return $statement->fetch(PDO::FETCH_ASSOC)['password'];
  }

  public function get_id(string $username) {
    $statement = $this->prepare("SELECT id FROM Users WHERE username = ?");
    $statement->execute([$username]);
    return $statement->fetch()['id'];
  }

  public function get_data(string $table, string $id) {
    $statement = $this->prepare("SELECT * FROM $table WHERE id = ?");
    $statement->execute([$id]);
    return $statement->fetch();
  }
}

?>
