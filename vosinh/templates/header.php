<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KARATE-DO VẠN XUÂN</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts/font-awesome.min.css">
    <script src="js/libs/jquery-1.9.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header d-flex">
                <img src="../images/logo2.gif" class="img_logo rounded-circle">
                <h3 class="text-center headmenu">Menu</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="thongtinvosinh.php"><i class="fa fa-address-book-o"></i> THÔNG TIN VÕ SINH</a>
                </li>
                <li>
                    <a href="lichsudongtien.php"><i class="fa fa-list-ol"></i> LỊCH SỬ ĐÓNG TIỀN</a>
                </li>
                <li>
                    <a href="doimatkhau.php"><i class="fa fa-wrench"></i> ĐỔI MẬT KHẨU</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <?php
                session_start();
                if(isset($_SESSION['tennguoidung']))
                {
                    $tennguoidung=$_SESSION['tennguoidung'];
                    echo'
                        <nav class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <button type="button" id="sidebarCollapse" class="btn btn-info">
                                    <i class="fa fa-align-justify"></i>
                                </button>
                                <div class="col-sm-6  d-flex ">
                                    <h4 class="name_club">Câu lạc bộ Karate-do Vạn Xuân</h4>
                                </div>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="nav navbar-nav ml-auto">
                                        <li class="nav-item">
                                           <span class="nav-link text-primary">'.$tennguoidung.'</span>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../php/xulydangxuat.php"><i class="fa  fa-power-off"></i> Thoát</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>';
                }else{
                    header('location:../login.php');
                }
            ?>
