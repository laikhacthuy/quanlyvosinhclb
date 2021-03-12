<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $mavosinh=$_SESSION['taikhoan'];
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $dsvs=$vosinh->list_vosinhcapnhat($mavosinh);
echo '<div>
  <h3 class="text-center text-danger mt-3">Thông tin võ sinh</h3>
  <div class="row">';
        foreach ($dsvs as $key => $value) {
          $tinhtrang;
          if($value['TINHTRANG']==1)
          {
            $tinhtrang="Đang học";
          }else
          if($value['TINHTRANG']==2)
          {
            $tinhtrang="Nghỉ học";
          }else
          if($value['TINHTRANG']==3)
          {
            $tinhtrang="Học tiếp";
          }
          echo '
            <div class="col-sm-6">  
                <div class="form-group">
                    <label>Mã võ sinh</label>
                    <input type="text" class="form-control" readonly value="'.$value['MAVS'].'" name="mavs">
                </div>
                <div class="form-group">
                    <label>Tên võ sinh</label>
                    <input type="text" class="form-control" id="tenvosinh" value="'.$value['TENVS'].'" name="tenvs" readonly>
                </div>
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" class="form-control" id="ngaysinh" value="'.$value['NGAYSINH'].'" name="ngaysinh" readonly>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" id="diachi" value="'.$value['DIACHI'].'" name="diachi" readonly>
                </div>
                <div class="form-group">
                    <label>Giới tính</label>
                    <select id="gioitinh" name="gioitinh" class="form-control">
                      <option value="'.$value['GIOITINH'].'" select="selected">'.$value['GIOITINH'].'</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Điện thoại</label>
                    <input type="text" class="form-control" id="dienthoai" value="'.$value['DIENTHOAI'].'" name="dienthoai" readonly>
                </div>
                <div class="form-group">
                    <label>Màu đai</label>
                    <select id="maudai" name="maudai" class="form-control">
                      <option select="selected" value="'.$value['MAMAUDAI'].'">'.$value['TENMAUDAI'].'</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Khóa học</label>
                    <select id="khoahoc" name="khoahoc" class="form-control">
                      <option value="'.$value['MAKH'].'" select="selected">'.$value['TENKHOAHOC'].'</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <br>
                    <textarea id="ghichu" name="ghichu" rows="3" cols="90" readonly>'.$value['GHICHU'].'</textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Tên phụ huynh</label>
                    <input type="text" class="form-control" value="'.$value['TENPHUHUYNH'].'" name="tenph" readonly>
                </div>
                <div class="form-group">
                    <label>Số điện thoại phụ huynh</label>
                    <input type="text" class="form-control" value="'.$value['DIENTHOAIPH'].'" name="sdtph" readonly>
                </div>
                <div class="form-group">
                    <label>Ngày nhập học</label>
                    <input type="date" class="form-control" id="ngaynhaphoc" value="'.$value['NGAYNHAPHOC'].'" name="ngaynhaphoc" readonly>
                </div>
                <div class="form-group">
                    <label>Ngày thi đai</label>
                    <input type="date" class="form-control" id="ngaythidai" value="'.$value['NGAYTHIDAI'].'" name="ngaythidai" readonly>
                </div>
                <div class="form-group">
                    <label>Tình trạng</label>
                    <select id="tinhtrang" name="tinhtrang" class="form-control">
                      <option value="'.$value['TINHTRANG'].'" select="selected">'.$tinhtrang.'</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="img">Ảnh võ sinh: </label>
                  <br>
                  <img src="../images/'.$value['ANH'].'" class="img_nguoidung">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Số dư</label>
                  <input type="text" class="form-control" name="sodu" value="'.$value['SODU'].'" readonly>
                </div>
                </div>     
        </div>
</div>';
}
?>