<div>
<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $danhsachdong = new danhsachdong();
    $mavs=$_GET['mavs'];
    $check=$_GET['check'];
    $makhoanthu=$_GET['makhoanthu'];
    $makhoahoc=$_GET['makhoahoc'];
    $ds=$danhsachdong->search_dongtienhoc($mavs);
    if($ds==null)
    {
      echo '
      <div class="alert alert-primary">
        Võ sinh đã đóng hết các khoản
      </div>
      <div class="text-primary">
            <a href="hocphi.php">Quay lại</a>
      </div>';  
    }
    else{
      if(isset($_SESSION['search'])==1)
      {
        $url_dongtienhoc_timkiem=$_SERVER['REQUEST_URI'];
        $_SESSION['urldongtienhoc']=$url_dongtienhoc_timkiem;
        echo'
            <h3 class="text-center text-danger">Danh sách các khoản cần đóng</h3>
            <form action="capnhatdanhsachdongtien.php?mavs='.$mavs.'&check='.$check.'&makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'" method="POST" class="mt-3">
                  <table class="table bg-light table-bordered">
                      <tr>
                        <th class="text-center" style=" width: 80px">Mã võ sinh</th>
                        <th class="text-center" style="width: 120px">Tên võ sinh</th>
                        <th class="text-center" style="width: 100px">Ngày sinh</th>
                        <th class="text-center" style="width: 120px">Khóa học</th>
                        <th class="text-center" style="width: 120px">Tên khoản đóng</th>
                        <th class="text-center" style="width: 100px">Mức đóng</th>
                        <th class="text-center" style="width: 50px">Tình trạng</th>
                      </tr>';
                      foreach ($ds as $value) {
                        $ngaysinh=date('d-m-Y',strtotime($value['NGAYSINH']));
                        $mucdong=number_format($value['MUCDONG']);
                        echo '
                        <tr>
                            <td class="text-center">'.$value['MAVS'].'</td>
                            <td class="text-center">'.$value['TENVS'].'</td>
                            <td class="text-center">'.$ngaysinh.'</td>
                            <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                            <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                            <td class="text-center" name="mucdong">'.$mucdong.' VND</td>
                            <td class="text-center">
                              <input type="checkbox" class="form-check-input" name="tinhtrang[]" 
                              value="'.$value['MAKHOANTHU'].'" id="hocphi" >
                            </td>
                        </tr>';
                      }
                  echo'
                  </table>
                  <input type="submit" value="Xác nhận" class="btn-warning mt-2" name="dongtien">
            </form>
            <br/>
            <div class="text-primary">
              <a href="hocphi.php">Quay lại trang trước</a>
            </div>';
            unset($_SESSION['search']);
      }
      else
      {
        $url_dongtienhoc=$_SERVER['REQUEST_URI'];
        $_SESSION['urldongtienhoc']=$url_dongtienhoc;
        echo'
            <h3 class="text-center text-danger">Danh sách các khoản cần đóng</h3>
            <form action="capnhatdanhsachdongtien.php?mavs='.$mavs.'&check='.$check.'&makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'" method="POST" class="mt-3">
                  <table class="table bg-light table-bordered">
                      <tr>
                        <th class="text-center" style=" width: 80px">Mã võ sinh</th>
                        <th class="text-center" style="width: 120px">Tên võ sinh</th>
                        <th class="text-center" style="width: 100px">Ngày sinh</th>
                        <th class="text-center" style="width: 120px">Khóa học</th>
                        <th class="text-center" style="width: 120px">Tên khoản đóng</th>
                        <th class="text-center" style="width: 100px">Mức đóng</th>
                        <th class="text-center" style="width: 50px">Tình trạng</th>
                      </tr>';
                      foreach ($ds as $value) {
                        $ngaysinh=date('d-m-Y',strtotime($value['NGAYSINH']));
                        $mucdong=number_format($value['MUCDONG']);
                        echo '
                        <tr>
                            <td class="text-center">'.$value['MAVS'].'</td>
                            <td class="text-center">'.$value['TENVS'].'</td>
                            <td class="text-center">'.$ngaysinh.'</td>
                            <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                            <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                            <td class="text-center" name="mucdong">'.$mucdong.' VND</td>
                            <td class="text-center">
                              <input type="checkbox" class="form-check-input" name="tinhtrang[]" 
                              value="'.$value['MAKHOANTHU'].'" id="hocphi" >
                            </td>
                        </tr>';
                      }
                  echo'
                  </table>
                  <input type="submit" value="Xác nhận" class="btn-warning mt-2" name="dongtien">
            </form>
            <br/>
            <div class="text-primary">
              <a href="'.$_SESSION['urlhocphi'].'">Quay lại trang trước</a>
            </div>';
        }
      }

?>
</div>
