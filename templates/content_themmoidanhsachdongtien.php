
<div>
   <h3 class="text-center text-danger mt-3">Tạo danh sách đóng tiền</h3>
<?php
    require ("BackEnd/DB_driver.php");
    require ("BackEnd/DB_business.php");
    require ("BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoanthu = new khoanthu();
    $danhsachdong = new danhsachdong();
    $dskt = $khoanthu->select_khoanthu_themkhoanthu();
    $vosinh = new vosinh();
  echo'<div class="col-sm-12 d-flex">
          <div class="col-sm-9 m-0">
            <form action="php/xulythemdanhsachdongtien.php" method="POST">
                  <div class="row">
                      <div class="col-sm-12 d-flex text-center">
                          <div class="col-sm-12 form-group w-25 d-flex">
                              <div class="col-sm-2"><label class="pt-2">Tên khoản thu</label></div>
                              <div class="col-sm-7">
                                <select name="makhoanthu" class="form-control">';
                                  foreach ($dskt as $value) {
                                    echo ' 
                                    <option value="'.$value['MAKHOANTHU'].'">'.$value['TENKHOANTHU'].'</option>';
                                  }
                                  echo'
                                </select>
                              </div>
                              <div class="col-sm-3 p-0">
                                <button type="submit" class="btn btn-primary" name="save">Tạo tự động</button>
                              </div>
                          </div>  
                        
                      </div>
                  </div>
              </form>
             </div>
            <div class="col-sm-3">
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Tạo thủ công</button>
            </div>
      </div>
        ';
  if(isset($_SESSION['thongbao']))
  {
      if($_SESSION['thongbao']=="Danh sách đóng tiền tạo thành công")
      {
        echo '<div class="alert alert-success w-50">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);

      }else
      if($_SESSION['thongbao']=="Danh sách đóng tiền đã tồn tại")
      {
        echo '<div class="alert alert-danger w-50 ml-5">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);
      }else
      if($_SESSION['thongbao']=="Thêm thủ công thành công")
      {
        echo '<div class="alert alert-success w-50 ml-5">';
        echo $_SESSION['thongbao'];
        echo'</div>';
        unset($_SESSION['thongbao']);
      }
    }
    if(isset($_SESSION['makhoanthu_ds'])) 
    {
      $urp=$_SERVER['REQUEST_URI'];
      $_SESSION['xoads']=$urp;
      $ds_vuatao=$danhsachdong->select_danhsachdong_bykhoanthu($_SESSION['makhoanthu_ds']);
      echo '
        <div>
              <h2 class="text-danger text-center mt-2">Danh sách đóng tiền vừa tạo</h2>
              <button type="button" class="btn btn-primary" onclick="luudanhsach()">Lưu danh sách</button>
                <table class="table bg-light table-bordered mt-3">
                    <tr>
                      <th class="text-center" style=" width: 120px">Mã võ sinh</th>
                      <th class="text-center" style=" width: 100px">Tên võ sinh</th>
                      <th class="text-center" style="width: 100px">Tên khoản thu</th>
                      <th class="text-center" style="width: 100px">Màu đai</th>
                      <th class="text-center" style="width: 100px">Tình trạng</th>
                      <th class="text-center" style="width: 20px">Tools</th>
                    </tr>';
                    foreach ($ds_vuatao as $key => $value) {
                      if($value['TINHTRANG']==1)
                      {
                        $tinhtrang="Chưa đóng";
                      }
                      else
                      if($value['TINHTRANG']==2)
                      {
                        $tinhtrang="Đã đóng";
                      }
                      echo '
                    <tr>
                          <td class="text-center">'.$value['MAVS'].'</td>
                          <td class="text-center">'.$value['TENVS'].'</td>
                          <td class="text-center">'.$value['TENKHOANTHU'].'</td>
                          <td class="text-center">'.$value['TENMAUDAI'].'</td>
                          <td class="text-center">'.$tinhtrang.'</td>
                          <td class="text-center">
                            <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoadanhsachdongtien.php?mavosinh='.$value['MAVS'].'&makhoanthu='.$value['MAKHOANTHU'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
                          </td>
                    </tr>';
                    }
                    echo'   
                </table>';
                
    }
      echo'
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm danh sách thủ công</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="php/xulythemthucongdanhsach.php" method="POST">
          <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Mã võ sinh</label>
                    <input type="text" class="form-control" name="mavosinh" placeholder="Nhập mã võ sinh">
                </div>
                <div class="form-group">
                    <label>Tên khoản thu</label>
                    <select name="makhoanthu" class="form-control">';
                        foreach ($dskt as $value) {
                          echo ' 
                          <option value="'.$value['MAKHOANTHU'].'">'.$value['TENKHOANTHU'].'</option>';
                        }
                    echo'
                    </select>
                </div>
            </div>
          </div>  
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="luu">Lưu thông tin</button>
      </div>
      </form>
    </div>
  </div>
</div>';

?>
<script type="text/javascript">
  function luudanhsach() {
    alert("Lưu thành công");
    window.location="http://localhost/quanlylopvo/php/xulyluudanhsachdongtien.php";
  }
</script>


