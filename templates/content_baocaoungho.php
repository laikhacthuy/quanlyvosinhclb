<div>
<?php
      require ("BackEnd/DB_driver.php");
      require ("BackEnd/DB_business.php");
      require ("BackEnd/DB_classes.php");
      $db = new DB_driver();
      $db->connect();
      $ungho = new ungho();
      $tongtien=0;
      //phân trang
      $sql_tonguh="select count(ID) as tonguh from ungho ";
      $demuh = $db->get_list($sql_tonguh);
      $tongungho=0;
      foreach ($demuh as $value) {
        $tongungho=$value['tonguh'];
      }
      $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
      $limit = 5; 

      $total_page = ceil($tongungho / $limit);
      if ($current_page > $total_page){
        $current_page = $total_page;
      }
      else if ($current_page < 1){
        $current_page = 1;
      }
      $start = ($current_page - 1) * $limit;
        //-------------
        $sql = "SELECT * FROM ungho";
        $sql .= ' LIMIT '.$start.','.$limit.'';
        $ds = $db->get_list($sql);
        $sql_tongtien="SELECT SUM(SOTIENDONG) as tong FROM ungho";
        $tt=$db->get_list($sql_tongtien);
        foreach ($tt as $value) {
          $tongtien=$value['tong'];
        }
        echo '
        <div>
        <h2 class="text-danger text-center mt-3">BÁO CÁO TIỀN ỦNG HỘ</h2> 
        <h5 class="text-danger">Tổng tiền: '.number_format($tongtien).' VND</h5>  
        <table class="table bg-light table-bordered">
          <tr>
            <th class="text-center" style=" width: 120px">STT</th>
            <th class="text-center" style="width: 120px">Tên người ủng hộ</th>
            <th class="text-center" style="width: 100px">Số điện thoại</th>
            <th class="text-center" style="width: 150px">Số tiền ủng hộ</th>
            <th class="text-center" style="width: 100px">Ngày đóng</th>
          </tr>';
            foreach ($ds as $value) {
              
              $sotiendong=number_format($value['SOTIENDONG']);
              $ngaydong=date("d-m-Y", strtotime($value['NGAYDONG']));
          echo'
          <tr>
              <td class="text-center">'.$value["ID"].'</td>
              <td class="text-center">'.$value["TENNGUOIUNGHO"].'</td>
              <td class="text-center">'.$value["SDT"].'</td>
              <td class="text-center">'.$sotiendong.' VND</td>
              <td class="text-center">'.$ngaydong.'</td>
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
</div>