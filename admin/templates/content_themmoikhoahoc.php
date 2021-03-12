<div>
<?php
if(isset($_SESSION['tt']))
    {
      if($_SESSION['tt']=="Thêm khóa học thành công")
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
?>
    <h3 class="text-center text-danger mt-3">Thêm mới khóa học</h3>
    <form action="php/xulythemkhoahoc.php" method="POST" id="khoahoc">
          <div class="row">
              <div class="col-sm-12">  
                  <div class="form-group">
                      <label>Mã khóa học</label>
                      <input type="text" class="form-control" id="makhoahoc" name="makhoahoc" placeholder="Nhập mã khóa học">
                  </div>
                  <div class="form-group">
                      <label>Tên khóa học</label>
                      <input type="text" class="form-control" id="tenkhoahoc" name="tenkhoahoc" placeholder="Nhập tên khóa học">
                  </div>
                  <div class="form-group">
                      <label>Năm học</label>
                      <br>
                      <input type="date" class="form-control" id="namhoc" name="namhoc">
                  </div>
              </div>
              <button type="submit" class="btn btn-primary luuthongtin" name="save">Lưu thông tin</button>
          </div>
      </form> 
</div>  
</div>
<script type="text/javascript">
    $('#khoahoc').validate({
      rules:{
        makhoahoc:{
          required:true,
        },
        tenkhoahoc:{
          required:true,
        },
        namhoc:{
          required:true,
        }
      },
      messages:{
        makhoahoc:{
          required:"Vui lòng nhập mã khoản thu",
        },
        tenkhoahoc:{
          required:"Vui lòng nhập tên khoản thu",
        },
        namhoc:{
          required:"Vui lòng nhập năm học đúng định dạng",
        }
      }
    })
</script> 