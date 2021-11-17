<?php

include '../controller.php';

session_start();

$validationError = false;
$result = null;

redirect('../', isset($_SESSION['user_id']));

if (isset($_POST['signup'])) {

  $result = register($_POST['email'], $_POST['username'], $_POST['password'], $_POST['conf_password']);

  if ($result === StatusMessage::FAILED) {
    echo 'Database error';
  } else {
    $validationError = true;
  }
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

  <title>Sign up</title>
</head>

<body>
  
  <section class="flex justify-center items-center bg-center bg-cover h-screen w-screen" style="background-image: url('../assets/signup-bg.jpg')">
    <div class="bg-gray-100 rounded p-8">
      <form action="" method="post">
        <div class="text-4xl mb-10">Registration</div>
        <div class="flex flex-col w-80 py-4">
          <div id="email-form" class="flex flex-col mb-4">
            <input class="border border-transparent rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent p-1.5" type="email" name="email" id="email" placeholder="Email address" autocomplete="off" maxlength="255" value="<?= isset($_POST['email']) ? $_POST['email'] : ''?>">
            <label class="hidden text-red-500" for="email"></label>
          </div>
          <div id="username-form" class="flex flex-col mb-4">
            <input class="border border-transparent rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent p-1.5" type="text" name="username" id="username" placeholder="Username" autocomplete="off" maxlength="15" value="<?= isset($_POST['username']) ? $_POST['username'] : ''?>">
            <label class="hidden text-red-500" for="username"></label>
          </div>
          <div id="password-form" class="flex flex-col mb-4">
            <input class="border border-transparent rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent p-1.5" type="password" name="password" id="password" placeholder="Password" autocomplete="off" maxlength="50" value="<?= isset($_POST['password']) ? $_POST['password'] : ''?>">
          </div>
          <div id="confpassword-form" class="flex flex-col mb-4">
            <input class="border border-transparent rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent p-1.5" type="password" name="conf_password" id="conf-password" autocomplete="off" placeholder="Confirm password">
            <label class="hidden text-red-500" for="conf-password"></label>
          </div>
        </div>
        <div class="flex flex-col items-center pt-4">
          <button class="submit-btn bg-blue-500 rounded text-white px-4 py-1.5 w-4/5 mb-4 hover:bg-blue-600" name="signup" type="submit">Sign up</button>
          <a href="../login/" role="button" class="border border-blue-600 rounded text-center px-4 py-1.5 w-4/5 hover:bg-blue-600 hover:text-white">Log in</a>
        </div>
      </form>
    </div>
  </section>

  <script src="../js/script.js"></script>
  <?php

  if ($validationError) {
    if (str_contains(strtolower($result), 'email')) {
      echo "<script> formError('email-form', '$result'); </script>";
    } else if (str_contains(strtolower($result), 'username')) {
      echo "<script> formError('username-form', '$result'); </script>";
    } else if (str_contains(strtolower($result), 'password')) {
      echo "
        <script>
          formError('password-form', '$result');
          formError('confpassword-form', '$result');
        </script>
      ";
    }
  }

  ?>

</body>

</html>