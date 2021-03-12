<?php
require_once("DB_business.php");
// Lớp sản phẩm
class maudai extends DB_business
{
    protected $_table_name = 'maudai';

    // Tên Khóa Chính
    protected $_key = 'MAMAUDAI';
    
    function select_maudai(){
        $sql = "select MAMAUDAI,TENMAUDAI from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function check_maudai($id){
        $sql = "select * from " . $this->_table_name . " where " . $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }

    function insert_maudai($data){
        return parent::insert($this->_table_name, $data);
    }

    function capnhat_maudai($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function xoa_maudai($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }

    function select_maudaibyid($id){
        $sql = "select MAMAUDAI,TENMAUDAI from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_list($sql);
    }
}
//-----------------------------
class khoahoc extends DB_business
{
    protected $_table_name = 'khoahoc';

    // Tên Khóa Chính
    protected $_key = 'MAKH';
    
    function count_tongkh(){
        $sql = "select count(MAKH) as tongkh from " . $this->_table_name . "";
        return $this->get_list($sql);
    }

    function select_khoahoc(){
        $sql = "select MAKH,TENKHOAHOC,NAMHOC from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function check_khoahoc($id){
        $sql = "select * from " . $this->_table_name . " where " . $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }

    function insert_khoahoc($data){
        return parent::insert($this->_table_name, $data);
    }

    function capnhat_khoahoc($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function xoa_khoahoc($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }

    function select_khoahocbyid($id){
        $sql = "select MAKH,TENKHOAHOC,NAMHOC from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_list($sql);
    }
}

class vosinh extends DB_business
{
    protected $_table_name = 'vosinh';

    // Tên Khóa Chính
    protected $_key = 'MAVS';

    protected $_key2 = 'TENVS';

    function count_tongvs(){
        $sql = "select count(MAVS) as tongvs from " . $this->_table_name . "";
        return $this->get_list($sql);
    }

    function count_tongvs_nghihoc(){
        $sql = "select count(MAVS) as tongvs from " . $this->_table_name . " where TINHTRANG=2";
        return $this->get_list($sql);
    }

    function count_tongvs_danghoc(){
        $sql = "select count(MAVS) as tongvs from " . $this->_table_name . " where TINHTRANG=1 OR TINHTRANG=3";
        return $this->get_list($sql);
    }

    function count_tongvs_notien(){
        $sql = "select count(MAVS) as tongvs from " . $this->_table_name . " where SODU<0";
        return $this->get_list($sql);
    }

    function check_mavs($id){
        $sql = "select MAVS,TENVS,TINHTRANG from " . $this->_table_name . " where " . $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }

    function insert_vosinh($data){
        return parent::insert($this->_table_name, $data);
    }

    function xoa_vosinh($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }

    function list_vosinhcapnhat($id){
        $sql = "select vosinh.MAVS,TENVS,GIOITINH,NGAYSINH,DIENTHOAI,NGAYTHIDAI,vosinh.MAMAUDAI,maudai.TENMAUDAI,TINHTRANG,SODU,vosinh.MAKH,khoahoc.TENKHOAHOC,thongtinvosinh.TENPHUHUYNH,thongtinvosinh.DIENTHOAIPH,thongtinvosinh.DIACHI,thongtinvosinh.NGAYNHAPHOC,thongtinvosinh.ANH,thongtinvosinh.GHICHU from " . $this->_table_name . " inner join maudai on vosinh.MAMAUDAI = maudai.MAMAUDAI inner join khoahoc on vosinh.MAKH=khoahoc.MAKH inner join thongtinvosinh on vosinh.MAVS = thongtinvosinh.MAVS where vosinh.". $this->_key . " = '" . $id . "'";
        return $this->get_list($sql);
    }

    function list_vosinh(){
        $sql = "select vosinh.MAVS,TENVS,GIOITINH,NGAYSINH,khoahoc.TENKHOAHOC,NGAYNHAPHOC,NGAYTHIDAI,MAUDAI.TENMAUDAI from " . $this->_table_name . " inner join thongtinvosinh on vosinh.MAVS = thongtinvosinh.MAVS inner join maudai on vosinh.MAMAUDAI = maudai.MAMAUDAI inner join khoahoc on vosinh.MAKH=khoahoc.MAKH ORDER BY vosinh.MAVS LIMIT 10";
        return $this->get_list($sql);
    }

