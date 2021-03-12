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
    $tinhtrang;
    $tongtien=0;
    function getCurURL()
{
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
        $pageURL = "https://";
    } else {
      $pageURL = 'http://';
    }
    if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}
echo '
	<h2 class="text-danger text-center mt-2">BÁO CÁO</h2>
      <div class="d-flex">
        <form action="" method="get" class="formtimkiem">
          <span>Nhập để tìm kiếm:</span>
          <input type="text" size="80" name="search" class="border rounded " placeholder="Nhập mã võ sinh để tìm kiếm">
          <input type="submit" class="border rounded bg-primary text-white" value="Tìm kiếm" name="timkiem">
        </form>
      </div>

      <div class="filter mt-3">
        <form action="" method="GET">
          <fieldset class="scheduler-border">
            <legend class="scheduler-border">Bộ lọc:</legend>
            <div class="row">
            <div class="col-sm-6">
              <div class="form-group col-sm-12 d-flex">
                  <div class="col-sm-3 pr-0">
                    <label class="text-warning">Tên khoản thu: </label>
                  </div>
                  <div class="pl-0 col-sm-9">
                    <select name="makhoanthu">
                    <option value="">---Chọn---</option>';
                    foreach ($dskhoanthu as $key => $value) {
                      echo '
                      <option value='.$value['MAKHOANTHU'].'>'.$value['TENKHOANTHU'].'</option>';
                    }
                    echo '   
                    </select>
                  </div>
              </div>
              <div class="form-group col-sm-12 d-flex">
                <div class="col-sm-3 pr-0">
                    <label class="text-warning">Khóa học: </label>
                </div>
                <div class="pl-0 col-sm-9">
                    <select name="makhoahoc">
                    <option value="">---Chọn---</option>';
                    foreach ($dskhoahoc as $key => $value) {
                      echo '<option value="'.$value['MAKH'].'">'.$value['TENKHOAHOC'].'</option>';
                    }
                    echo'
                    </select>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group col-sm-12 d-flex">
                <div class="col-sm-3 pr-0">
                  <label class="text-warning">Tình trạng: </label>
                </div>
                <div class="pl-0 col-sm-9">
                  <select name="tinhtrang">
                    <option value="">---Chọn---</option>
                    <option value="2">Đã đóng</option>
                    <option value="1">Chưa đóng</option>
                  </select>
                </div>
              </div>
              <div class="">
                <input type="submit" value="Lọc" class="btn btn-danger pl-4 pr-4 ml-4 pt-0 pb-0" name="boloc">
              </div> 
            </div>
          </fieldset>
      </form>
      </div>';
      if(isset($_GET['timkiem']))
      {
        $timkiem=$_GET['search'];
        $dstimkiem=$danhsachdong->baocao_tim($timkiem);
        $tinhtrang;
        $tongtien=0;
        if($timkiem==null)
        {
          echo'
              <h4 class="text-danger text-center mt-2">Thông báo</h4>
              <div class="alert alert-danger">
                Vui lòng nhập mã võ sinh
              </div>';
        }
        else
        {
            if($dstimkiem==null)
            {
              echo'
              <h4 class="text-danger text-center mt-2">Thông báo</h4>
              <div class="alert alert-danger">
                Không có thông tin võ sinh
              </div>';
            }
            else
            {
              foreach ($dstimkiem as $key => $value) {
                $tongtien+=$value['MUCDONG'];
              }
              echo'
              <h4 class="text-danger text-center mt-2">Kết quả tìm kiếm</h4>
              <h5 class="text-danger">Tổng tiền đã đóng: '.number_format($tongtien).' VND</h5>
              <table class="table bg-light table-bordered">
                  <tr>
                    <th class="text-center" style=" width: 100px">Mã võ sinh</th>
                    <th class="text-center" style="width: 100px">Tên võ sinh</th>
                    <th class="text-center" style="width: 100px">Tên khoản thu</th>
                    <th class="text-center" style="width: 100px">Mức đóng</th>
                    <th class="text-center" style="width: 150px">Ngày đóng</th>
                    <th class="text-center" style="width: 150px">Khóa học</th>
                    <th class="text-center" style="width: 120px">Tình trạng</th>
                  </tr>';
                  foreach ($dstimkiem as $key => $value) {
                    $mucdong=number_format($value['MUCDONG']);
                    $ngaydong=date('d-m-Y',strtotime($value['NGAYDONG']));
                    if($value['TINHTRANG']==2)
                    {
                      $tinhtrang="Đã đóng";
                    }
                    echo'
                  <tr>
                        <td class="text-center">'.$value['MAVS'].'</td>
                        <td class="text-center">'.$value['TENVS'].'</td>
                        <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                        <td class="text-center">'.$mucdong.' VND</td>
                        <td class="text-center">'.$ngaydong.'</td>
                        <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                        <td class="text-center">'.$tinhtrang.'</td>
                  </tr>';
                  }
                  echo'
              </table>';
            }
        }
      }
