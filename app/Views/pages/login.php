<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  
</head>
<body>
  <h1>Login</h1>
  <hr>
  <label for="" id="msg"></label>
  <br>
  <label for="">Usernama</label> : <input type="text" name="username">
  <br>
  <label for="">Password</label> : <input type="password" name="password">
  <br>
  <input type="button" value="Login" id="login">

  
  <script src="<?= base_url('pages-js/global.js') ?>"></script>
  <script src="<?= base_url('pages-js/login-user.js') ?>"></script>

</body>
</html>