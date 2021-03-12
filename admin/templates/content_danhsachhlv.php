<div>
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $huanluyenvien = new huanluyenvien();
    $dshlv = $huanluyenvien->select_hlv();

    echo'
    <h2 class="text-danger text-center mt-2">DANH SÁCH HUẤN LUYỆN VIÊN</h2>
    <div class="d-flex">
      <form action="#" method="get" class="formtimkiem">
        <span>Nhập để tìm kiếm:</span>
        <input type="text" size="60" name="search" class="border rounded ">
        <input type="submit" class="border rounded bg-primary text-white" value="Tìm kiếm">
      </form>
    </div>
    <table class="table bg-light table-bordered mt-3">
      <tr>
        <th class="text-center" style=" width: 20%">Mã huấn luyện viên</th>
        <th class="text-center" style="width: 20%">Tên huấn luyện viên</th>
        <th class="text-center" style="width: 20%">Điện thoại</th>
        <th class="text-center" style="width: 20%">Màu đai</th>
        <th class="text-center" style="width: 10%">Tình trạng</th>
        <th class="text-center" style="width: 20%">Tools</th>
      </tr>';
      foreach ($dshlv as $key => $value) {
        echo '
              <tr>
                  <td class="text-center">'.$value['MAHLV'].'</td>
                  <td class="text-center">'.$value['TENHLV'].'</td>
                  <td class="text-center">'.$value['SDT'].'</td>
                  <td class="text-center">'.$value['MAUDAI'].'</td>
                  <td class="text-center">'.$value['TINHTRANG'].'</td>
                  <td class="text-center">
                    <a class="text-dark border rounded ml-2 bg-info" href="capnhathlv.php?mahlv='.$value['MAHLV'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
                    <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoahlv.php?mahlv='.$value['MAHLV'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
                  </td>
            </tr>';
      }
echo'    </table>
</div>  
</div>';
?>