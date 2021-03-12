<div>
  <h2 class="text-danger text-center mt-2">BÁO CÁO HỌC PHÍ NHIỀU THÁNG</h2>
  <div class="filter">
    <form action="" method="GET">
      <fieldset class="scheduler-border">
        <legend class="scheduler-border">Bộ lọc:</legend>
          <div class="form-group col-sm-12 d-flex">
            <div class="col-sm-3 pr-0">
              <label class="text-warning">Ngày bắt đầu: </label>
            </div>
            <div class="pl-0 col-sm-9">
              <input type="date" name="ngaybatdau">
            </div>
          </div>
          <div class="form-group col-sm-12 d-flex">
            <div class="col-sm-3 pr-0">
              <label class="text-warning">Ngày kết thúc: </label>
            </div>
            <div class="col-sm-9 pl-0">
              <input type="date" name="ngayketthuc">  
            </div>     
          </div>
          <div class="form-group col-sm-12 d-flex">
            <div class="col-sm-3 pr-0">
              <label class="text-warning">Tình trạng: </label>
            </div>
            <div class="col-sm-9 pl-0">
              <select name="tinhtrang">
                <option value="">---Chọn---</option>
                <option value="2">Đã đóng</option>
                <option value="1">Chưa đóng</option>
              </select>
            </div>
          </div>
          <div class="ml-4">
            <input type="submit" value="Lọc" class="btn btn-danger pl-4 pr-4" name="boloc">
          </div>
      </fieldset>
  </form>
</div>
<?php
      require ("BackEnd/DB_driver.php");
      require ("BackEnd/DB_business.php");
      require ("BackEnd/DB_classes.php");
      $db = new DB_driver();
      $db->connect();
      $danhsachdong = new danhsachdong();
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
//----------------------loc
      if(isset($_GET['boloc']))
{
          $ngaybatdau=$_GET['ngaybatdau'];
          $ngayketthuc=$_GET['ngayketthuc'];
          $tinhtrang=$_GET['tinhtrang'];
          if ($ngaybatdau!=null&&$ngayketthuc!=null&&$tinhtrang!=null || $ngaybatdau==null&&$ngayketthuc==null&&$tinhtrang!=null)
  {
          //phân trang
          $sql2 = "SELECT count(danhsachdong.MAVS)as tongvs,danhsachdong.MAVS,vosinh.TENVS,khoahoc.TENKHOAHOC,danhsachdong.TINHTRANG,khoanthu.TENKHOANTHU,khoanthu.MUCDONG,danhsachdong.NGAYDONG FROM danhsachdong INNER JOIN vosinh on vosinh.MAVS=danhsachdong.MAVS INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU";
          $sql2 .= ' WHERE danhsachdong.TINHTRANG='.$tinhtrang.' AND danhsachdong.NGAYDONG BETWEEN "'.$ngaybatdau.'" AND "'.$ngayketthuc.'" ';
          $sql2 .= ' ORDER BY danhsachdong.MAKHOANTHU';
          $tongtien=0;
          $demvs = $db->get_list($sql2);
          $tongvosinh=0;
          foreach ($demvs as $value) {
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
          if($start>=0)
        {
          //-------------
          $sql = "SELECT danhsachdong.MAVS,vosinh.TENVS,khoahoc.TENKHOAHOC,danhsachdong.TINHTRANG,khoanthu.TENKHOANTHU,khoanthu.MUCDONG,danhsachdong.NGAYDONG FROM danhsachdong INNER JOIN vosinh on vosinh.MAVS=danhsachdong.MAVS INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU";
          $sql .= ' WHERE danhsachdong.TINHTRANG='.$tinhtrang.' AND danhsachdong.NGAYDONG BETWEEN "'.$ngaybatdau.'" AND "'.$ngayketthuc.'" ';
          $sql .= ' ORDER BY danhsachdong.MAKHOANTHU LIMIT '.$start.','.$limit.'';

              $ds = $db->get_list($sql);
              if($ds==null)
              {
                echo'
                <h4 class="text-danger text-center mt-2">Thông báo</h4>
                <div class="alert alert-danger">
                  Không có thông tin lọc
                </div>';
              }
              else
              {
                $sql3 = "SELECT danhsachdong.MAVS,vosinh.TENVS,khoahoc.TENKHOAHOC,danhsachdong.TINHTRANG,khoanthu.TENKHOANTHU,khoanthu.MUCDONG,danhsachdong.NGAYDONG FROM danhsachdong INNER JOIN vosinh on vosinh.MAVS=danhsachdong.MAVS INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU";
                $sql3 .= ' WHERE danhsachdong.TINHTRANG='.$tinhtrang.' AND danhsachdong.NGAYDONG BETWEEN "'.$ngaybatdau.'" AND "'.$ngayketthuc.'" ';
                $tongtienmoi=$db->get_list($sql3);
                foreach ($tongtienmoi as $key => $value) {
                  if($value['NGAYDONG']!="0000-00-00")
                  {
                    $tongtien+=$value['MUCDONG'];
                  }
                }
                  echo '
                  <div>
                  <h4 class="text-danger text-center">Kết quả lọc</h4>
                  <h5 class="text-danger">Tổng tiền: '.number_format($tongtien).' VND</h5>
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
              }
          }else{
            echo'
              <h4 class="text-danger text-center mt-2">Thông báo</h4>
              <div class="alert alert-danger">
                Vui lòng chọn điều kiện lọc hoặc điều kiện lọc thiếu 
              </div>';
          }
      }
      else
      {
          echo'
              <h4 class="text-danger text-center mt-2">Thông báo</h4>
              <div class="alert alert-danger">
                Vui lòng chọn điều kiện lọc hoặc điều kiện lọc thiếu
              </div>';
      }
}
      ?>
</div>