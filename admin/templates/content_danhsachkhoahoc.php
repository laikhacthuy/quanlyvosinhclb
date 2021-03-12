<div>
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoahoc= new khoahoc();
    $dskh= $khoahoc->select_khoahoc();
echo '
    <h2 class="text-danger text-center mt-2">DANH SÁCH KHÓA HỌC</h2>
    <table class="table bg-light table-bordered mt-3">
      <tr>
        <th class="text-center" style=" width: 30%">Mã khóa học</th>
        <th class="text-center" style="width: 40%">Tên khóa học</th>
        <th class="text-center" style="width: 20%">Năm học</th>
        <th class="text-center" style="width: 20%">Tools</th>
      </tr>';
      foreach ($dskh as $key => $value) {
        $namhoc=date('d-m-Y',strtotime($value['NAMHOC']));
        echo '
      <tr>
            <td class="text-center">'.$value['MAKH'].'</td>
            <td class="text-center">'.$value['TENKHOAHOC'].'</td>
            <td class="text-center">'.$namhoc.'</td>
            <td class="text-center">
              <a class="text-dark border rounded ml-2 bg-info" href="capnhatkhoahoc.php?makh='.$value['MAKH'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
              <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoakhoahoc.php?makh='.$value['MAKH'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
            </td>
      </tr>';
    }
    echo '
    </table> 
</div>  
</div>';
?>