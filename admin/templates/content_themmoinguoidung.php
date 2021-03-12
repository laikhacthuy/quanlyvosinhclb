<div>   
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $phanquyen= new phanquyen();
    $dspq= $phanquyen->select_phanquyen();
    if(isset($_SESSION['tt']))
    {
      if($_SESSION['tt']=="Thêm người dùng thành công")
      {
        echo '<div class="alert alert-success">';
        echo $_SESSION['tt'];
        echo'</div>';
        unset($_SESSION['tt']);
      }else
      if($_SESSION['tt']=="Mã đã tồn tại, vui lòng nhập lại")
      {
        echo '<div class="alert alert-danger">';
        echo $_SESSION['tt'];
        echo'</div>';
        unset($_SESSION['tt']);
      }
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo' <h3 class="text-center text-danger mt-3">Thêm mới người dùng</h3>
    <form action="php/xulythemnguoidung.php" method="POST" id="form-register" enctype="multipart/form-data">
          <div class="row">
              <div class="col-sm-12">  
                  <div class="form-group">
                      <label>Tài khoản đăng nhập</label>
                      <input type="text" class="form-control" id="taikhoan" name="taikhoan" placeholder="Nhập tài khoản đăng nhập">
                  </div>
                  <div class="form-group">
                      <label>Mật khẩu</label>
                      <input type="password" class="form-control" id="new_password" name="new_password" placeholder="*********">
                  </div>
                  <div class="form-group">
                      <label>Nhập nhận lại mật khẩu</label>
                      <input type="password" class="form-control" id="current_password" name="current_password" placeholder="********">
                  </div>
                  <div class="form-group">
                      <label>Tên người dùng</label>
                      <input type="text" class="form-control" id="tennguoidung" name="tennguoidung" placeholder="Nhập tên người dùng">
                  </div>                  
                  <div class="form-group">
                      <label>Quyền hạn :</label>
                      <select name="quyenhan">';
                      foreach ($dspq as $key => $value) {
                        echo '<option value="'.$value['MUCDO'].'">'.$value['QUYENHAN'].'</option>';
                      }
                        
echo'                 </select>
                  </div>
                  <div class="form-group">
                      <label>Ảnh: </label>
                      <input type="file" class="form-control-file" name="anhvs">
                  </div>
              </div>
              <button type="submit" class="btn btn-primary luuthongtin" name="save">Lưu thông tin</button>
          </div>
      </form>
      </div>
</div>';
?>
<script type="text/javascript">
    $('#form-register').validate({
      rules:{
        taikhoan:{
          required:true,
          minlength:3
        },
        new_password:{
          required:true,
          minlength:3
        },
        tennguoidung:{
          required:true,
          minlength:5
        },
        current_password:{
          required:true,
          equalTo:"#new_password"
        }
      },
      messages:{
        taikhoan:{
          required:"Vui lòng nhập tài khoản",
          minlength:"Nhập 3 ký tự trở lên"
        },
        new_password:{
          required:"Vui lòng nhập mật khẩu",
          minlength:"Nhập 3 ký tự trở lên"
        },
        tennguoidung:{
          required:"Vui lòng nhập tên người dùng",
          minlength:"Nhập 5 ký tự trở lên"
        },
        current_password:{
          required:"Vui lòng nhập lại mật khẩu",
          equalTo:"Mật khẩu nhập lại không chính xác"
        }
      }
    })
</script> 
