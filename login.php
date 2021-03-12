<!DOCTYPE hmtl>
<head>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta charset="UTF-8"> 
  <title>Đăng nhập</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href="css/libs/bootstrap.css" type="text/css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet" type="text/css">
  <link href="css/fonts/awesome.css" rel="stylesheet">  
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
  <script type="text/javascript">
    $('#Login').validate({
      rules:{
        taikhoan:{
          required:true,
        },
        matkhau:{
          required:true,
        },
      }
    });
  </script>

</head>
<body id="LoginForm">
    <div class="container">
      <div class="login-form">
      <div class="main-div">
          <div class="panel">
             <h2>Đăng nhập</h2>
          </div>
          <form id="Login" method="POST" action="php/xulydangnhap.php">
              <div class="form-group">
                  <input type="text" class="form-control" id="taikhoan" name="taikhoan" placeholder="Tài khoản" required="">
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" id="matkhau" name="matkhau" placeholder="Mật khẩu" required="">
              </div>
              <button type="submit" class="btn btn-primary">Log in</button>
          </form>
          <div style = "font-size:14px; color:#cc0000; margin-top:10px">
            <?php 
              session_start();
              if (isset($_SESSION['error'])) {
                  echo $_SESSION['error'];
                  unset($_SESSION['error']);
              }
            ?>    
          </div>
      </div>
</div></div>
</body>
