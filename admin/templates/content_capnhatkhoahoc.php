<div>    
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $makh=$_GET['makh'];
    $khoahoc = new khoahoc();
    $dskh = $khoahoc->select_khoahocbyid($makh);
    if(isset($_SESSION['thongbao']))
    {
      echo '<div class="alert alert-success">';
      echo $_SESSION['thongbao'];
      echo'</div>
      <div class="text-primary">
        <a href="danhsachkhoahoc.php">Quay lại trang trước</a>
      </div>';
      unset($_SESSION['thongbao']);
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo'
  <h3 class="text-center text-danger mt-3">Cập nhật khóa học</h3>
  <form action="php/xulycapnhatkhoahoc.php" method="POST" id="khoahoc">
        <div class="row">';
        foreach ($dskh as $key => $value) {
            echo '
            <div class="col-sm-12">  
                <div class="form-group">
                    <label>Mã khóa học</label>
                    <input type="text" class="form-control" name="makhoahoc" readonly value="'.$value['MAKH'].'">
                </div>
                <div class="form-group">
                    <label>Tên khóa học</label>
                    <input type="text" class="form-control" id="tenkhoahoc" name="tenkhoahoc" placeholder="Nhập tên khóa học" value="'.$value['TENKHOAHOC'].'">
                </div>
                <div class="form-group">
                    <label>Năm học</label>
                    <br>
                    <input type="date" class="form-control" id="namhoc" name="namhoc" value="'.$value['NAMHOC'].'">
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
    $('#khoahoc').validate({
      rules:{
        tenkhoahoc:{
          required:true,
        },
        namhoc:{
          required:true,
        }
      },
      messages:{
        tenkhoahoc:{
          required:"Vui lòng nhập tên khoản thu",
        },
        namhoc:{
          required:"Vui lòng nhập năm học đúng định dạng",
        }
      }
    })
</script>