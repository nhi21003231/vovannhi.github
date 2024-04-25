<?php
    session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ADMIN</title>
</head>
<style>
	    th, td {
            border: 3px solid black;
            text-align: center;
            padding: 8px;
        }
		#left{
			width: 20%;
		}
		#mai{
			width: 80%;
		}
		.action-button {
    background-color: #4CAF50; /* Màu nền xanh lá */
    border: 2px solid #397d34; /* Thêm viền xanh đậm */
    color: white;
    padding: 6px 6px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 10px;
    margin: 1px 1px;
    cursor: pointer;
    border-radius: 5px; /* Bo góc */
    /* transition: background 0.3s; */
}

.action-button:hover {
    background-color: #45a049; /* Màu khi hover */
}

</style>

<body>
	<table border="1px solid" style="margin: auto; text-align: center; width: 960px">
		<tr >
			<td colspan="2"><img src="../web_ck/backg.png" width = "50%"></td>
		</tr>
		<tr>
			<td colspan="2"><a href="index.php">Trang chủ</a></td>
		<tr>
		<tr>
			<td id="left">
				<?php
				if(isset($_SESSION['username'])){
					echo '
					<a href="admin.php?aComp">Quản lý loại sách</a><br><br>
					<a href="admin.php?aProd">Quản lý sách</a><br><br>
					<a href="admin.php?dangxuat">Đăng Xuất</a>
					';
				}else{
					echo '<a href="admin.php?dangnhap">Đăng nhập</a> ';
				}

				?>
			</td>
			<td id="main">
				<?php
				if(isset($_SESSION['username'])){
					if(isset($_REQUEST["aProd"])){
						include("controller/ctlsanpham.php");
						$p = new csanpham();
						if(isset($_REQUEST['cty'])){
							$tblsp = $p->getallspbyid($_REQUEST['id']);
						}elseif(isset($_REQUEST["btnsearch"])){
							$tblsp = $p->getallspbyname($_REQUEST["txtsearch"]);
						}else{
							$tblsp = $p->getallsp();
						}
						if($tblsp==false){
							echo "error";
						}else if(!$tblsp) 
						echo"0 result";
						else {
							echo '<h3><center>Quản lý thành phẩm</center></h3>';
							echo '<h3><center><a href="admin.php?them">Thêm sản phẩm</a></center></h3>';
							echo '<form method="post">';
							echo '<table>';
							echo '<tr>';
							echo '<th>';
							echo 'Mã sách';
							echo '</th><th>';
							echo 'Tên sách';
							echo '</th><th>';
							echo 'Hình ảnh';
							echo '</th><th>';
							echo 'Tác giả';
							echo '</th><th>';
							echo 'Giá';
							echo '</th><th>';
							echo 'Mã loại sách';
							echo '</th><th>';
							echo 'Hành Động';
							echo '</th>';
							echo '</tr>';
							echo '<tr>';
							$dem = 0;
							while($r = $tblsp->fetch_assoc()){
								echo '<td>';
								echo $r['masach'];
								echo '</td>';
								echo '<td>';
								echo $r['tensach'];
								echo '</td>';
								echo '<td>';
								echo'<img width="70px" src="img/'.$r['hinhanh'].'">'.'<br>';
								echo '</td>';
								echo '<td>';
								echo $r['tacgia'];
								echo '</td>';
								echo '<td>';
								echo $r['gia'];
								echo '</td>';
								echo '<td>';
								echo $r['maloaisach'];
								echo '</td>';
								echo '<td>';
								echo '<form method="post">';
								echo '<button class="action-button" onclick="return confirm(\'Bạn có chắc muốn xóa không?\');" type="submit" value="'.$r["masach"].'" name="btnXoa">Xoá</button>';
								echo '<a href="admin.php?sua&masach='.$r["masach"].'" class="action-button">Sửa</a>';
								echo '</form>';
								echo '</td>';
								echo '</tr>';

							}
							echo '<tr>';
							echo '<td colspan="7">1 | 2 | 3 | 4 | 5 </td>';
							echo '</tr>';							
							echo "</table></form>";
							if(isset($_REQUEST["btnXoa"])){
								$id = $_REQUEST["btnXoa"];
								$p = new msanpham();
								$r = $p->xoasp($id);
								if($r == true){
									echo '<script>alert("Xoá sản phẩm thành công")</script>';
									echo "<script>window.location.href = 'admin.php?aProd';</script>";
									exit();
									
								}else{
									echo '<script>alert("Không thành công")</script>';
								}
							}
						}
						// }

					}elseif(isset($_REQUEST["aComp"])){

						include("controller/cLoaiSanpham.php");
						$p = new cloaisanpham();
						$tblloaisp = $p->getallloaisp();
						
						if($tblloaisp==false){
							echo "error";
						}else if(!$tblloaisp)
						echo"0 result";
						else {
							echo '<h3><center>Quản lý công ty</center></h3>';
								echo '<table>';
								echo '<tr>';
								echo '<th>';
								echo 'Mã loại sách';
								echo '</th><th>';
								echo 'Tên loại sách';
								echo '</th><th>';
								echo 'Thể Loại';
								echo '</th><th>';
								echo 'Mô Tả';
								echo '</th><th>';
								echo 'Số lượng';
								echo '</th><th>';
								echo 'Hành Động';
								echo '</th>';
								echo '</tr>';
								echo '<tr>';
								$dem = 0;
								while($r = $tblloaisp->fetch_assoc()){
									echo '<td>';
									echo $r['maloaisach'];
									echo '</td>';
									echo '<td>';
									echo $r['tenloaisach'];
									echo '</td>';
									echo '<td>';
									echo $r['theloai'];
									echo '</td>';
									echo '<td>';
									echo $r['mota'];
									echo '</td>';
									echo '<td>';
									echo $r['soluong'];
									echo '</td>';
									echo '<td>';
									echo '<form method="post">';
									echo '<button class="action-button" onclick="return confirm(\'Bạn có chắc muốn xóa không?\');" type="submit" value="'.$r["maloaisach"].'" name="btnXoa">Xoá</button>';
									echo '<a href="admin.php?sua&masach='.$r["maloaisach"].'" class="action-button">Sửa</a>';
									echo '</form>';
									echo '</td>';
									echo '</tr>';
								}
								echo '</table>';
						}
					}
					elseif(isset($_REQUEST["them"])){
						include_once("view/addsanpham/index.php");
					}
					elseif(isset($_REQUEST["sua"])){
						include_once("view/suasanpham/index.php");
					}
					    elseif(isset($_REQUEST["dangxuat"])){
                        include_once("view/dangxuat/index.php");
                    }
					else{
						echo "CHÀO MỪNG BẠN ĐẾN VỚI NHÀ SÁCH NHÍ ĐÂY";
					}
				}else{
					include_once("view/dangnhap/index.php");
				}
				?>
			</td>
		</tr>
		<tr class="normal">
			<td colspan="2">Footer : Võ Văn Nhí</td>
		</tr>
	</table>
</body>
</html>