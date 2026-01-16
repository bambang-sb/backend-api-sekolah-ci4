<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  
</head>
<body>
  <h1>Register</h1>
  <hr>
  <label for="" id="msg"></label>
  <br>
  <label for="">Usernama</label> : <input type="text" name="username">
  <br>
  <label for="">Password</label> : <input type="password" name="password">
  <br>
  <input type="button" value="Register" id="register">

  
  <script src="<?= base_url('pages-js/global.js') ?>"></script>
  <script src="<?= base_url('pages-js/register-user.js') ?>"></script>

</body>
</html>