<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once(__DIR__ . "/templates/headers.php") ?>
  <script type="text/javascript" src="js/signup-page.js"></script>
  <title>Login</title>
  <link rel="stylesheet" href="css/login-page.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
    crossorigin="anonymous">
</head>

<body>
  <div class="upper-container">
    <div class="imgcontainer">
      <img src="assets/avatar.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="input-name"><b>名稱</b></label>
      <input id="input-name" type="text" placeholder="輸入名稱">

      <label for="input-email"><b>Email</b></label>
      <input id="input-email" type="text" placeholder="輸入 Email">

      <label for="input-password"><b>密碼</b></label>
      <input id="input-password" type="password" placeholder="輸入密碼">
      <div id="lbl-error"> </div>
      <button id="btn-signup" class="btn btn-outline-success w-100">註冊</button>

      <div class="container" style="background-color:#f1f1f1; text-align: center;">
        <span>已經有帳戶了 ? <a class="btn btn-outline-primary" href="login.php">登入</a></span>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>