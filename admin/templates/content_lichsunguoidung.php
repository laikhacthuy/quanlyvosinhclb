<div>
    <h2 class="text-danger text-center mt-2">LỊCH SỬ NGƯỜI DÙNG</h2>
    <?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $nguoidung_log = new nguoidung_log();
    
    //phân trang
      $sql_tonguh="select count(ID) as tonguh from nguoidung_log ";
      $demuh = $db->get_list($sql_tonguh);
      $tongungho=0;
      foreach ($demuh as $value) {
        $tongungho=$value['tonguh'];
      }
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $limit = 10; 

      $total_page = ceil($tongungho / $limit);
      if ($current_page > $total_page){
        $current_page = $total_page;
      }
      else if ($current_page < 1){
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
        //-------------
        $sql = "SELECT * FROM nguoidung_log";
        $sql .= ' LIMIT '.$start.','.$limit.'';
        $lichsu = $db->get_list($sql);
    echo'
    <div class="d-flex">
      <form action="#" method="get" class="formtimkiem">
        <span>Nhập để tìm kiếm:</span>
        <input type="text" size="60" name="search" class="border rounded ">
        <input type="submit" class="border rounded bg-primary text-white" value="Tìm kiếm">
      </form>
    </div>
    <table class="table bg-light table-bordered mt-3">
      <tr>
        <th class="text-center" style=" width: 10%">STT</th>
        <th class="text-center" style="width: 20%">Tài khoản</th>
        <th class="text-center" style="width: 50%">Sự kiện</th>
        <th class="text-center" style="width: 20%">Ngày giờ</th>
      </tr>';
      foreach ($lichsu as $key => $value) {
        $ngaygio=date('d-m-Y H:m:s',strtotime($value['NGAYGIO']));
        echo '
      <tr>
            <td class="text-center">'.$value['ID'].'</td>
            <td class="text-center">'.$value['TAIKHOAN'].'</td>
            <td class="text-center">'.$value['SUKIEN'].'</td>
            <td class="text-center">'.$ngaygio.'</td>
      </tr>';
      }
      echo'
    </table>
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
        </div> 
</div>  
</div>';
?>