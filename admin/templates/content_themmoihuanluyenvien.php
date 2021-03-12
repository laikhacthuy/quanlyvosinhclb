<div>
  <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    if(isset($_SESSION['thongbao']))
    {
      if($_SESSION['thongbao']=="Thêm huấn luyện viên thành công")
      {
        echo '<div class="alert alert-success">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);
      }else
      if($_SESSION['thongbao']=="Mã đã tồn tại, vui lòng nhập lại")
      {
        echo '<div class="alert alert-danger">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);
      }
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo'
  <h3 class="text-center text-danger mt-3">Nhập thông tin huấn luyện viên mới</h3>
  <form action="php/xulythemhuanluyenvien.php" method="POST" id="hlv" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mã huấn luyện viên</label>
                    <input type="text" class="form-control" id="mahlv" name="mahlv" placeholder="Nhập mã huấn luyện viên">
                </div>  
                <div class="form-group">
                    <label>Tên huấn luyện viên</label>
                    <input type="text" class="form-control" id="tenhlv" name="tenhlv" placeholder="Nhập tên huấn luyện viên">
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh">
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" name="diachi" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="form-control" id="dienthoai"name="dienthoai"  placeholder="Nhập điện thoại">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Màu đai</label>
                    <select name="maudai" class="form-control" id="maudai">
                      <option value="">---Chọn---</option> 
                      <option value="Đai đen nhất đẳng">Đai đen nhất đẳng</option>
                      <option value="Đai đen nhị đẳng">Đai đen nhị đẳng</option>
                      <option value="Đai đen tam đẳng">Đai đen tam đẳng</option>
                      <option value="Đai đen tứ đẳng">Đai đen tứ đẳng</option>
                      <option value="Đai đen ngũ đẳng">Đai đen ngũ đẳng</option>
                      <option value="Đai đen lục đẳng">Đai đen lục đẳng</option>
                      <option value="Đai đen thất đẳng">Đai đen thất đẳng</option>
                      <option value="Đai đen bát đẳng">Đai đen bát đẳng</option>
                      <option value="Đai đen cửu đẳng">Đai đen cửu đẳng</option>
                      <option value="Đai đen thập đẳng">Đai đen thập đẳng</option>
                    </select>     
                </div>
                <div class="form-group">
                    <label>Ngày vào dạy</label>
                    <input type="date" class="form-control" id="ngayvaoday" name="ngayvaoday">
                </div>
                <div class="form-group">
                    <label>Tình trạng</label>
                    <input type="text" class="form-control" id="tinhtrang" name="tinhtrang"  value="Đang dạy">
                </div>                
                <div class="form-group">
                  <label for="img">Ảnh huấn luyện viên: </label>
                  <input type="file" class="form-control-file" name="anhhlv">
                </div> 
            </div>
            <input type="submit" class="btn btn-primary luuthongtin" name="save" value="Lưu thông tin">
        </div>
  </form>';
?>
<script type="text/javascript">
      $('#hlv').validate({
      rules:{
        mahlv:{
          required:true,
        },
        tenhlv:{
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
        ngayvaoday:{
          required:true,
        },
        maudai:{
          required:true,
        }
      },
      messages:{
        mahlv:{
          required:"Vui lòng nhập mã huấn luyện viên",
        },
        tenhlv:{
          required:"Vui lòng nhập tên huấn luyện viên",
        },
        ngaysinh:{
          required:"Vui lòng nhập ngày tháng hoặc ngày tháng không hợp lệ",
        },
        dienthoai:{
          required:"Vui lòng nhập điện thoại huấn luyện viên",
          minlength:"Điện thoại có 10 số",
          maxlength:"Điện thoại có 10 số"
        },
        ngayvaoday:{
          required:"Vui lòng nhập ngày tháng hoặc ngày tháng không hợp lệ",
        },
        maudai:{
          required:"Vui lòng chọn màu đai",
        }
      }
    });
</script> 
