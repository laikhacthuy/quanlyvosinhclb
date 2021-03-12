<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $dsvs = $vosinh->list_vosinh();
    $maudai = new maudai();
    $dsmd = $maudai->select_maudai();
    $khoahoc= new khoahoc();
    $dskh= $khoahoc->select_khoahoc();
    $tinhtrang;
    $url=0;
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
echo'
<div>
      <h2 class="text-danger text-center mt-2">DANH SÁCH VÕ SINH</h2>
      <div class="d-flex">
        <form action="" method="GET" class="formtimkiem">
          <span>Nhập để tìm kiếm:</span>
          <input type="text" size="80" name="search" class="border rounded " placeholder="Nhập mã võ sinh, tên hoặc số điện thoại">
          <button type="submit" class="border rounded bg-primary text-white" name="timkiem">Tìm kiếm</button>
        </form>
      </div>

      <div class="filter">
        <form action="" method="GET" class="mt-3">
          <fieldset class="scheduler-border">
            <legend class="scheduler-border">Bộ lọc:</legend>
            <div class="row">
            <div class="col-sm-6">
              <div class="form-group col-sm-12 d-flex">
                  <div class="col-sm-3 pr-0">
                    <label class="text-warning">Màu đai: </label>
                  </div>
                  <div class="pl-0 col-sm-9">
                    <select name="mamaudai">
                          <option value="">----Chọn----</option>';
                          foreach ($dsmd as $key => $value) {
                            echo '
                            <option value="'.$value['MAMAUDAI'].'">'.$value['TENMAUDAI'].'</option>';
                          }
                          echo '   
                    </select>
                  </div>
              </div>
              <div class="form-group col-sm-12 d-flex">
                <div class="col-sm-3 pr-0">
                  <label class="text-warning">Khóa học: </label>
                </div>
                <div class="col-sm-9 pl-0">
                  <select name="makhoahoc">
                  <option value="">----Chọn----</option>';
                  foreach ($dskh as $key => $value) {
                    echo '<option value="'.$value['MAKH'].'">'.$value['TENKHOAHOC'].'</option>';
                  }
                  echo'
                  </select>
                </div>
              </div>
              <div class="form-group col-sm-12 d-flex">
                <div class="col-sm-3 pr-0">
                  <label class="text-warning">Tình trạng: </label>
                </div>
                <div class="col-sm-9 pl-0">
                  <select name="tinhtrang">
                  <option value="">----Chọn----</option>
                  <option value="1">Đang học</option>
                  <option value="2">Nghỉ học</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group col-sm-12 d-flex">
                <div class="col-sm-4 pr-0">
                  <label class="text-warning">Ngày nhập học: </label>
                </div>
                <div class="col-sm-8 pl-0">
                  <input type="date" name="ngaynhaphoc">
                </div>
              </div>

              <div class="form-group col-sm-12 d-flex">
                <div class="col-sm-4 pr-0">
                  <label class="text-warning">Ngày thi đai: </label>
                </div>
                <div class="col-sm-8 pl-0">
                  <input type="date" name="ngaythidai">
                </div>
              </div>
            </div>
            </div> 
            <div class="col-12">
            <div class="text-center">
              <input type="submit" value="Lọc" class="btn btn-danger pl-4 pr-4" name="boloc">
            </div>
            </div>
          </fieldset>
                   
        </form>
