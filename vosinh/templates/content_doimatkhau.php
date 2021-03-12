<?php
echo '
<div>
  <h3 class="text-center text-danger mt-3">Đổi mật khẩu</h3>
  <form action="php/xulydoimatkhau.php" method="POST" id="doimatkhau">
        <div class="row">
            <div class="col-sm-12">  
                <div class="form-group">
                    <label>Nhập mật khẩu mới</label>
                    <input type="password" class="form-control" id="matkhaumoi" placeholder="Nhập mật khẩu mới" name="matkhaumoi">
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" id="xacnhanmatkhau" placeholder="Nhập lại mật khẩu mới" name="xacnhanmatkhau">
                </div>
            </div>
            <button type="submit" class="btn btn-primary luuthongtin" name="save">Lưu thông tin</button>
        </div>
    </form> 	
</div>';
?>
<script type="text/javascript">
      $('#doimatkhau').validate({
      rules:{
        matkhaumoi:{
          required:true,
        },
        xacnhanmatkhau:{
          required:true, 
          equalTo: "#matkhaumoi"
        },
      },
      messages:{
        matkhaumoi:{
          required:"Vui lòng nhập mật khẩu mới",
        },
        xacnhanmatkhau:{
          required:"Vui lòng nhập lại mật khẩu mới",
          equalTo:"Mật khẩu không trùng nhau"
        },
      }
    })
</script> 