<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>sửa sản phẩm</title>
<style>
table{
	border-radius: 3px solid black;
	width: 500px;
}
</style>
</head>
	
<?php
if(isset($_REQUEST["masach"])){
	include_once("controller/ctlsanpham.php");
	$p = new csanpham();
	$sp = $p->getspbyid($_REQUEST["masach"]);
	if($sp){
		$row= $sp->fetch_assoc();

	}
}
	include_once('model/msanpham.php');
		if(isset($_REQUEST["btnsua"])){
			$masach = $_REQUEST["txtmasach"];
			$tensach = $_REQUEST["txttensach"];
			$tacgia = $_REQUEST["txttacgia"];
			$gia = $_REQUEST["txtgia"];
			$cty = $_REQUEST["cty"];
			$anh = $_FILES["txtfile"]; 
			//kiểm tra xem có upload ảnh hay không
			if($anh["name"]!= ''){
				$upload = "../webbansach_vovannhi/img/".$anh["name"];
				move_uploaded_file($anh["tmp_name"], $upload);
				$anh = $anh["name"];
			}else{
				$anh = $row["hinhanh"];
			}
			// upload ảnh
			$p = new msanpham();
			$r  = $p -> sua($masach, $tensach, $anh, $tacgia, $gia, $cty);
			if($r === true){
				echo '<script>alert("sửa sách thành công")</script>';
				echo "<script>window.location.href = 'admin.php?sua&masach=" . $row["masach"] . "';</script>";
				exit();				
			}else{
				echo '<script>alert("sửa sách Không thành công")</script>';
			}
		}
?>

<body>

<?php

// include_once "controller/ctlsanpham.php";

// $csanpham = new csanpham();
// $result = $csanpham->getallsp();

// if ($result == -1 || $result == 0) {
//     echo "Không có dữ liệu hoặc có lỗi xảy ra";
// } else {
//     $r = $result->fetch_assoc(); // Lấy ra bản ghi đầu tiên
// }
    ?>
<h2> <center>SỬA SÁCH</center></h2>
	<form action="#" method="post" enctype="multipart/form-data">
		<table style="margin: auto; text-align: left">
			<tr>
				<td>Mã Sách</td>
			<td><input type="text" name="txtmasach" required value="<?php echo $row['masach']?>" readonly ></td>
			</tr>
			<tr>
				<td>Tên Sách</td>
				<td><input type="text" name="txttensach" required value="<?php echo $row["tensach"]; ?>"></td>
			</tr>
			<tr>
				<td>Hình ảnh</td>

				<td>
					<img src="img/<?php echo $row['hinhanh']?>" alt="" width="50px"><br>
					<span><?php echo $row['hinhanh']; ?></span><br>
					<input type="file" name="txtfile"></td>
			</tr>
			<tr>
				<td>Tác Giả</td>
				<td><input type="text" name="txttacgia" required value="<?php echo $row['tacgia']?>"></td>
			</tr>
			<tr>
				<td>Giá Sách</td>
				<td><input type="number" name="txtgia" required value="<?php echo $row['gia']?>"></td>
			</tr>
			<!-- <tr>
				<td>tên Loại Sách</td>
				<td><input type="txt" name="txtmaloaisach" value="<?php
				//  echo $row['cty']
				 ?>"></td>
			</tr>
		 -->
			<tr>
				<td>Công ty sach</td>
				<td>
				<?php
					include_once("controller/cLoaiSanPham.php");
					$p = new CLoaiSanpham();
					$tblSP = $p->getAllLoaiSP();

					if ($tblSP === false) {
						echo "error";
					} else if (!$tblSP) {
						echo "0 result";
					} else {
						echo '<select name="cty" id="cty" style="width: 170px;">';
						echo '<option value="">Chọn công ty sách</option>';

						while ($r = $tblSP->fetch_assoc()) {
							// So sánh maloaisach của sách hiện tại với từng maloaisach khi duyệt
							if ($r['maloaisach'] == $row['maloaisach']) {
								// Nếu khớp, đặt làm mặc định và bỏ qua trong các lựa chọn tiếp theo
								echo '<option value="'.$r['maloaisach'].'" selected>'.$r['tenloaisach'].'</option>';
							} else {
								echo '<option value="'.$r['maloaisach'].'">'.$r['tenloaisach'].'</option>';
							}
						}

						echo '</select>';
   				 	}
				?>

				</td>
			</tr>
			<tr>
				<td></td>
				<td> 
					<input type="submit" name="btnsua" value="Cập nhật">
					<input type="button" name="btnhuy" value="Hủy" onclick="window.location='admin.php?aProd';">
					<!-- <input type="reset"  name ='tbnnl' value='Hủy'> -->
				</td>
			</tr>
		</table>
	</form>
</body>
</html>