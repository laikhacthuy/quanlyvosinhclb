<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $mamaudai=$_GET['mamaudai'];
    $makhoahoc=$_GET['makhoahoc'];
    $tinhtrang=$_GET['tinhtrang'];
    $ngaynhaphoc=$_GET['ngaynhaphoc'];
    $ngaythidai=$_GET['ngaythidai'];
    //xử lý lọc
    $filter  = array(
    'mamaudai'     => isset($_GET['mamaudai']) ? mysqli_escape_string($db->__conn,$mamaudai) : false,
    'makhoahoc'     => isset($_GET['makhoahoc']) ? mysqli_escape_string($db->__conn,$makhoahoc) : false,
    'tinhtrang'   => isset($_GET['tinhtrang']) ? mysqli_escape_string($db->__conn,$tinhtrang) : false,
    'ngaynhaphoc'  => isset($_GET['ngaynhaphoc']) ? mysqli_escape_string($db->__conn,$ngaynhaphoc) : false,
    'ngaythidai'  => isset($_GET['ngaythidai']) ? mysqli_escape_string($db->__conn,$ngaythidai) : false
	);
	$where = array();
	// Nếu có chọn lọc thì thêm điều kiện vào mảng
	if ($filter['mamaudai'])
	{
	    $where[] = "vosinh.mamaudai = '{$filter['mamaudai']}'";
	}
	if ($filter['makhoahoc']){
	    $where[] = "khoahoc.MAKH = '{$filter['makhoahoc']}'";
	} 
	if ($filter['tinhtrang']){
	    $where[] = "tinhtrang = '{$filter['tinhtrang']}'";
	} 
	if ($filter['ngaynhaphoc']){
	    $where[] = "thongtinvosinh.ngaynhaphoc = '{$filter['ngaynhaphoc']}'";
	}
	if ($filter['ngaythidai']){
	    $where[] = "ngaythidai = '{$filter['ngaythidai']}'";
	}
    $sql = "SELECT vosinh.MAVS,vosinh.TENVS,GIOITINH,NGAYSINH,maudai.TENMAUDAI,khoahoc.TENKHOAHOC,thongtinvosinh.NGAYNHAPHOC,NGAYTHIDAI FROM vosinh INNER JOIN maudai on vosinh.MAMAUDAI=maudai.MAMAUDAI INNER JOIN khoahoc on vosinh.MAKH=khoahoc.MAKH INNER JOIN thongtinvosinh on vosinh.MAVS=thongtinvosinh.MAVS";
	if ($where)
	{
	    $sql .= ' WHERE '.implode(' AND ', $where);
	    $ds = $db->get_list($sql);
	    echo '
		<table class="table bg-light table-bordered">
        <tr>
          <th class="text-center" style=" width: 60px">Mã võ sinh</th>
          <th class="text-center" style="width: 150px">Tên võ sinh</th>
          <th class="text-center" style="width: 60px">Giới tính</th>
          <th class="text-center" style="width: 100px">Ngày sinh</th>
          <th class="text-center" style="width: 100px">Khóa học</th>
          <th class="text-center" style="width: 160px">Ngày nhập học</th>
          <th class="text-center" style="width: 140px">Ngày thi đai</th>
          <th class="text-center" style="width: 100px">Màu đai</th>
          <th class="text-center" style="width: 20px">Tools</th>
        </tr>';
        foreach ($ds as $value) {
          $ngaysinh=date("d-m-Y", strtotime($value['NGAYSINH']));
          $ngaynhaphoc=date("d-m-Y", strtotime($value['NGAYNHAPHOC']));
          $ngaythidai=date("d-m-Y", strtotime($value['NGAYTHIDAI']));
        echo'
        <tr>
            <td class="text-center">'.$value["MAVS"].'</td>
            <td class="text-center">'.$value["TENVS"].'</td>
            <td class="text-center">'.$value["GIOITINH"].'</td>
            <td class="text-center">'.$ngaysinh.'</td>
            <td class="text-center">'.$value["TENKHOAHOC"].'</td>
            <td class="text-center">'.$ngaynhaphoc.'</td>
            <td class="text-center">'.$ngaythidai.'</td>
            <td class="text-center">'.$value["TENMAUDAI"].'</td>
            <td class="text-center">
              <a class="text-dark border rounded ml-2 bg-info" href="capnhatvosinh_chitiet.php?mavs='.$value['MAVS'].'"><i class="fa fa-edit p-2 text-white text-center"></i></a>
              <a class="text-dark border rounded ml-2 bg-danger" href="php/xulyxoavosinh.php?mavs='.$value['MAVS'].'"><i  class="fa fa-trash p-2 text-white text-center"></i></a>
            </td>
        </tr>';     
        }
        echo'
			</table>';
	} 
?>