<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 20px;
        }
        .loaisp {
            padding-left: 20px;
        }
        .loaisp > table {
            width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 3px solid black;
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        p {
            margin: 0;
        }
        
        .tenloai:hover{
            background-color: green;
        }
    </style>
</head>
    
<body>
    <div class="container">
        <table>
            <tr>
		        <td colspan="2"><img src="../web_ck/backgr.png"width ="500px"></td>
	        </tr>
            <tr>
                <td colspan="" style="width: 300px;">
                <a href="index.php">Trang chủ</a> | <a href="admin.php">Quản lý</a>
                <?php
                ?>
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <form action="" method="post">
                        <div class="search-container" style="float: right;">
                            <input type="text" name="txtsearch" placeholder="search">
                            <button type="submit" name="btnsearch">search</button>
                        </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td class="loaisp">
                    <?php 
                    include_once("view/loaisanpham/index.php");
                    ?>
                </td>
                <td>
                    <?php 
                    include_once("view/sanpham/index.php"); 
                    ?>
                </td>
            </tr>
            <tr>
		        <td colspan="2">Footer : Võ Văn Nhí</td>
	        </tr>
        </table>
    </div>
</body>
</html>

