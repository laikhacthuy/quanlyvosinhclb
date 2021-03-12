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
<div>
      <h2 class="text-danger text-center mt-2">LỌC DANH SÁCH THI LÊN ĐAI</h2>
      <div class="filter">
      <form action="" method="GET">
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
      </form>
      </div>
</div>';
if (isset($_GET['boloc'])) 
{
  $makhoanthu = $_GET['makhoanthu'];
  $makhoahoc= $_GET['makhoahoc'];
  if ($makhoanthu!=null && $makhoahoc!=null) 
  {
    $ds=$danhsachdong->select_dsdong_khoanthu_khoahoc_lendai($makhoanthu,$makhoahoc);
      echo'
      <div>
              <h2 class="text-danger text-center mt-2">Danh sách thi lên đai</h2>
                <table class="table bg-light table-bordered mt-3">
                    <tr>
                      <th class="text-center" style=" width: 120px">Mã võ sinh</th>
                      <th class="text-center" style=" width: 100px">Tên võ sinh</th>
                      <th class="text-center" style="width: 100px">Tên khoản thu</th>
                      <th class="text-center" style="width: 100px">Khóa học</th>
                      <th class="text-center" style="width: 100px">Màu đai</th>
                      <th class="text-center" style="width: 100px">Tình trạng</th>
                    </tr>';
                    foreach ($ds as $key => $value) {
                      if($value['TINHTRANG']==1)
                      {
                        $tinhtrang="Chưa đóng";
                      }
                      else
                      if($value['TINHTRANG']==2)
                      {
                        $tinhtrang="Đã đóng";
                      }
                      echo '
                    <tr>
                          <td class="text-center">'.$value['MAVS'].'</td>
                          <td class="text-center">'.$value['TENVS'].'</td>
                          <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                          <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                          <td class="text-center">'.$value['TENMAUDAI'].'</td>
                          <td class="text-center text-primary">'.$tinhtrang.'</td>
                    </tr>';
                    }
                    echo'   
                </table> 
                <a  class="text-primary" href=danhsachthilendai.php>Quay lại</a> 
      </div>';
  } else
  if ($makhoanthu!=null && $makhoahoc==null)
  {
    $ds2=$danhsachdong->select_dsdong_khoanthu_lendai($makhoanthu);
      echo'
      <div>
              <h2 class="text-danger text-center mt-2">Danh sách thi lên đai</h2>
                <table class="table bg-light table-bordered mt-3">
                    <tr>
                      <th class="text-center" style=" width: 120px">Mã võ sinh</th>
                      <th class="text-center" style=" width: 100px">Tên võ sinh</th>
                      <th class="text-center" style="width: 100px">Tên khoản thu</th>
                      <th class="text-center" style="width: 100px">Khóa học</th>
                      <th class="text-center" style="width: 100px">Màu đai</th>
                      <th class="text-center" style="width: 100px">Tình trạng</th>
                    </tr>';
                    foreach ($ds2 as $key => $value) {
                      $_SESSION['MAVS']=$value['MAVS'];
                      $_SESSION['MAKHOANTHU']=$value['MAKHOANTHU'];
                      if($value['TINHTRANG']==1)
                      {
                        $tinhtrang="Chưa đóng";
                      }
                      else
                      if($value['TINHTRANG']==2)
                      {
                        $tinhtrang="Đã đóng";
                      }
                      echo '
                    <tr>
                          <td class="text-center">'.$value['MAVS'].'</td>
                          <td class="text-center">'.$value['TENVS'].'</td>
                          <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                          <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                          <td class="text-center">'.$value['TENMAUDAI'].'</td>
                          <td class="text-center text-primary">'.$tinhtrang.'</td>
                    </tr>';
                    }
                    echo'   
                </table>
                <a  class="text-primary" href=danhsachthilendai.php>Quay lại</a> 
      </div>';
  }else
  if ($makhoanthu==null && $makhoahoc!=null)
  {
    $ds3=$danhsachdong->select_dsdong_khoahoc_lendai($makhoahoc);
      echo'
      <div>
              <h2 class="text-danger text-center mt-2">Danh sách thi lên đai</h2>
                <table class="table bg-light table-bordered mt-3">
                    <tr>
                      <th class="text-center" style=" width: 120px">Mã võ sinh</th>
                      <th class="text-center" style=" width: 100px">Tên võ sinh</th>
                      <th class="text-center" style="width: 100px">Tên khoản thu</th>
                      <th class="text-center" style="width: 100px">Khóa học</th>
                      <th class="text-center" style="width: 100px">Màu đai</th>
                      <th class="text-center" style="width: 100px">Tình trạng</th>
                    </tr>';
                    foreach ($ds3 as $key => $value) {
                      if($value['TINHTRANG']==1)
                      {
                        $tinhtrang="Chưa đóng";
                      }
                      else
                      if($value['TINHTRANG']==2)
                      {
                        $tinhtrang="Đã đóng";
                      }
                      echo '
                    <tr>
                          <td class="text-center">'.$value['MAVS'].'</td>
                          <td class="text-center">'.$value['TENVS'].'</td>
                          <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                          <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                          <td class="text-center">'.$value['TENMAUDAI'].'</td>
                          <td class="text-center text-primary">'.$tinhtrang.'</td>
                    </tr>';
                    }
                    echo'   
                </table>
                <a class="text-primary" href=danhsachthilendai.php>Quay lại</a>  
      </div>';
  }else
  if ($makhoanthu==null && $makhoahoc==null)
  {
    echo '<div class="alert alert-danger">
            Vui lòng chọn điều kiện lọc
          </div>';
  }
} 
?>
