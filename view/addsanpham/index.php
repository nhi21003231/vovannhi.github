<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ADD SANPHAM</title>
<style>
table{
	border-radius: 3px solid black;
	width: 500px;
}
</style>
</head>
	
<?php
	include_once('model/msanpham.php');
	if(isset($_REQUEST["btnsubmit"])){
		$masach = $_REQUEST["txtmasach"];
		$tensach = $_REQUEST["txttensach"];
		$tacgia = $_REQUEST["txttacgia"];
		$gia = $_REQUEST["txtgia"];
		$cty = $_REQUEST["cty"];
		$anh = $_FILES["txtfile"];
		// upload ảnh
		$p = new msanpham();
		$r  = $p -> themsach($masach, $tensach, $anh, $tacgia, $gia, $cty);
		if($r === true){
			echo '<script>alert("Thêm sách thành công")</script>';				
		}else{
			echo '<script>alert("Thêm sách Không thành công")</script>';
		}
	}
?>
<body>
	<h2> <center>THÊM SÁCH</center></h2>
	<form action="#" method="post" enctype="multipart/form-data">
		<table style="margin: auto; text-align: left">
			<tr>
				<td>Tên Sách</td>
				<td><input type="text" name="txttensach" required></td>
			</tr>
			<tr>
				<td>Hình ảnh</td>
				<td><input type="file" name="txtfile" required></td>
			</tr>
			<tr>
				<td>Tác Giả</td>
				<td><input type="text" name="txttacgia" required></td>
			</tr>
			<tr>
				<td>Giá Sách</td>
				<td><input type="number" name="txtgia" required></td>
			</tr>
			<tr>
				<td>Công ty sach</td>
				<td>
					<?php
                        include_once("controller/cloaisanpham.php");
                        $p =new cloaisanpham();
                        $tblsp = $p ->getallloaisp();
                        if($tblsp == false){
                            echo "error";
                        }else if(!$tblsp){
                            echo "0 result";
                        }else{
                            
                            $dem = 0;
                            echo'<select name="cty" id="cty" style="width: 170px;">';
							echo '<option value="chọn công ty">Chọn công ty sách</option>'; 
                            while($r = $tblsp->fetch_assoc()){
                                echo'<option value="'.$r['maloaisach'].'">'.$r['tenloaisach'];
                                $dem++;
                                if($dem%1==0){
                                    echo"</option>";
                                }
                            }
                            echo'</select>';
                                }

					?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td> 
					<input type="submit" name="btnsubmit" value="Thêm sách">
					<input type="reset" value="Nhập lại">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>