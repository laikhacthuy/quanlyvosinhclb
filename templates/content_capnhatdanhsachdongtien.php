<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $mavs=$_GET['mavs'];
    $makhoanthu=$_GET['makhoanthu'];
    $makhoahoc=$_GET['makhoahoc'];
    $check=$_GET['check'];
    $tongtienbd=0;
    $tongtiencc=0;
    $khoanthu = new khoanthu();
    $vosinh = new vosinh();
    $sodu=$vosinh->select_sodu($mavs);
    $mucdong;
    $sodumoi=0;
    if (isset($_POST['tinhtrang'])) 
    {
      $_SESSION['makhoanthu']=$_POST['tinhtrang'];
      foreach($_POST['tinhtrang'] as $value) 
      	{
       		$mucdong=$khoanthu->select_mucdong($value);
          foreach ($mucdong as $value) {
            $mucdongcv=$value;
            $tongtienbd=$mucdongcv;
            $tongtiencc+=$tongtienbd;
          }
      	}
        $tongtien=number_format($tongtiencc);
        echo'
        <form action="php/xulycapnhatdsdong.php?mavs='.$mavs.'&check='.$check.'&makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'" method="POST" class="mt-3">
          <h5>Tổng cộng:</h5>
          <input type="text" name="tongtien" id="tongtien" value="'.$tongtiencc.'" readonly>';
          foreach ($sodu as $value) {
            echo'<h5>Số dư ban đầu:</h5>
            <input type="text" name="sodubandau" id="sodubandau" value="'.$value.'" readonly>';
          }
          echo'
          <br>
          <h5>Số tiền nhận:</h5>
          <input type="text" placeholder="Nhập số tiền thực thu" name="sotienthucthu" id="sotienthucthu" onchange=sodumoi()>
          <br>
          <h5 class="mt-2">Số dư mới:</h5>
          <input type="text" name="sodu" id="sodu" readonly>
          <br>
          <input type="submit" value="Cập nhật" class="btn-warning mt-2" name="capnhat">
        </form>
        <br/>
        <div class="text-primary">
          <a href="'.$_SESSION['urldongtienhoc'].'">Quay lại trang trước</a>
        </div>
        ';  
	}
  else
  {
    echo '<script> alert("Vui lòng chọn một khoản thu để đóng");
            window.location="http://localhost/quanlylopvo/dongtienhoc.php?mavs='.$mavs.'&check='.$check.'&makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'";
          </script>   	 
         '; 
  }  
?>
<script>
  function sodumoi() {
    var tongtien=document.getElementById('tongtien').value
    const tongtien2= Number(tongtien)
    var sodubandau= document.getElementById('sodubandau').value
    const sodubandau2= Number(sodubandau)
    var sotienthucthu = document.getElementById('sotienthucthu').value
    const sotienthucthu2= Number(sotienthucthu)
    var sodumoi=0
    var tongtienthu
    tongtienthu=sotienthucthu2+sodubandau2
    sodumoi=tongtienthu-tongtien2
    document.getElementById('sodu').value=sodumoi;
}
</script>