<?php 
    include_once("controller/ctlsanpham.php");
    $p = new csanpham();
    if(isset($_GET['masach'])) {
        $masach = $_GET['masach'];
        $sanpham = $p->getspbyid($masach);
        $r = $sanpham ? $sanpham->fetch_assoc() : null;
    
        if(!$r){
            echo "Sản phẩm không tồn tại";
            exit;
        } else {
            ?>
            <?php echo '<h1>Chi tiết sản phẩm</h1> ';?>
                <img src="img/<?php echo $r['hinhanh']; ?>" alt="<?php echo $r['tensach']; ?>" style="width: 10%;"> <br>
                <?php
                echo 'Mã sách: '. $r['masach'].'<br> '; 
                echo 'Tên sách: '. $r['tensach'].'<br> ';
                echo 'Tác giả: '. $r['tacgia']. '<br> ';
                ?>
                <p>Giá: <?php echo number_format($r['gia'], 0, ',', '.'); ?> VNĐ</p>
            <?php
        }
    }
    else{
        if(isset($_REQUEST['id'])){
            $tblsp = $p->getallspbyid($_REQUEST['id']);
            if(isset($_REQUEST["btnsearch"])){
            $tblsp = $p->getallspbyname($_REQUEST["txtsearch"]);
            }
        }elseif(isset($_REQUEST["btnsearch"])){
            $tblsp = $p->getallspbyname($_REQUEST["txtsearch"]);
        }else{
            $tblsp = $p->getallsp();
        }
        if($tblsp==false){
            echo "error ";
        }elseif(!$tblsp) 
        echo"0 result";
        else {
            echo"<table>";
            echo"<tr>";
            $dem = 0;
            while($r = $tblsp->fetch_assoc()){
                echo '<td>';
                echo'<img width="70px" src="img/'.$r['hinhanh'].'">'.'<br>';
                echo '<a href="index.php?masach='.$r['masach'].'">'.$r['tensach'].'</a><br>';
                echo number_format($r['gia'],0,',','.').' VNĐ'.'<br></td>';
                $dem++;
                if($dem%4==0){
                    echo"</tr><tr>";
                }
            }
            echo"</tr>";
            echo"</table>";
        }
    
    }

?>
