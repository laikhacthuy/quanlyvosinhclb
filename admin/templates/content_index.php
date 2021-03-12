<div>
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>
    </div><!--/.row-->
<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $ungho = new ungho();
    $khoahoc= new khoahoc();
    $huanluyenvien = new huanluyenvien();
    $tongvosinh=$vosinh->count_tongvs();
    $tongvosinh_nghihoc=$vosinh->count_tongvs_nghihoc();
    $tongvosinh_danghoc=$vosinh->count_tongvs_danghoc();
    $tongvosinh_no=$vosinh->count_tongvs_notien();
    $tongkhoahoc=$khoahoc->count_tongkh();
    $tongungho=$ungho->select_sumungho();
    $tonghlv=$huanluyenvien->count_tonghlv();
    $demtongvs=0;$demtongvs_nh=0;$demtongvs_dh=0;$demtongvs_no=0;$demtong_kh=0;$demtong_uh=0;$demtonghlv=0;

    foreach ($tongvosinh as $key => $value) {
        $demtongvs=$value['tongvs'];
    }
    foreach ($tongvosinh_nghihoc as $key => $value) {
        $demtongvs_nh=$value['tongvs'];
    }
    foreach ($tongvosinh_danghoc as $key => $value) {
        $demtongvs_dh=$value['tongvs'];
    }
    foreach ($tongvosinh_no as $key => $value) {
        $demtongvs_no=$value['tongvs'];
    }
    foreach ($tongkhoahoc as $key => $value) {
        $demtong_kh=$value['tongkh'];
    }
    foreach ($tongungho as $key => $value) {
        $demtong_uh=$value['tonguh'];
    }
    foreach ($tonghlv as $key => $value) {
        $demtonghlv=$value['tong_hlv'];
    }
echo '
    <div class="row">
    <div class="col-sm-12 d-flex">
      <div class="col-sm-4 col-lg-3 bg-info">
        <div class="">
          <div class="">
            <div class="col-sm-6 col-lg-5 widget-left">
              <em class="fa fa-users fa-4x"></em>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="text-white mt-3">Tổng võ sinh theo học: '.$demtongvs.'</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-lg-3 bg-danger ml-3">
        <div class="">
          <div class="">
            <div class="col-sm-3 col-lg-5 widget-left">
              <em class="fa fa-user fa-4x"></em>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="text-white mt-3">Võ sinh nghỉ học: '.$demtongvs_nh.'</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-lg-3 ml-3 bg-success">
        <div class="">
          <div class="">
            <div class="col-sm-3 col-lg-5 widget-left">
              <em class="fa fa-user fa-4x"></em>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right ">
              <div class="text-white mt-3">Võ sinh đang học: '.$demtongvs_dh.'</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-lg-3 bg-info ml-3">
        <div class="">
          <div class="">
            <div class="col-sm-3 col-lg-5 widget-left">
              <em class="fa fa-user-circle-o fa-4x"></em>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="text-white mt-3">Tổng huấn luyện viên: '.$demtonghlv.'</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
    <div class="row">
    <div class="col-sm-12 d-flex mt-5">
      <div class="col-sm-4 col-lg-3 bg-danger">
        <div class="">
          <div class="">
            <div class="col-sm-3 col-lg-5 widget-left">
              <em class="fa fa-user fa-4x"></em>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="text-white mt-3">Võ sinh đang nợ tiền: '.$demtongvs_no.'</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-lg-3 bg-primary ml-3">
        <div class="">
          <div class="">
            <div class="col-sm-3 col-lg-5 widget-left">
              <em class="fa fa-bank fa-4x"></em>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="text-white mt-3">Tổng tiền ủng hộ: '.number_format($demtong_uh).' VND</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 col-lg-3 bg-success ml-3">
        <div class="">
          <div class="">
            <div class="col-sm-3 col-lg-5 widget-left">
              <em class="fa fa-bookmark fa-4x"></em>
            </div>
            <div class="col-sm-9 col-lg-7 widget-right">
              <div class="text-white mt-3">Số khóa học: '.$demtong_kh.'</div>
            </div>
          </div>
        </div>
      </div>
    </div>	
</div>';
?>