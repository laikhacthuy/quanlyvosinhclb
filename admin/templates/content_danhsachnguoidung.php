<div>
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $nguoidung = new nguoidung();
    $dsnd = $nguoidung->select_nguoidung();

    echo'
    <h2 class="text-danger text-center mt-2">DANH SÁCH NGƯỜI DÙNG</h2>
    <div class="d-flex">
      <form action="#" method="get" class="formtimkiem">
        <span>Nhập để tìm kiếm:</span>
        <input type="text" size="60" name="search" class="border rounded ">
        <input type="submit" class="border rounded bg-primary text-white" value="Tìm kiếm">
      </form>
    </div>
    <table class="table bg-light table-bordered mt-3">
      <tr>
        <th class="text-center" style=" width: 30%">Tài khoản</th>
        <th class="text-center" style="width: 30%">Tên người dùng</th>
        <th class="text-center" style="width: 20%">Mức độ</th>
        <th class="text-center" style="width: 20%">Tools</th>
      </tr>';
      foreach ($dsnd as $key => $value) {
        $quyenhan;
        if($value['MUCDO']==0)
        {
          $quyenhan="Adminstrator";
        }else
        if($value['MUCDO']==1)
        {
          $quyenhan="Huấn luyện viên";
        }else
        if($value['MUCDO']==2)
        {
          $quyenhan="Thủ quỹ";
        }else
        if($value['MUCDO']==3)
        {
          $quyenhan="Võ sinh";
        }
        echo '
              <tr>
                  <td class="text-center">'.$value['TAIKHOAN'].'</td>
                  <td class="text-center">'.$value['TENNGUOIDUNG'].'</td>
                  <td class="text-center">'.$quyenhan.'</td>
                  <td class="text-center">
                    <a class="text-dark border rounded ml-2 bg-info" href="capnhatnguoidung.php?taikhoan='.$value['TAIKHOAN'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
                    <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoanguoidung.php?taikhoan='.$value['TAIKHOAN'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
                  </td>
            </tr>';
      }
echo'    </table>
</div>  
</div>';
?>