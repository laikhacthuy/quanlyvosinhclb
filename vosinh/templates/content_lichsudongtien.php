<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $mavosinh=$_SESSION['taikhoan'];
    $db = new DB_driver();
    $db->connect();
    $danhsachdong = new danhsachdong();
    $lsdt=$danhsachdong->baocao_vs($mavosinh);
    $tinhtrang;$tongtien=0;$ngaydong;$no=0;
echo '
<div>
  <h3 class="text-center text-danger mt-3">Lịch sử đóng tiền</h3>
  <table class="table bg-light table-bordered">
        <tr>
          <th class="text-center" style=" width: 60px">Mã võ sinh</th>
          <th class="text-center" style="width: 100px">Tên võ sinh</th>
          <th class="text-center" style="width: 120px">Tên khoản thu</th>
          <th class="text-center" style="width: 100px">Mức đóng</th>
          <th class="text-center" style="width: 100px">Ngày đóng tiền</th>
          <th class="text-center" style="width: 100px">Khóa học</th>
          <th class="text-center" style="width: 80px">Tình trạng</th>
        </tr>';
        foreach ($lsdt as $key => $value) {
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
            $no+=$value['MUCDONG'];
          }else
          {
            $ngaydong=date("d-m-Y", strtotime($value['NGAYDONG']));
            $tongtien+=$value['MUCDONG']; 
          }
        echo'<tr>
            <td class="text-center">'.$value["MAVS"].'</td>
            <td class="text-center">'.$value["TENVS"].'</td>
            <td class="text-center">'.$value["TENKHOANTHU"].'</td>
            <td class="text-center">'.$mucdong.' VND</td>
            <td class="text-center">'.$ngaydong.'</td>
            <td class="text-center">'.$value["TENKHOAHOC"].'</td>
            <td class="text-center">'.$tinhtrang.'</td>
        </tr>'; 
           
        }
        echo'
  </table>
  <h5 class="text-danger">Tổng tiền đã đóng: '.number_format($tongtien).' VND</h5>
  <h5 class="text-danger">Tổng tiền nợ: '.number_format($no).' VND</h5>
</div>';
?>