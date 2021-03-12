<div>
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoanthu= new khoanthu();
    $dskt= $khoanthu->select_khoanthu();
    echo '
      <h2 class="text-danger text-center mt-2">DANH SÁCH KHOẢN THU</h2>
      <div class="d-flex">
        <form action="#" method="get" class="formtimkiem">
          <span>Nhập để tìm kiếm:</span>
          <input type="text" size="60" name="search" class="border rounded ">
          <input type="submit" class="border rounded bg-primary text-white" value="Tìm kiếm">
        </form>
      </div>
      <table class="table bg-light table-bordered mt-3">
        <tr>
          <th class="text-center" style=" width: 150px">Mã khoản thu</th>
          <th class="text-center" style="width: 200px">Tên khoản thu</th>
          <th class="text-center" style="width: 120px">Mức đóng</th>
          <th class="text-center" style="width: 80px">Ngày tháng bắt đầu</th>
          <th class="text-center" style="width: 80px">Trạng thái</th>
          <th class="text-center" style="width: 20px">Tools</th>
        </tr>';
        foreach ($dskt as $key => $value) {
          $mucdong=number_format($value['MUCDONG']);
          $ngaythang=date('d-m-Y',strtotime($value['NGAYTHANG']));
          if($value['TRANGTHAI']==2)
          {
            $trangthai="Không dùng";
          }else
          if($value['TRANGTHAI']==1)
          {
            $trangthai="Đang dùng";
          }
            echo'
                <tr>
                  <td class="text-center">'.$value['MAKHOANTHU'].'</td>
                  <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                  <td class="text-center">'.$mucdong.' VNĐ</td>
                  <td class="text-center">'.$ngaythang.'</td>
                  <td class="text-center">'.$trangthai.'</td>
                  <td class="text-center">
                    <a class="text-dark border rounded ml-2 bg-info" href="capnhatkhoanthu.php?makhoanthu='.$value['MAKHOANTHU'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
                    <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoakhoanthu.php?makhoanthu='.$value['MAKHOANTHU'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
                  </td>
            </tr>';
        }
       echo' 
      </table> 
</div>
</div>';
?>