</div>';
if (isset($_GET['timkiem'])) 
{
  $timkiem=$_GET['search'];
  if ($timkiem==null) 
  {
    echo '<h4 class="text-danger">Vui lòng nhập thông tin tìm kiếm</h4>';
  } else
  {
    $dsvosinh=$vosinh->timkiem_vosinh($timkiem);
    if($dsvosinh==null)
    {
      echo '
      <h4 class="text-danger text-center">Kết quả tìm kiếm</h4>
      <h4 class="">Không có thông tin võ sinh</h4>';
    }
    else
    {
        $url=$_SERVER['REQUEST_URI'];
        $_SESSION['url']=$url;
        echo '
        <h4 class="text-danger text-center">Kết quả tìm kiếm</h4>
        <table class="table bg-light table-bordered">
          <tr>
            <th class="text-center" style=" width: 60px">Mã võ sinh</th>
            <th class="text-center" style="width: 150px">Tên võ sinh</th>
            <th class="text-center" style="width: 60px">Giới tính</th>
            <th class="text-center" style="width: 100px">Ngày sinh</th>
            <th class="text-center" style="width: 100px">Điện thoại</th>
            <th class="text-center" style="width: 100px">Màu đai</th>
            <th class="text-center" style="width: 100px">Tình trạng</th>
            <th class="text-center" style="width: 20px">Tools</th>
          </tr>';
          foreach ($dsvosinh as $value) {
            $ngaysinh=date("d-m-Y", strtotime($value['NGAYSINH']));
            if($value['TINHTRANG']==1)
            {
              $tinhtrang="Đang học";
            }else
            if($value['TINHTRANG']==2)
            {
              $tinhtrang="Nghỉ học";
            }else
            if($value['TINHTRANG']==3)
            {
              $tinhtrang="Học tiếp";
            }
          echo'<tr>
              <td class="text-center">'.$value["MAVS"].'</td>
              <td class="text-center">'.$value["TENVS"].'</td>
              <td class="text-center">'.$value["GIOITINH"].'</td>
              <td class="text-center">'.$ngaysinh.'</td>
              <td class="text-center">'.$value["DIENTHOAI"].'</td>
              <td class="text-center">'.$value["TENMAUDAI"].'</td>
              <td class="text-center">'.$tinhtrang.'</td>
              <td class="text-center">
                <a class="text-dark border rounded ml-2 bg-info" href="capnhatvosinh_chitiet.php?mavs='.$value['MAVS'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
                <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoavosinh.php?mavs='.$value['MAVS'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
              </td>
          </tr>';     
          }
          echo'
          </table>';
      }
    }
}
//-------------lọc
if (isset($_GET['boloc'])) 
{
    $mamaudai=$_GET['mamaudai'];
    $makhoahoc=$_GET['makhoahoc'];
    $tinhtrang=$_GET['tinhtrang'];
    $ngaynhaphoc=$_GET['ngaynhaphoc'];
    $ngaythidai=$_GET['ngaythidai'];
    //xử lý lọc
    $filter  = array(
    'mamaudai'     => isset($_GET['mamaudai']) ? mysqli_escape_string($db->__conn,$mamaudai) : false,
    'makhoahoc'     => isset($_GET['makhoahoc']) ? mysqli_escape_string($db->__conn,$makhoahoc) : false,
    'tinhtrang'   => isset($_GET['tinhtrang']) ? mysqli_escape_string($db->__conn,$tinhtrang) : false,
    'ngaynhaphoc'  => isset($_GET['ngaynhaphoc']) ? mysqli_escape_string($db->__conn,$ngaynhaphoc) : false,
    'ngaythidai'  => isset($_GET['ngaythidai']) ? mysqli_escape_string($db->__conn,$ngaythidai) : false
    );
  $where = array();
  // Nếu có chọn lọc thì thêm điều kiện vào mảng
  if ($filter['mamaudai'])
  {
      $where[] = "vosinh.mamaudai = '{$filter['mamaudai']}'";
  }
  if ($filter['makhoahoc']){
      $where[] = "khoahoc.MAKH = '{$filter['makhoahoc']}'";
  } 
  if ($filter['tinhtrang']){
      $where[] = "vosinh.tinhtrang = '{$filter['tinhtrang']}'";
  } 
  if ($filter['ngaynhaphoc']){
      $where[] = "thongtinvosinh.ngaynhaphoc = '{$filter['ngaynhaphoc']}'";
  }
  if ($filter['ngaythidai']){
      $where[] = "ngaythidai = '{$filter['ngaythidai']}'";
  }
  if ($where!=null)
  {
  //phân trang
    $sql2="SELECT count(vosinh.MAVS) as tongvs,vosinh.MAVS,vosinh.TENVS,GIOITINH,NGAYSINH,maudai.TENMAUDAI,khoahoc.TENKHOAHOC,thongtinvosinh.NGAYNHAPHOC,NGAYTHIDAI,vosinh.TINHTRANG FROM vosinh INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN thongtinvosinh on vosinh.MAVS=thongtinvosinh.MAVS";
    $sql2 .= ' WHERE '.implode(' AND ', $where);
    $sovs= $db->get_list($sql2);
    $tongvosinh=0;
    foreach ($sovs as $value) {
      $tongvosinh=$value['tongvs'];
    }
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit =5; 

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
      echo '
      <h4 class="text-danger text-center">Kết quả lọc</h4>
      <h4 class="text-danger">Không có thông tin</h4>';
    }else
    {
      //-------------
      $sql = "SELECT vosinh.MAVS,vosinh.TENVS,GIOITINH,NGAYSINH,maudai.TENMAUDAI,khoahoc.TENKHOAHOC,thongtinvosinh.NGAYNHAPHOC,NGAYTHIDAI,vosinh.TINHTRANG FROM vosinh INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN thongtinvosinh on vosinh.MAVS=thongtinvosinh.MAVS";
      $sql .= ' WHERE '.implode(' AND ', $where);
      $sql .= ' ORDER BY vosinh.MAVS LIMIT '.$start.','.$limit.'';
      $ds = $db->get_list($sql);
      if($ds==null)
      {
        echo '
      <h4 class="text-danger text-center">Kết quả lọc</h4>
      <h4 class="text-danger">Không có thông tin</h4>';
      }
      else
      {
      $urll=$_SERVER['REQUEST_URI'];
      $_SESSION['url']=$urll;
      echo '
      <div>
      <h4 class="text-danger text-center">Kết quả lọc</h4>
      <table class="table bg-light table-bordered">
          <tr>
            <th class="text-center" style=" width: 60px">Mã võ sinh</th>
            <th class="text-center" style="width: 150px">Tên võ sinh</th>
            <th class="text-center" style="width: 60px">Giới tính</th>
            <th class="text-center" style="width: 100px">Ngày sinh</th>
            <th class="text-center" style="width: 100px">Khóa học</th>
            <th class="text-center" style="width: 160px">Ngày nhập học</th>
            <th class="text-center" style="width: 140px">Ngày thi đai</th>
            <th class="text-center" style="width: 100px">Màu đai</th>
            <th class="text-center" style="width: 100px">Tình trạng</th>
            <th class="text-center" style="width: 20px">Tools</th>
          </tr>';
        foreach ($ds as $value) {
          $ngaysinh=date("d-m-Y", strtotime($value['NGAYSINH']));
          $ngaynhaphoc=date("d-m-Y", strtotime($value['NGAYNHAPHOC']));
          $ngaythidai=date("d-m-Y", strtotime($value['NGAYTHIDAI']));
          if($value['TINHTRANG']==1)
          {
            $tinhtrang="Đang học";
          }else
          if($value['TINHTRANG']==2)
          {
            $tinhtrang="Nghỉ học";
          }else
          if($value['TINHTRANG']==3)
          {
            $tinhtrang="Học tiếp";
          }
        echo'
        <tr>
            <td class="text-center">'.$value["MAVS"].'</td>
            <td class="text-center">'.$value["TENVS"].'</td>
            <td class="text-center">'.$value["GIOITINH"].'</td>
            <td class="text-center">'.$ngaysinh.'</td>
            <td class="text-center">'.$value["TENKHOAHOC"].'</td>
            <td class="text-center">'.$ngaynhaphoc.'</td>
            <td class="text-center">'.$ngaythidai.'</td>
            <td class="text-center">'.$value["TENMAUDAI"].'</td>
            <td class="text-center">'.$tinhtrang.'</td>
            <td class="text-center">
              <a class="text-dark border rounded ml-2 bg-info" href="capnhatvosinh_chitiet.php?mavs='.$value['MAVS'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
              <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoavosinh.php?mavs='.$value['MAVS'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
            </td>
        </tr>';     
        }
        echo'
      </table>
      </div>
      <div class="pagination justify-content-center">';
          if ($current_page > 1 && $total_page > 1)
          {
            echo '<a class="page-link" href="?page='.($current_page-1).'">Prev</a> ';
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
  }
}else
  {
    echo '
      <h4 class="text-danger text-center">Kết quả lọc</h4>
      <h4 class="">Vui lòng nhập thông tin</h4>';
  } 
}
?>

  