    function update_vosinh($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function list_mavosinh(){
        $sql = "select MAVS from " . $this->_table_name . " ORDER BY MAVS";
        return $this->get_list($sql);
    }

    function select_sodu($id){
        $sql = "select sodu from " . $this->_table_name . " where " . $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }
    //--tìm kiếm---------------------
    function timkiem_vosinh($id){
        $sql = "select vosinh.MAVS,TENVS,GIOITINH,NGAYSINH,DIENTHOAI,maudai.TENMAUDAI,TINHTRANG from " . $this->_table_name . " inner join maudai on vosinh.MAMAUDAI = maudai.MAMAUDAI where vosinh.". $this->_key . " = '" . $id . "' OR vosinh.DIENTHOAI='" . $id . "' OR vosinh.TENVS LIKE '%" . $id . "' ORDER BY vosinh.MAVS";
        return $this->get_list($sql);
    }

    function check_tenvosinh($id){
        $sql = "select vosinh.MAVS,TENVS,GIOITINH,NGAYSINH,DIENTHOAI,maudai.TENMAUDAI,TINHTRANG from " . $this->_table_name . " inner join maudai on vosinh.MAMAUDAI = maudai.MAMAUDAI where vosinh.TENVS LIKE '%" . $id . "'";
        return $this->get_list($sql);
    }
    //---------------loc vo sinh
    function locvosinh_vosinh($id){
        $sql = "select vosinh.MAVS,TENVS,GIOITINH,NGAYSINH,DIENTHOAI,maudai.TENMAUDAI from " . $this->_table_name . " inner join maudai on vosinh.MAMAUDAI = maudai.MAMAUDAI where vosinh.". $this->_key . " = '" . $id . "' OR vosinh.DIENTHOAI='" . $id . "' OR vosinh.TENVS LIKE '%" . $id . "' ORDER BY vosinh.MAVS";
        return $this->get_list($sql);
    }
}

class thongtinvosinh extends DB_business
{
    protected $_table_name = 'thongtinvosinh';

    // Tên Khóa Chính
    protected $_key = 'MAVS';
    
    function insert_thongtinvosinh($data){
        return parent::insert($this->_table_name, $data);
    }
    
    function update_thongtinvosinh($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function xoa_thongtinvosinh($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }
}

class nguoidung_log extends DB_business
{
    protected $_table_name = 'nguoidung_log';

    // Tên Khóa Chính
    protected $_key = 'ID';
    
    function insert_nguoidung_log($data){
        return parent::insert($this->_table_name, $data);
    }
    function select_lichsu(){
        $sql = "select * from " . $this->_table_name;
        return $this->get_list($sql);
    }
}

class ungho extends DB_business
{
    protected $_table_name = 'ungho';

    // Tên Khóa Chính
    protected $_key = 'ID';
     protected $_key2 = 'TENNGUOIUNGHO';
      protected $_key3 = 'SDT';
    
    function insert_ungho($data){
        return parent::insert($this->_table_name, $data);
    }
    function select_ungho(){
        $sql = "select * from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function select_sumungho(){
        $sql = "select sum(SOTIENDONG) as tonguh from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function select_id($id){
        $sql = "select TENNGUOIUNGHO,SDT,SOTIENDONG,NGAYDONG,GHICHU  from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_list($sql);
    }

    function select_ten_sdt($id2,$id3){
        $sql = "select ID,TENNGUOIUNGHO,SDT,SOTIENDONG,NGAYDONG,GHICHU  from " . $this->_table_name . " where ". $this->_key2 . " LIKE '%" . $id2 . "' OR ". $this->_key3 . " = '" . $id3 . "'";
        return $this->get_list($sql);
    }

    function capnhat_ungho($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function xoa_ungho($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }
}
//---------------------
class phanquyen extends DB_business
{
    protected $_table_name = 'phanquyen';

    // Tên Khóa Chính
    protected $_key = 'MUCDO';
    
    function insert_phanquyen($data){
        return parent::insert($this->_table_name, $data);
    }
    function select_phanquyen(){
        $sql = "select * from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function check_phanquyen($id){
        $sql = "select *  from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }

    function xoa_phanquyen($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }
}
//------------------
class huanluyenvien extends DB_business
{
    protected $_table_name = 'huanluyenvien';

    // Tên Khóa Chính
    protected $_key = 'MAHLV';
    
    function insert_hlv($data){
        return parent::insert($this->_table_name, $data);
    }
    function select_hlv(){
        $sql = "select * from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function select_hlv_byid($id){
        $sql = "select * from " . $this->_table_name." where ".$this->_key. " = '" .$id. "' ";
        return $this->get_list($sql);
    }

