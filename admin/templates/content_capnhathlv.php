<div>
<?php
require ("../BackEnd/DB_driver.php");
require ("../BackEnd/DB_business.php");
require ("../BackEnd/DB_classes.php");
$db = new DB_driver();
$db->connect();
$mahlv=$_GET['mahlv'];
$huanluyenvien = new huanluyenvien();
$info_hlv=$huanluyenvien->select_hlv_byid($mahlv);
if(isset($_SESSION['thongbao']))
    {
      echo '<div class="alert alert-success">';
      echo $_SESSION['thongbao'];
      echo'</div>
      <div class="text-primary">
        <a href="danhsachhlv.php">Quay lại trang trước</a>
      </div>';
      unset($_SESSION['thongbao']);
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo'
  <h3 class="text-center text-danger mt-3">Thông tin huấn luyện viên</h3>
  <form action="php/xulycapnhathuanluyenvien.php" method="POST" id="hlv" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6">';
            foreach ($info_hlv as $key => $value) {
              echo '
                <div class="form-group">
                    <label>Mã huấn luyện viên</label>
                    <input type="text" class="form-control" id="mahlv" name="mahlv" value="'.$value['MAHLV'].'" readonly>
                </div>  
                <div class="form-group">
                    <label>Tên huấn luyện viên</label>
                    <input type="text" class="form-control" id="tenhlv" name="tenhlv" value="'.$value['TENHLV'].'">
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh" value="'.$value['NGAYSINH'].'">
                </div>
                
                <div class="form-group">
                  <label for="img">Ảnh huấn luyện viên: </label>
                  <img src="images/'.$value['ANH'].'" width="20%" height="30%" class="rounded">
                  <br/>
                  <input type="file" class="form-control-file" name="anhhlv">
                </div> 
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Màu đai</label>
                    <select name="maudai" class="form-control" id="maudai">
                      <option value="'.$value['MAUDAI'].'" select="selected">'.$value['MAUDAI'].'</option>
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
                    <input type="date" class="form-control" id="ngayvaoday" name="ngayvaoday" value="'.$value['NGAYVAO'].'">
                </div>
                <div class="form-group">
                    <label>Tình trạng</label>
                    <select name="tinhtrang" class="form-control" id="tinhtrang">
                      <option value="'.$value['TINHTRANG'].'" select="selected">'.$value['TINHTRANG'].'</option>
                      <option value="">---Chọn---</option> 
                      <option value="Đang dạy">Đang dạy</option>
                      <option value="Nghỉ dạy">Nghỉ dạy</option>
                    </select> 
                </div>                
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" name="diachi" value="'.$value['DIACHI'].'">
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="form-control" id="dienthoai"name="dienthoai" value="'.$value['SDT'].'">
                </div>
            </div>';
          }
          echo'
            <input type="submit" class="btn btn-primary luuthongtin" name="capnhat" value="Cập nhật">
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