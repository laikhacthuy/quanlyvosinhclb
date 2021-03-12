<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $mavosinh=$_GET['mavs'];
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $dsvs = $vosinh->list_vosinhcapnhat($mavosinh);
    $maudai = new maudai();
    $dsmd = $maudai->select_maudai();
    $khoahoc= new khoahoc();
    $dskh= $khoahoc->select_khoahoc();
    if(isset($_SESSION['thongbao']))
    {
      echo '<div class="alert alert-success">';
      echo $_SESSION['thongbao'];
      echo'</div>
      <div class="text-primary">
        <a href="danhsachvosinh.php">Quay lại trang trước</a>
      </div>';
      unset($_SESSION['thongbao']);
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo '<div>
  <h3 class="text-center text-danger mt-3">Cập nhật thông tin võ sinh</h3>
  <form action="php/xulycapnhatvosinh.php" method="POST" id="thongtinvosinh" enctype="multipart/form-data">
        <div class="row">';
        foreach ($dsvs as $key => $value) {
          $tinhtrang;
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
          echo '
            <div class="col-sm-6">  
                <div class="form-group">
                    <label>Mã võ sinh</label>
                    <input type="text" class="form-control" readonly value="'.$value['MAVS'].'" name="mavs">
                </div>
                <div class="form-group">
                    <label>Tên võ sinh</label>
                    <input type="text" class="form-control" id="tenvosinh" value="'.$value['TENVS'].'" name="tenvs">
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" class="form-control" id="ngaysinh" value="'.$value['NGAYSINH'].'" name="ngaysinh">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" id="diachi" value="'.$value['DIACHI'].'" name="diachi">
                </div>
                <div class="form-group">
                    <label>Giới tính</label>
                    <select id="gioitinh" name="gioitinh" class="form-control">
                      <option value="'.$value['GIOITINH'].'" select="selected">'.$value['GIOITINH'].'</option>
                      <option value="">---Chọn---</option>
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="form-control" id="dienthoai" value="'.$value['DIENTHOAI'].'" name="dienthoai">
                </div>
                <div class="form-group">
                    <label>Màu đai</label>
                    <select id="maudai" name="maudai" class="form-control">
                      <option select="selected" value="'.$value['MAMAUDAI'].'">'.$value['TENMAUDAI'].'</option>
                      <option value="">---Chọn---</option>';
                      foreach ($dsmd as $key => $value) {
                        echo '<option value="'.$value['MAMAUDAI'].'">'.$value['TENMAUDAI'].'</option>';
                      }
          }
          foreach ($dsvs as $key => $value) {
              echo' </select>
                </div>
                <div class="form-group">
                    <label>Khóa học</label>
                    <select id="khoahoc" name="khoahoc" class="form-control">
                      <option value="'.$value['MAKH'].'" select="selected">'.$value['TENKHOAHOC'].'</option>
                      <option value="">---Chọn---</option>';
                      foreach ($dskh as $key => $value) {
                      echo '<option value="'.$value["MAKH"].'">'.$value["TENKHOAHOC"].'</option>';
                    }
          } 
          foreach ($dsvs as $key => $value) { 
              echo' </select>
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <br>
                    <textarea id="ghichu" name="ghichu" rows="3" cols="90">'.$value['GHICHU'].'</textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Tên phụ huynh</label>
                    <input type="text" class="form-control" value="'.$value['TENPHUHUYNH'].'" name="tenph">
                </div>
                <div class="form-group">
                    <label>Số điện thoại phụ huynh</label>
                    <input type="text" class="form-control" value="'.$value['DIENTHOAIPH'].'" name="sdtph">
                </div>
                <div class="form-group">
                    <label>Ngày nhập học</label>
                    <input type="date" class="form-control" id="ngaynhaphoc" value="'.$value['NGAYNHAPHOC'].'" name="ngaynhaphoc">
                </div>
                <div class="form-group">
                    <label>Ngày thi đai</label>
                    <input type="date" class="form-control" id="ngaythidai" value="'.$value['NGAYTHIDAI'].'" name="ngaythidai">
                </div>
                <div class="form-group">
                    <label>Tình trạng</label>
                    <select id="tinhtrang" name="tinhtrang" class="form-control">
                      <option value="'.$value['TINHTRANG'].'" select="selected">'.$tinhtrang.'</option>
                      <option value="">---Chọn---</option>
                      <option value="1">Đang học</option>
                      <option value="2">Nghỉ học</option>
                      <option value="3">Học tiếp</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="img">Ảnh võ sinh: </label>
                  <input type="file" class="form-control-file" name="anhvs">
                  <br>
                  <img src="images/'.$value['ANH'].'" class="img_nguoidung">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Số dư</label>
                  <input type="text" class="form-control" name="sodu" value="'.$value['SODU'].'">
                </div>
                </div> 
          ';
        echo '    
            <input type="submit" class="btn btn-primary luuthongtin" name="capnhat" value="Cập nhật">
        </div>

    </form>	
</div>';
}
?>
    <script type="text/javascript">
      $('#thongtinvosinh').validate({
      rules:{
        tenvs:{
          required:true,
        },
        ngaysinh:{
          required:true,
        },
        dienthoai:{
          required:true,
          minlength:10,
          maxlength:10
        },
        ngaynhaphoc:{
          required:true,
        }
      },
      messages:{
        tenvs:{
          required:"Vui lòng nhập tên võ sinh",
        },
        ngaysinh:{
          required:"Vui lòng nhập ngày tháng hoặc ngày tháng không hợp lệ",
        },
        dienthoai:{
          required:"Vui lòng nhập điện thoại võ sinh",
          minlength:"Điện thoại có 10 số",
          maxlength:"Điện thoại có 10 số"
        },
        ngaynhaphoc:{
          required:"Vui lòng nhập ngày tháng hoặc ngày tháng không hợp lệ",
        }
      }
    })
</script> 