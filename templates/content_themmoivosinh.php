<div>
  <?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $vosinh= new vosinh();
    $maudai = new maudai();
    $dsmd = $maudai->select_maudai();
    $khoahoc= new khoahoc();
    $dskh= $khoahoc->select_khoahoc();

    if(isset($_SESSION['thongbao']))
    {
      if($_SESSION['thongbao']=="Thêm võ sinh thành công")
      {
        echo '<div class="alert alert-success">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);
      }else
      if($_SESSION['thongbao']=="Mã võ sinh đã tồn tại, vui lòng nhập lại")
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
  <h3 class="text-center text-danger mt-3">Nhập thông tin võ sinh mới</h3>
  <form action="php/xulythemvosinh.php" method="POST" id="vosinh" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Tên võ sinh</label>
                    <input type="text" class="form-control" id="tenvosinh" name="tenvosinh" placeholder="Nhập tên võ sinh">
                </div>  
                <div class="form-group">
                    <label>Mã võ sinh</label>
                    <input type="text" class="form-control" id="mavosinh" name="mavosinh" placeholder="Nhập mã võ sinh">
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
                    <label>Giới tính</label>
                    <select name="gioitinh" class="form-control">
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="form-control" id="dienthoai"name="dienthoai"  placeholder="Nhập điện thoại">
                </div>
                <div class="form-group">
                    <label>Màu đai</label>
                    <select name="maudai" class="form-control">';
                     foreach ($dsmd as $key => $value) {
                        echo'
                          <option value="'.$value["MAMAUDAI"].'">'.$value["TENMAUDAI"].'</option>'
                        ;
                      } 
                echo'
                </select>     
                </div>
                <div class="form-group">
                    <label>Khóa học</label>
                    <select name="khoahoc" class="form-control">';
                    foreach ($dskh as $key => $value) {
                      echo '<option value="'.$value["MAKH"].'">'.$value["TENKHOAHOC"].'</option>';
                    }                      
                echo '    
                    </select>
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <br>
                    <textarea name="ghichu" rows="3" cols="90"></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Tên phụ huynh</label>
                    <input type="text" class="form-control" name="tenph" placeholder="Nhập tên phụ huynh">
                </div>
                <div class="form-group">
                    <label>Số điện thoại phụ huynh</label>
                    <input type="text" class="form-control" name="sdtph"placeholder="Nhập điện thoại phụ huynh">
                </div>
                <div class="form-group">
                    <label>Ngày nhập học</label>
                    <input type="date" class="form-control" id="ngaynhaphoc" name="ngaynhaphoc">
                </div>
                <div class="form-group">
                    <label>Tình trạng</label>
                    <select name="tinhtrang" class="form-control">
                      <option value="1">Đang học</option>
                      <option value="2">Nghỉ học</option>
                    </select>
                </div>
                <div class="form-group">
                  <br>
                  <label>Số dư</label>
                  <input type="text" class="form-control" name="sodu" readonly value="0">
                </div>                   
                <div class="form-group">
                  <label for="img">Ảnh võ sinh: </label>
                  <input type="file" class="form-control-file" name="anhvs">
                </div> 
            </div>
            <input type="submit" class="btn btn-primary luuthongtin" name="save" value="Lưu thông tin">
        </div>
  </form>';
 
?>
<script type="text/javascript">
      $('#vosinh').validate({
      rules:{
        mavosinh:{
          required:true,
        },
        tenvosinh:{
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
        mavosinh:{
          required:"Vui lòng nhập mã võ sinh",
        },
        tenvosinh:{
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
    });
</script> 
