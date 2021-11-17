<?php

include '../controller.php';

session_start();

redirect('../', isset($_SESSION['user_id']));

$dataError = false;
$result = null;

if (isset($_POST['login'])) {
  $result = login($_POST['username'], $_POST['password']);
  $dataError = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Tailwind CSS -->
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <title>Log in</title>
</head>

<body>
  
  <section class="flex justify-center items-center bg-center bg-cover h-screen w-screen" style="background-image: url('../assets/login-bg.jpg')">
    <div class="bg-gray-100 rounded p-8">
      <form action="" method="post">
        <div class="text-4xl mb-10">Sign in</div>
        <div class="flex flex-col w-80 py-4">
          <div id="username-form" class="flex flex-col mb-4">
            <input class="border border-transparent rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent p-1.5" type="text" name="username" id="username" placeholder="Username" autocomplete="off" maxlength="15" value="<?= isset($_POST['username']) ? $_POST['username'] : ''?>">
            <label class="hidden text-red-500" for="username"></label>
          </div>
          <div id="password-form" class="flex flex-col mb-4">
            <input class="border border-transparent rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent p-1.5" type="password" name="password" id="password" placeholder="Password" autocomplete="off" maxlength="50">
            <label class="hidden text-red-500" for="password"></label>
          </div>
        </div>
        <div class="flex flex-col items-center pt-4">
          <button type="submit" name="login" class="bg-blue-500 rounded text-white px-4 py-1.5 w-4/5 mb-4 hover:bg-blue-600">Log in</button>
          <a href="../register/" role="button" class="border border-blue-600 rounded text-center px-4 py-1.5 w-4/5 hover:bg-blue-600 hover:text-white">Sign up</a>
        </div>
      </form>
    </div>
  </section>

  <script src="../js/script.js"></script>
  <?php
  
  if ($dataError) {
    if (str_contains(strtolower($result), 'username')) {
      echo "<script> formError('username-form', '$result'); </script>";
    } else if (str_contains(strtolower($result), 'password')) {
      echo "<script> formError('password-form', '$result'); </script>";
    } else {

    }
  }

  ?>

</body>

</html>