<div>
<?php
if(isset($_SESSION['tt']))
    {
      if($_SESSION['tt']=="Thêm khoản thu thành công")
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
  <h3 class="text-center text-danger mt-3">Thêm mới khoản thu</h3>
  <form action="php/xulythemkhoanthu.php" method="POST" id="khoanthu">
        <div class="row">
            <div class="col-sm-12">  
                <div class="form-group">
                    <label>Mã khoản thu</label>
                    <input type="text" class="form-control" id="makhoanthu" name="makhoanthu" placeholder="Nhập mã khoản thu">
                </div>
                <div class="form-group">
                    <label>Tên khoản thu</label>
                    <input type="text" class="form-control" id="tenkhoanthu" name="tenkhoanthu" placeholder="Nhập tên khoản thu">
                </div>
                
                <div class="form-group">
                    <label>Ngày bắt đầu thu</label>
                    <input type="date" class="form-control" id="ngaydong" name="ngaydong">
                </div>
                <div class="form-group">
                    <label>Mức đóng</label>
                    <input type="text" class="form-control" id="mucdong" name="mucdong" placeholder="Nhập số tiền đóng">
                </div>
                <div class="form-group">
                    <label>Trạng thái:</label>
                    <select name="trangthai">
                      <option value="1">Đang dùng</option>
                      <option value="2">Không dùng</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <br>
                    <textarea id="ghichu" name="ghichu" rows="3" cols="100"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary luuthongtin" name="save">Lưu thông tin</button>
        </div>
    </form>     
</div>
</div>
<script type="text/javascript">
    $('#khoanthu').validate({
      rules:{
        makhoanthu:{
          required:true,
        },
        tenkhoanthu:{
          required:true,
          minlength:10
        },
        mucdong:{
          required:true,
          number:true
        },
        ngaydong:{
          required:true,
        }
      },
      messages:{
        makhoanthu:{
          required:"Vui lòng nhập mã khoản thu",
        },
        tenkhoanthu:{
          required:"Vui lòng nhập tên khoản thu",
          minlength:"Nhập 10 ký tự trở lên"
        },
        mucdong:{
          required:"Vui lòng nhập số tiền đóng",
          number:"Nhập định dạng là số"
        },
        ngaydong:{
          required:"Vui lòng nhập ngày bắt đầu đóng",
        }
      }
    })
</script> 
