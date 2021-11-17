<?php

include 'database/database.php';
include 'status_message.php';

$hostname   = 'localhost';
$username   = 'root';
$password   = 'fr33pass';
$database   = 'php_login_and_signup_form';
$port       = '3306';
$connection = new Database($hostname, $username, $password, $database, $port);

function email_validation(string $email): string
{
  global $connection;
  if (strlen($email) <= 0) {
    return StatusMessage::EMAIL_EMPTY;
  } else if ($connection->registered('Users', 'email', $email)) {
    return StatusMessage::EMAIL_REGISTERED;
  } else {
    return StatusMessage::VALID;
  }
}

/**
 * Validate username
 *
 * @param string $username The input username
 * @param bool $registered If `true` when username has been registered it'll returned `StatusMessage::USERNAME_REGISTERED`, while `else`, it'll returned `StatusMessage::USERNAME_NOT_REGISTERED`
 * @return string
 **/
function username_validation(string $username, bool $registered): string
{
  global $connection;
  if (strlen($username) <= 0) {
    return StatusMessage::USERNAME_EMPTY;
  }
  
  if ($connection->registered('Users', 'username', $username)) {
    if ($registered) {
      return StatusMessage::USERNAME_REGISTERED;
    }
  } else {
    if (!$registered) {
      return StatusMessage::USERNAME_NOT_REGISTERED;
    }
  }

  return StatusMessage::VALID;
}

function password_validation(string $password, string $conf_password = null): string
{
  if (strlen($password) <= 0) {
    return StatusMessage::PASSWORD_EMPTY;
  } else if ($conf_password != null) {
    if ($password !== $conf_password) {
      return StatusMessage::CONFIRMATION_PASSWORD_NOT_MATCH;
    }
  }
  return StatusMessage::VALID;
}

function register(string $email, string $username, string $password, string $conf_password): string
{
  global $connection;

  $username = strtolower(stripslashes($username));

  $result = email_validation($email);
  if ($result !== StatusMessage::VALID) {
    return $result;
  }

  $result = username_validation($username, true);
  if ($result !== StatusMessage::VALID) {
    return $result;
  }

  $result = password_validation($password, $conf_password);
  if ($result !== StatusMessage::VALID) {
    return $result;
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }

  if ($connection->insert("Users(username, email, password)", $username, $email, $password)) {
    enter($connection->get_id($username));
  } else {
    return StatusMessage::FAILED;
  }
}

function login(string $username, string $password): string
{
  global $connection;

  $username = strtolower(stripslashes($username));

  $result = username_validation($username, false);
  if ($result !== StatusMessage::VALID) {
    return $result;
  }

  $result = password_validation($password);
  if ($result !== StatusMessage::VALID) {
    return $result;
  } else {
    if (password_verify($password, $connection->get_password($username))) {
      enter($connection->get_id($username));
    } else {
      return StatusMessage::PASSWORD_WRONG;
    }
  }
}

function enter($user_id) {
  session_start();
  $_SESSION['user_id'] = $user_id;
  redirect('../');
}

function redirect(string $page, bool $boolean = true): void
{
  if ($boolean) {
    header("Location: $page");
    exit();
  }
}

?>