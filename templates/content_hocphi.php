<div>
<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoanthu = new khoanthu();
    $khoahoc = new khoahoc();
    $danhsachdong = new danhsachdong();
    $dskhoanthu=$khoanthu->select_khoanthu();
    $dskhoahoc = $khoahoc->select_khoahoc();
echo'
      <h2 class="text-danger text-center mt-2">Đóng tiền</h2>
      <div class="d-flex">
        <form action="" method="GET" class="formtimkiem">
          <span>Nhập để tìm kiếm:</span>
          <input type="text" size="80" name="search" class="border rounded ">
          <button type="submit" class="border rounded bg-primary text-white" name="timkiem">Tìm kiếm</button>
        </form>
      </div>

      <form action="php/xulylochocphi.php" method="POST">
          <fieldset class="scheduler-border">
            <legend class="scheduler-border">Bộ lọc:</legend>
            <div class="form-group col-sm-12 d-flex">
              <div class="col-sm-2 pr-0">
                <label class="text-warning">Tên khoản thu: </label>
              </div>
              <div class="pl-0 col-sm-10">
                <select name="makhoanthu">
                <option value="">---Chọn---</option>';
                foreach ($dskhoanthu as $key => $value) {
                  echo '
                  <option value="'.$value['MAKHOANTHU'].'">'.$value['TENKHOANTHU'].'</option>';
                }
                echo '   
                </select>
              </div>
            </div>
            <div class="form-group col-sm-12 d-flex">
              <div class="col-sm-2 pr-0">
                <label class="text-warning">Khóa học: </label>
              </div>
              <div class="pl-0 col-sm-10">
                <select name="makhoahoc">
                <option value="">---Chọn---</option>';
                foreach ($dskhoahoc as $key => $value) {
                  echo '<option value="'.$value['MAKH'].'">'.$value['TENKHOAHOC'].'</option>';
                }
                echo'
                </select>
              </div>
            </div>
            <div class="col-12">
            <input type="submit" value="Lọc" class="btn btn-danger pl-4 pr-4 ml-3" name="boloc">
            </div>
          </fieldset>
      </form>';
      if (isset($_REQUEST['timkiem'])) 
      {
          $timkiem=$_GET['search'];
          if(empty($timkiem))
          {
            echo "
            <div class='alert alert-danger'>
              Vui lòng nhập võ sinh cần tìm
            </div>";
          }else
          { 
            $ds=$danhsachdong->search_dsdong($timkiem);
            if($ds==null)
            {
              echo "
              <div class='alert alert-danger'>
                Không có thông tin võ sinh
              </div>";
            }
            else{
              echo'
                  <h3 class="text-danger text-center">Kết quả tìm kiếm</h3>
                  <form action="" method="post" class="mt-3">
                        <table class="table bg-light table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" style=" width: 100px">Mã võ sinh</th>
                              <th class="text-center" style="width: 120px">Tên võ sinh</th>
                              <th class="text-center" style="width: 100px">Ngày sinh</th>
                              <th class="text-center" style="width: 120px">Điện thoại</th>
                              <th class="text-center" style="width: 120px">Khóa học</th>
                            </tr>
                          </thead>
                          <tbody>';
                            foreach ($ds as $value) {
                              $ngaysinh=date('d-m-Y',strtotime($value['NGAYSINH']));
                              echo '
                              <tr>
                                  <td class="text-center">'.$value['MAVS'].'</td>
                                  <td class="text-center"><a href="dongtienhoc.php?mavs='.$value['MAVS'].'&check=2&makhoanthu=&makhoahoc=" class="name">'.$value['TENVS'].'</a></td>
                                  <td class="text-center">'.$ngaysinh.'</td>
                                  <td class="text-center">'.$value['DIENTHOAI'].'</td>
                                  <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                              </tr>';
                            }
                        echo'
                        </table>
                  </form>';
                  $search=1;
                  $_SESSION['search']=$search;
            }
            
          }
      }
      //-----------------------
      if(isset($_SESSION['thongbao']))
    {
        echo '<div class="alert alert-danger">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
?>
</div>