//----------------------loc
      if(isset($_GET['boloc']))
{
        $makhoahoc=$_GET['makhoahoc'];
        $makhoanthu=$_GET['makhoanthu'];
        $tinhtrang=$_GET['tinhtrang'];
        $tongtienloc=0;
        //xử lý lọc bóa cáo
          $filter  = array(
          'makhoanthu'     => isset($_GET['makhoanthu']) ? mysqli_escape_string($db->__conn,$makhoanthu) : false,
          'makhoahoc'     => isset($_GET['makhoahoc']) ? mysqli_escape_string($db->__conn,$makhoahoc) : false,
          'tinhtrang'   => isset($_GET['tinhtrang']) ? mysqli_escape_string($db->__conn,$tinhtrang) : false,
        );
        $where = array();
        // Nếu có chọn lọc thì thêm điều kiện vào mảng
        if ($filter['makhoanthu'])
        {
            $where[] = "danhsachdong.MAKHOANTHU = '{$filter['makhoanthu']}'";
        }
        if ($filter['makhoahoc']){
            $where[] = "khoahoc.MAKH = '{$filter['makhoahoc']}'";
        } 
        if ($filter['tinhtrang']){
            $where[] = "danhsachdong.tinhtrang = '{$filter['tinhtrang']}'";
        } 

        if ($where!=null)
        {
          //phân trang
          $sql2 = "SELECT count(danhsachdong.MAVS)as tongvs,danhsachdong.MAVS,vosinh.TENVS,khoahoc.TENKHOAHOC,danhsachdong.TINHTRANG,khoanthu.TENKHOANTHU,khoanthu.MUCDONG,danhsachdong.NGAYDONG FROM danhsachdong INNER JOIN vosinh on vosinh.MAVS=danhsachdong.MAVS INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU";
          $sql2 .= ' WHERE '.implode(' AND ', $where);
          $sql2 .= ' ORDER BY vosinh.MAVS';

          $sovs= $db->get_list($sql2);
          $tongvosinh=0;
          foreach ($sovs as $value) {
            $tongvosinh=$value['tongvs'];
          }
          $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
          $limit = 10; 

          $total_page = ceil($tongvosinh / $limit);
          if ($current_page > $total_page){
            $current_page = $total_page;
          }
          else if ($current_page < 1){
            $current_page = 1;
          }
          $start = ($current_page - 1) * $limit;
          if($start<0)
          {
            echo'
              <h4 class="text-danger text-center mt-2">Thông báo</h4>
              <div class="alert alert-danger">
                Không có thông tin cần lọc
              </div>';
          }else
          {
          //-------------
          $sql = "SELECT danhsachdong.MAVS,vosinh.TENVS,khoahoc.TENKHOAHOC,danhsachdong.TINHTRANG,khoanthu.TENKHOANTHU,khoanthu.MUCDONG,danhsachdong.NGAYDONG FROM danhsachdong INNER JOIN vosinh on vosinh.MAVS=danhsachdong.MAVS INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU";
          $sql .= ' WHERE '.implode(' AND ', $where);
          $sql .= ' ORDER BY vosinh.MAVS LIMIT '.$start.','.$limit.'';
          
          $ds = $db->get_list($sql);
          //------tinh tong tien loc
          $sql3 = "SELECT danhsachdong.MAVS,vosinh.TENVS,khoahoc.TENKHOAHOC,danhsachdong.TINHTRANG,khoanthu.TENKHOANTHU,khoanthu.MUCDONG,danhsachdong.NGAYDONG FROM danhsachdong INNER JOIN vosinh on vosinh.MAVS=danhsachdong.MAVS INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU";
          $sql3 .= ' WHERE '.implode(' AND ', $where);
          $tongtien2=$db->get_list($sql3);
          foreach ($tongtien2 as $key => $value) {
            if($value['NGAYDONG']!="0000-00-00")
            {
              $tongtienloc+=$value['MUCDONG'];
            }
          }
          //------------
          echo '
          <div>
          <h4 class="text-danger text-center">Kết quả lọc</h4>
          <h5 class="text-danger">Tổng tiền: '.number_format($tongtienloc).' VND</h5>
          <table class="table bg-light table-bordered">
                  <tr>
                    <th class="text-center" style=" width: 100px">Mã võ sinh</th>
                    <th class="text-center" style="width: 100px">Tên võ sinh</th>
                    <th class="text-center" style="width: 100px">Tên khoản thu</th>
                    <th class="text-center" style="width: 100px">Mức đóng</th>
                    <th class="text-center" style="width: 150px">Ngày đóng</th>
                    <th class="text-center" style="width: 150px">Khóa học</th>
                    <th class="text-center" style="width: 120px">Tình trạng</th>
                  </tr>';
              foreach ($ds as $value) {
                
                $mucdong=number_format($value['MUCDONG']);
                if($value['TINHTRANG']==1)
                {
                  $tinhtrang="Chưa đóng";
                }else
                if($value['TINHTRANG']==2)
                {
                  $tinhtrang="Đã đóng";
                }
                ///-----------------
                if($value['NGAYDONG']=="0000-00-00")
                {
                  $ngaydong="";
                }
                else{
                  $ngaydong=date("d-m-Y", strtotime($value['NGAYDONG']));
                }
            echo'
            <tr>
                <td class="text-center">'.$value["MAVS"].'</td>
                <td class="text-center">'.$value["TENVS"].'</td>
                <td class="text-center">'.$value["TENKHOANTHU"].'</td>
                <td class="text-center">'.$mucdong.' VND</td>
                <td class="text-center">'.$ngaydong.'</td>
                <td class="text-center">'.$value['TENKHOAHOC'].'</td>
                <td class="text-center">'.$tinhtrang.'</td>
            </tr>';   
             
            }
            echo'
          </table>
          </div>
          <div class="pagination justify-content-center">';
              if ($current_page > 1 && $total_page > 1)
              {
                echo '<a class="page-link" href="'.getCurURL().'&page='.($current_page-1).'">Prev</a> ';
              }
              for ($i = 1; $i <= $total_page; $i++)
              {
                if ($i == $current_page){
                  echo '<span class="page-link text-danger">'.$i.'</span> ';
                }
                else{
                  echo '<a class="page-link" href="'.getCurURL().'&page='.$i.'">'.$i.'</a> ';
                }
              }
              if ($current_page < $total_page && $total_page > 1)
              {
                echo '<a class="page-link" href="'.getCurURL().'&page='.($current_page+1).'">Next</a> ';
              }
              echo'
          </div>';
        //}
        }
      }else
      {
          echo'
              <h4 class="text-danger text-center mt-2">Thông báo</h4>
              <div class="alert alert-danger">
                Vui lòng chọn điều kiện lọc
              </div>';
      }
}
      