    function check_hlv($id){
        $sql = "select *  from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }

    function xoa_hlv($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }

    function capnhat_hlv($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function count_tonghlv(){
        $sql = "select count(MAHLV) as tong_hlv from " . $this->_table_name;
        return $this->get_list($sql);
    }
}
//------------------
class nguoidung extends DB_business
{
    protected $_table_name = 'nguoidung';

    // Tên Khóa Chính
    protected $_key = 'TAIKHOAN';
    
    function insert_nguoidung($data){
        return parent::insert($this->_table_name, $data);
    }
    function select_nguoidung(){
        $sql = "select * from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function check_nguoidung($id){
        $sql = "select *  from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }

    function select_nguoidungbyid($id){
        $sql = "select TAIKHOAN,TENNGUOIDUNG,phanquyen.QUYENHAN,nguoidung.MUCDO,ANH  from " . $this->_table_name . " inner join phanquyen on nguoidung.MUCDO=phanquyen.MUCDO where ". $this->_key . " = '" . $id . "'";
        return $this->get_list($sql);
    }

    function capnhat_nguoidung($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function xoa_nguoidung($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }
}
//--------------------
class khoanthu extends DB_business
{
    protected $_table_name = 'khoanthu';

    // Tên Khóa Chính
    protected $_key = 'MAKHOANTHU';
    
    function insert_khoanthu($data){
        return parent::insert($this->_table_name, $data);
    }
    function select_khoanthu(){
        $sql = "select * from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function select_khoanthu_themkhoanthu(){
        $sql = "select *  from " . $this->_table_name . " where TRANGTHAI=1";
        return $this->get_list($sql);
    }

    function check_khoanthu($id){
        $sql = "select *  from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }

    function select_khoanthubyid($id){
        $sql = "select MAKHOANTHU,TENKHOANTHU,MUCDONG,NGAYTHANG,TRANGTHAI,GHICHU from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_list($sql);
    }

    function capnhat_khoanthu($data,$id){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "'");
    }

    function xoa_khoanthu($id){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'");
    }

    function select_mucdong($id){
        $sql = "select MUCDONG  from " . $this->_table_name . " where ". $this->_key . " = '" . $id . "'";
        return $this->get_row($sql);
    }
}
//--------------------
class danhsachdong extends DB_business
{
    protected $_table_name = 'danhsachdong';

    // Tên Khóa Chính
    protected $_key = 'MAKHOANTHU';
    // Tên Khóa Chính
    protected $_key2="MAVS";

    protected $_key3="MAKH";

    
    function insert_danhsachdong($data){
        return parent::insert($this->_table_name, $data);
    }

    function select_danhsachdong(){
        $sql = "select * from " . $this->_table_name;
        return $this->get_list($sql);
    }

    function select_danhsachdong_bykhoanthu($id){
        $sql = "select danhsachdong.MAVS,khoanthu.TENKHOANTHU,danhsachdong.TINHTRANG,vosinh.TENVS,maudai.TENMAUDAI,danhsachdong.MAKHOANTHU from " . $this->_table_name . " inner join vosinh on danhsachdong.MAVS=vosinh.MAVS inner join khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU inner join maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI  where danhsachdong." . $this->_key . " = '" . $id . "' GROUP BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }

    function check_danhsachdongbyid($id, $id2){
        $sql = "select * from " . $this->_table_name . " where " . $this->_key . " = '" . $id . "' AND " . $this->_key2 . "='" . $id2 . "'";
        return $this->get_row($sql);
    }

    function check_danhsachdong($id, $id2){
        $sql = "select * from " . $this->_table_name . " where " . $this->_key . " = '" . $id . "' AND " . $this->_key2 . "='" . $id2 . "' AND TINHTRANG=1";
        return $this->get_row($sql);
    }

    function capnhat_danhsachdong($data,$id,$id2){
        return $this->update($this->_table_name, $data, $this->_key . "='" . $id . "' AND " . $this->_key2 . "='" . $id2 . "'");
    }

    function xoa_danhsachdong($id,$id2){
        return $this->remove($this->_table_name, $this->_key . "='" . $id . "'  AND " . $this->_key2 . "='" . $id2 . "'");
    }

    //lọc bình thường-----------
    function select_dsdong_khoanthu_khoahoc($id,$id3){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,maudai.TENMAUDAI,danhsachdong.TINHTRANG  from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI where danhsachdong.TINHTRANG=1 AND danhsachdong." . $this->_key . " = '" . $id . "' AND khoahoc. " . $this->_key3 . "='" . $id3 . "' ORDER BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }

    function select_dsdong_khoanthu($id){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,maudai.TENMAUDAI,danhsachdong.TINHTRANG,danhsachdong.MAKHOANTHU  from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI where danhsachdong.TINHTRANG=1 AND danhsachdong." . $this->_key . " = '" . $id . "' ORDER BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }

    function select_dsdong_khoahoc($id3){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,maudai.TENMAUDAI,danhsachdong.TINHTRANG  from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI where danhsachdong.TINHTRANG=1 AND khoahoc." . $this->_key3 . " = '" . $id3 . "' ORDER BY danhsachdong.MAVS and danhsachdong.MAKHOANTHU";
        return $this->get_list($sql);
    }
    //tìm kiếm-------------------
    function search_dsdong($id){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,vosinh.DIENTHOAI,vosinh.NGAYSINH,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,khoanthu.MUCDONG from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH where vosinh.TENVS LIKE '%" . $id . "' OR danhsachdong." . $this->_key2 . "='" . $id . "' OR vosinh.DIENTHOAI='" . $id . "' GROUP BY danhsachdong.MAVS ORDER BY danhsachdong.MAVS ";
        return $this->get_list($sql);
    }

    function search_dongtienhoc($id){
        $sql = 
        "select danhsachdong.MAVS,vosinh.TENVS,vosinh.DIENTHOAI,vosinh.NGAYSINH,vosinh.SODU,khoanthu.TENKHOANTHU,danhsachdong.MAKHOANTHU,khoahoc.TENKHOAHOC,khoanthu.MUCDONG from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH where danhsachdong.TINHTRANG='1' AND(vosinh.TENVS LIKE '%" . $id . "' OR danhsachdong." . $this->_key2 . "='" . $id . "' OR vosinh.DIENTHOAI='" . $id . "') ORDER BY danhsachdong.MAVS ";
        return $this->get_list($sql);
    }
    //lọc học phí-----------
    function select_dsdongtien_khoanthu_khoahoc($id,$id3){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,vosinh.DIENTHOAI,vosinh.NGAYSINH from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH where danhsachdong.TINHTRANG=1 AND danhsachdong." . $this->_key . " = '" . $id . "' AND khoahoc. " . $this->_key3 . "='" . $id3 . "' ORDER BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }

    function select_dsdongtien_khoanthu($id){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,vosinh.DIENTHOAI,vosinh.NGAYSINH from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH where danhsachdong.TINHTRANG=1 AND danhsachdong." . $this->_key . " = '" . $id . "' ORDER BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }

    function select_dsdongtien_khoahoc($id3){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,vosinh.DIENTHOAI,vosinh.NGAYSINH  from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH where danhsachdong.TINHTRANG=1 AND khoahoc." . $this->_key3 . " = '" . $id3 . "' ORDER BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }
    //------------bao cao
    function baocao_tim($id2){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,khoanthu.MUCDONG,danhsachdong.NGAYDONG,danhsachdong.TINHTRANG from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH where danhsachdong.TINHTRANG=2 AND danhsachdong." . $this->_key2 . " = '" . $id2 . "' ORDER BY danhsachdong.MAKHOANTHU";
        return $this->get_list($sql);
    }
    //-------------trang vo sinh
    function baocao_vs($id2){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,khoanthu.MUCDONG,danhsachdong.NGAYDONG,danhsachdong.TINHTRANG from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH where danhsachdong." . $this->_key2 . " = '" . $id2 . "' ORDER BY danhsachdong.MAKHOANTHU";
        return $this->get_list($sql);
    }
    //lọc thi đai-----------
    function select_dsdong_khoanthu_khoahoc_lendai($id,$id3){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,maudai.TENMAUDAI,danhsachdong.TINHTRANG  from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI where danhsachdong." . $this->_key . " = '" . $id . "' AND khoahoc. " . $this->_key3 . "='" . $id3 . "' ORDER BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }

    function select_dsdong_khoanthu_lendai($id){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,maudai.TENMAUDAI,danhsachdong.TINHTRANG,danhsachdong.MAKHOANTHU  from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI where danhsachdong." . $this->_key . " = '" . $id . "' ORDER BY danhsachdong.MAVS";
        return $this->get_list($sql);
    }

    function select_dsdong_khoahoc_lendai($id3){
        $sql = "select danhsachdong.MAVS,vosinh.TENVS,khoanthu.TENKHOANTHU,khoahoc.TENKHOAHOC,maudai.TENMAUDAI,danhsachdong.TINHTRANG  from " . $this->_table_name . " INNER JOIN vosinh on danhsachdong.MAVS=vosinh.MAVS INNER JOIN khoanthu on danhsachdong.MAKHOANTHU=khoanthu.MAKHOANTHU INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI where khoahoc." . $this->_key3 . " = '" . $id3 . "' ORDER BY danhsachdong.MAVS and danhsachdong.MAKHOANTHU";
        return $this->get_list($sql);
    }

}

