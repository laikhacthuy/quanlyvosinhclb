<div>
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $taikhoan=$_GET['taikhoan'];
    $nguoidung = new nguoidung();
    $phanquyen = new phanquyen();
    $dsnd= $nguoidung->select_nguoidungbyid($taikhoan);
    $dspq= $phanquyen->select_phanquyen();
    if(isset($_SESSION['tt']))
    {
      if($_SESSION['tt']=="Cập nhật thành công")
      {
        echo '<div class="alert alert-success">';
        echo $_SESSION['tt'];
        echo'</div>
        <div class="text-primary">
        <a href="danhsachnguoidung.php">Quay lại trang trước</a>
        </div>';
        unset($_SESSION['tt']);
      }
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo'
   <h3 class="text-center text-danger mt-3">Cập nhật người dùng</h3>
  <form action="php/xulycapnhatnguoidung.php" method="POST" id="form_capnhat" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">';
        foreach ($dsnd as $key => $value) {
            echo'
                <div class="form-group">
                    <label>Tên người dùng</label>
                    <input type="text" class="form-control" id="tennguoidung" name="tennguoidung" value="'.$value['TENNGUOIDUNG'].'">
                </div>
                <div class="form-group">
                    <label>Tài khoản đăng nhập</label>
                    <input type="text" class="form-control" readonly=""name="taikhoan" value="'.$value['TAIKHOAN'].'">
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" placeholder="*********" name="matkhau">
                </div>
                <div class="form-group">
                    <label>Quyền hạn :</label>
                    <select name="quyenhan">
                      <option value="'.$value['MUCDO'].'" select="selected">'.$value['QUYENHAN'].'</option>
                      <option value="">----</option>';
                      foreach ($dspq as $key => $value) {
                        echo '<option value="'.$value['MUCDO'].'">'.$value['QUYENHAN'].'</option>';
                      }
        }
        foreach ($dsnd as $key => $value) {
                echo'</select>
                </div>
                <div class="form-group">
                    <label>Ảnh: </label><br>
                    <img src="images/'.$value['ANH'].'" width="150" height="150" class="img_nguoidung">
                    <br>
                    <input type="file" class="form-control-file" id="anh" style="margin-top: 10px;" name="anhvs">
                </div>';
        }
        echo'   
            </div>
            <button type="submit" class="btn btn-primary luuthongtin" name="capnhat">Cập nhật thông tin</button>
        </div>
    </form> 
</div>  
</div>';
?>
<script type="text/javascript">
    $('#form_capnhat').validate({
      rules:{
        tennguoidung:{
          required:true,
          minlength:5
        },
      },
      messages:{
        tennguoidung:{
          required:"Vui lòng nhập tên người dùng",
          minlength:"Nhập 5 ký tự trở lên"
        },
      }
    })
</script> 