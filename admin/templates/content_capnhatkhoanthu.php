<div>
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $makhoanthu=$_GET['makhoanthu'];
    $khoanthu = new khoanthu();
    $dskt = $khoanthu->select_khoanthubyid($makhoanthu);
    if(isset($_SESSION['thongbao']))
    {
      echo '<div class="alert alert-success">';
      echo $_SESSION['thongbao'];
      echo'</div>
      <div class="text-primary">
        <a href="danhsachkhoanthu.php">Quay lại trang trước</a>
      </div>';
      unset($_SESSION['thongbao']);
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo '
   <h3 class="text-center text-danger mt-3">Cập nhật khoản thu</h3>
   <form action="php/xulycapnhatkhoanthu.php" method="POST" id="khoanthu">
        <div class="row">
            <div class="col-sm-12">';
            foreach ($dskt as $key => $value) {
                if($value['TRANGTHAI']==2)
                {
                    $trangthai="Không dùng";
                }else
                if($value['TRANGTHAI']==1)
                {
                    $trangthai="Đang dùng";
                }
                 echo '
                     <div class="form-group">
                        <label>Mã khoản thu</label>
                        <input type="text" class="form-control" name="makhoanthu" value="'.$value['MAKHOANTHU'].'" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tên khoản thu</label>
                        <input type="text" class="form-control" id="tenkhoanthu" name="tenkhoanthu" value="'.$value['TENKHOANTHU'].'">
                    </div>
                    <div class="form-group">
                        <label>Mức đóng</label>
                        <input type="text" class="form-control" id="mucdong" name="mucdong" value="'.$value['MUCDONG'].'">
                    </div>
                    <div class="form-group">
                        <label>Ngày bắt đầu thu</label>
                        <input type="date" class="form-control" id="ngaydong" name="ngaydong" value="'.$value['NGAYTHANG'].'">
                    </div>
                    <div class="form-group">
                        <label>Trạng thái:</label>
                        <select name="trangthai">
                          <option value="'.$value['TRANGTHAI'].'">'.$trangthai.'</option>
                          <option value="">-------</option>
                          <option value="1">Đang dùng</option>
                          <option value="2">Không dùng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú:</label>
                        <br>
                        <textarea id="ghichu" name="ghichu" rows="3" cols="100">'.$value['GHICHU'].'</textarea>
                    </div>';
              }  
             echo '  
            </div>
            <button type="submit" class="btn btn-primary luuthongtin" name="capnhat">Cập nhật thông tin</button>
        </div>
    </form> 
</div>  
</div>';
?>
<script type="text/javascript">
    $('#khoanthu').validate({
      rules:{
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