<?php

function connect() {
  return new mysqli('localhost', 'root', 'fr33pass', 'php_login_and_signup_form', '3306');
}

function register($datas) {
  $connection = connect();

  if ($connection->connect_error) {
    die('Connection failed' . $connection);
  }

  $email         = $datas['email'];
  $username      = strtolower(stripslashes($datas['username']));
  $password      = $connection->real_escape_string($datas['password']);
  $conf_password = $connection->real_escape_string($datas['conf_password']);

  // Email validation
  if (strlen($email) <= 0) {
    return 'Email is empty or blank';
  } else if ($connection->query("SELECT email FROM users WHERE email = '$email'")->num_rows > 0) {
    return 'Email has been registered';
  }

  // Username Validation
  if (strlen($username) <= 0) {
    return 'Username is empty or blank';
  } else if ($connection->query("SELECT username FROM users WHERE username = '$username'")->num_rows > 0) {
    return 'Username has been used';
  }

  // Password validation
  if (strlen($password) <= 0) {
    return 'Password is empty or blank';
  } else if ($password !== $conf_password) {
    return 'Confirm password is not match with password';
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }

  $result = $connection->query("INSERT INTO Users(username, email, password) VALUES ('$username', '$email', '$password')");

  $connection->close();

  return $result ? 'success' : 'failed';
}

function enter($username, $password) {
  $connection = connect();

  if ($connection->connect_error) {
    die('Connection failed' . $connection);
  }

  if (strlen($username) <= 0) {
    return 'Username is empty or blank';
  } else if ($connection->query("SELECT email FROM users WHERE username = '$username'")->num_rows <= 0) {
    return 'Username has not registered';
  }

  if (strlen($password) <= 0) {
    return 'Password is empty or blank';
  } else {
    $result = $connection->query("SELECT password FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
      if (password_verify($password, $result->fetch_assoc()['password'])) {
        $connection->close();
        return true;
      } else {
        return 'Password is not correct';
      }
    } else {
      return 'Data not found';
    }
  }
}

function get_id_by_username($username) {
  $connection = connect();
  $result = $connection->query("SELECT id FROM Users WHERE username = '$username'");
  if ($result->num_rows > 0) {
    return $result->fetch_assoc()['id'];
  } else {
    return null;
  }
}

function get_data_by_id($id, $column) {
  $connection = connect();
  $result = $connection->query("SELECT $column FROM Users WHERE id = '$id'");
  if ($result->num_rows > 0) {
    return $result->fetch_assoc()["$column"];
  } else {
    return null;
  }
}

?>
