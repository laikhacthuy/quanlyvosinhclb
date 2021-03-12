<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $ungho= new ungho();
    //phân trang
    $sql_tongvs="select count(ID) as tongvs from ungho";
    $demvs = $db->get_list($sql_tongvs);
    $tongvosinh=0;
    foreach ($demvs as $value) {
      $tongvosinh=$value['tongvs'];
    }
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5; 

    $total_page = ceil($tongvosinh / $limit);
    if ($current_page > $total_page){
      $current_page = $total_page;
    }
    else if ($current_page < 1){
      $current_page = 1;
    }
    $start = ($current_page - 1) * $limit;
    $sql="SELECT * FROM ungho";
    $sql .= ' ORDER BY ID LIMIT '.$start.','.$limit.'';
    $dsuh = $db->get_list($sql);
echo'
<div>
      <div class="d-flex">
        <form action="" method="get" class="formtimkiem">
          <span>Nhập để tìm kiếm:</span>
          <input type="text" size="80" name="timkiem" class="border rounded ">
          <input type="submit" class="border rounded bg-primary text-white" value="Tìm kiếm" name="search">
        </form>
      </div>';
if(isset($_GET['timkiem']))
{
  $timkiem=$_GET['timkiem'];
  $timkiemungho=$ungho->select_ten_sdt($timkiem,$timkiem);
  if($timkiemungho==null)
  {
    echo '
    <h4 class="text-danger text-center mt-3">Không có thông tin người ủng hộ</h4>';
  }
  else
  {
    echo'
      <h3 class="text-danger text-center mt-3">KẾT QUẢ TÌM KIẾM</h3>
      <table class="table bg-light table-bordered mt-3">
        <tr>
          <th class="text-center" style=" width: 120px">STT</th>
          <th class="text-center" style="width: 120px">Tên người ủng hộ</th>
          <th class="text-center" style="width: 100px">Số điện thoại</th>
          <th class="text-center" style="width: 150px">Số tiền ủng hộ</th>
          <th class="text-center" style="width: 100px">Ngày đóng</th>
          <th class="text-center" style="width: 20px">Tools</th>
        </tr>';
        foreach ($timkiemungho as $key => $value) {
          $ngayungho=date("d-m-Y", strtotime($value['NGAYDONG']));
          $tienungho = number_format($value['SOTIENDONG']);
          echo '
                <tr>
                    <td class="text-center">'.$value['ID'].'</td>
                    <td class="text-center">'.$value['TENNGUOIUNGHO'].'</td>
                    <td class="text-center">'.$value['SDT'].'</td>
                    <td class="text-center">'.$tienungho.' VNĐ</td>
                    <td class="text-center">'.$ngayungho.'</td>
                    <td class="text-center">
                      <a class="text-dark border rounded ml-2 bg-info" href="capnhatungho_chitiet.php?id='.$value['ID'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
                      <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoaungho.php?id='.$value['ID'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
                    </td>
              </tr>';
        }
       echo' 
      </table>
      <hr width="60%" color="blue"/>';
  }
}   
echo' 
<h2 class="text-danger text-center mt-2">DANH SÁCH ỦNG HỘ</h2>
      <table class="table bg-light table-bordered mt-3">
        <tr>
          <th class="text-center" style=" width: 120px">STT</th>
          <th class="text-center" style="width: 120px">Tên người ủng hộ</th>
          <th class="text-center" style="width: 100px">Số điện thoại</th>
          <th class="text-center" style="width: 150px">Số tiền ủng hộ</th>
          <th class="text-center" style="width: 100px">Ngày đóng</th>
          <th class="text-center" style="width: 20px">Tools</th>
        </tr>';
        foreach ($dsuh as $key => $value) {
          $ngayungho=date("d-m-Y", strtotime($value['NGAYDONG']));
          $tienungho = number_format($value['SOTIENDONG']);
          echo '
                <tr>
                    <td class="text-center">'.$value['ID'].'</td>
                    <td class="text-center">'.$value['TENNGUOIUNGHO'].'</td>
                    <td class="text-center">'.$value['SDT'].'</td>
                    <td class="text-center">'.$tienungho.' VNĐ</td>
                    <td class="text-center">'.$ngayungho.'</td>
                    <td class="text-center">
                      <a class="text-dark border rounded ml-2 bg-info" href="capnhatungho_chitiet.php?id='.$value['ID'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
                      <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoaungho.php?id='.$value['ID'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
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
              echo '<a class="page-link" href="?page='.$i.'">'.$i.'</a> ';
            }
          }
          if ($current_page < $total_page && $total_page > 1)
          {
            echo '<a class="page-link" href="?page='.($current_page+1).'">Next</a> ';
          }
          echo'
</div>';
?>