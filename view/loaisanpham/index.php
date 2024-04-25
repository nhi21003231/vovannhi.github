<?php
    include("controller/cloaisanpham.php");
    $p = new cloaisanpham();
    $tblloaisp = $p->getallloaisp();
    if($tblloaisp==-1){
        echo "error";
    }else if(!$tblloaisp)
    echo"0 result";
    else {
        echo"<table>";
        echo"<tr class='tenloai'>";
        $dem = 0;
        while($r = $tblloaisp->fetch_assoc()){
            echo '<td>';
            echo"<a href='index.php?id=".$r['maloaisach']."'>".$r['tenloaisach']."</a>";

            echo '</td>';
            $dem++;
            if($dem%1==0){
                echo"</tr><tr class='tenloai'>";
            }
        }
        echo"</tr>";
        echo"</table>";
    }
?>
