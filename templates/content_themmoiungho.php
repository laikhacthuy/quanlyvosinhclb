<?php
if(isset($_SESSION['thongbao']))
    {
      if($_SESSION['thongbao']=="Thêm thành công")
      {
        echo '<div class="alert alert-success">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);
      }
    }
    else{
      echo '<div style="display: none;">
      </div>';
    }
echo '
<div>
  <h3 class="text-center text-danger mt-3">Thêm mới ủng hộ</h3>
  <form action="php/xulythemungho.php" method="POST" id="ungho">
        <div class="row">
            <div class="col-sm-12">  
                <div class="form-group">
                    <label>Tên người ủng hộ</label>
                    <input type="text" class="form-control" id="tenungho" placeholder="Nhập tên người ủng hộ" name="tenungho">
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại ủng hộ" name="sdt">
                </div>
                <div class="form-group">
                    <label>Số tiền ủng hộ</label>
                    <input type="text" class="form-control" id="tienungho" placeholder="Nhập số tiền ủng hộ" name="tienungho">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Ngày đóng</label>
                    <input type="date" class="form-control" id="ngayungho" name="ngayungho">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ghi chú:</label>
                    <br>
                    <textarea id="ghichu" name="ghichu" rows="3" cols="90"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary luuthongtin" name="save">Lưu thông tin ủng hộ</button>
        </div>
    </form> 	
</div>';
?>
<script type="text/javascript">
      $('#ungho').validate({
      rules:{
        tenungho:{
          required:true,
        },
        sdt:{
          required:true,
          number: true,
          minlength:10,
          maxlength:10
          
        },
        ngayungho:{
          required:true,
        },
        tienungho:{
          required:true,
          number: true
        },
      },
      messages:{
        tenungho:{
          required:"Vui lòng nhập tên người ủng hộ",
        },
        ngayungho:{
          required:"Vui lòng nhập ngày tháng hoặc ngày tháng không hợp lệ",
        },
        sdt:{
          required:"Vui lòng nhập điện thoại người ủng hộ",
          number:"Vui lòng nhập đúng định dạng",
          minlength:"Điện thoại có 10 số",
          maxlength:"Điện thoại có 10 số"
        },
        tienungho:{
          required:"Vui lòng số tiền ủng hộ",
          number:"Vui lòng nhập đúng định dạng",
        }
      }
    })
</script> 