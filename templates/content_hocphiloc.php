<div>
<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $danhsachdong = new danhsachdong();
    $makhoanthu=$_GET['makhoanthu'];
    $makhoahoc=$_GET['makhoahoc'];
    if(isset($_SESSION['urlhocphi']))
    {
      unset($_SESSION['urlhocphi']);
    }
    if($makhoanthu!=null && $makhoahoc!=null)
    {
      $dsdongtien=$danhsachdong->select_dsdongtien_khoanthu_khoahoc($makhoanthu,$makhoahoc);
      if($dsdongtien==null)
      {
        echo'<h3 class="text-danger text-center">Kết quả lọc</h3>
        <div class="alert alert-danger">Khóa học đã đóng hết tiền hoặc chưa tạo danh sách đóng</div>
        <div class="text-primary">
          <a href="hocphi.php">Quay lại trang trước</a>
        </div>';
      }
      else
      {
        $url_cahai=$_SERVER['REQUEST_URI'];
        $_SESSION['urlhocphi']=$url_cahai;
          echo'
          <h3 class="text-danger text-center">Kết quả lọc</h3>
             <table class="table bg-light table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" style=" width: 100px">Mã võ sinh</th>
                              <th class="text-center" style="width: 120px">Tên võ sinh</th>
                              <th class="text-center" style="width: 100px">Ngày sinh</th>
                              <th class="text-center" style="width: 120px">Điện thoại</th>
                              <th class="text-center" style="width: 120px">Khóa học</th>
                              <th class="text-center" style="width: 120px">Tên khoản thu</th>
                            </tr>
                          </thead>
                          <tbody>';
                            foreach ($dsdongtien as $value) {
                              $ngaysinh=date('d-m-Y',strtotime($value['NGAYSINH']));
                              echo '
                              <tr>
                                  <td class="text-center">'.$value['MAVS'].'</td>
                                  <td class="text-center"><a href="dongtienhoc.php?mavs='.$value['MAVS'].'&check=1&makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'" class="name">'.$value['TENVS'].'</a></td>
                                  <td class="text-center">'.$ngaysinh.'</td>
                                  <td class="text-center">'.$value['DIENTHOAI'].'</td>
                                  <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                                  <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                              </tr>';
                            }
                        echo'
                        </table>
                        <div class="text-primary">
                          <a href="hocphi.php">Quay lại trang trước</a>
                        </div>';
      }
    }else
    if($makhoanthu!=null && $makhoahoc==null)
    {
      $dsdongtien2=$danhsachdong->select_dsdongtien_khoanthu($makhoanthu);
      if($dsdongtien2==null)
      {
        echo'<h3 class="text-danger text-center">Kết quả lọc</h3>
        <div class="alert alert-danger">Khóa học đã đóng hết tiền hoặc chưa tạo danh sách đóng</div>
        <div class="text-primary">
          <a href="hocphi.php">Quay lại trang trước</a>
        </div>';
      }
      else
      {
        $url_motcai=$_SERVER['REQUEST_URI'];
        $_SESSION['urlhocphi']=$url_motcai;
        echo'
        <h3 class="text-danger text-center">Kết quả lọc</h3>
           <table class="table bg-light table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center" style=" width: 100px">Mã võ sinh</th>
                            <th class="text-center" style="width: 120px">Tên võ sinh</th>
                            <th class="text-center" style="width: 100px">Ngày sinh</th>
                            <th class="text-center" style="width: 120px">Điện thoại</th>
                            <th class="text-center" style="width: 120px">Khóa học</th>
                            <th class="text-center" style="width: 120px">Tên khoản thu</th>
                          </tr>
                        </thead>
                        <tbody>';
                          foreach ($dsdongtien2 as $value) {
                            $ngaysinh=date('d-m-Y',strtotime($value['NGAYSINH']));
                            echo '
                            <tr>
                                <td class="text-center">'.$value['MAVS'].'</td>
                                <td class="text-center"><a href="dongtienhoc.php?mavs='.$value['MAVS'].'&check=1&makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'" class="name">'.$value['TENVS'].'</a></td>
                                <td class="text-center">'.$ngaysinh.'</td>
                                <td class="text-center">'.$value['DIENTHOAI'].'</td>
                                <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                                <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                            </tr>';
                          }
                      echo'
                      </table>
                      <div class="text-primary">
                        <a href="hocphi.php">Quay lại trang trước</a>
                      </div>';
      } 
    }else
    if($makhoanthu==null && $makhoahoc!=null)
    {
      $dsdongtien3=$danhsachdong->select_dsdongtien_khoahoc($makhoahoc);
      if($dsdongtien3==null)
      {
        echo'<h3 class="text-danger text-center">Kết quả lọc</h3>
        <div class="alert alert-danger">Khóa học đã đóng hết tiền hoặc chưa tạo danh sách đóng</div>
        <div class="text-primary">
          <a href="hocphi.php">Quay lại trang trước</a>
        </div>';
      }
      else
      {
        $url_motcaimot=$_SERVER['REQUEST_URI'];
        $_SESSION['urlhocphi']=$url_motcaimot;
        echo'
        <h3 class="text-danger text-center">Kết quả lọc</h3>
           <table class="table bg-light table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center" style=" width: 100px">Mã võ sinh</th>
                            <th class="text-center" style="width: 120px">Tên võ sinh</th>
                            <th class="text-center" style="width: 100px">Ngày sinh</th>
                            <th class="text-center" style="width: 120px">Điện thoại</th>
                            <th class="text-center" style="width: 120px">Khóa học</th>
                            <th class="text-center" style="width: 120px">Tên khoản thu</th>
                          </tr>
                        </thead>
                        <tbody>';
                          foreach ($dsdongtien3 as $value) {
                            $ngaysinh=date('d-m-Y',strtotime($value['NGAYSINH']));
                            echo '
                            <tr>
                                <td class="text-center">'.$value['MAVS'].'</td>
                                <td class="text-center"><a href="dongtienhoc.php?mavs='.$value['MAVS'].'&check=1&makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'" class="name">'.$value['TENVS'].'</a></td>
                                <td class="text-center">'.$ngaysinh.'</td>
                                <td class="text-center">'.$value['DIENTHOAI'].'</td>
                                <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                                <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                            </tr>';
                          }
                      echo'
                      </table>
                      <div class="text-primary">
                        <a href="hocphi.php">Quay lại trang trước</a>
                      </div>';
      }
    }        
?>
</div>
