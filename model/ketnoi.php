<?php
 class clsketnoi{
    public function moketnoi(){
        return mysqli_connect('localhost','VoVanNhi','123456','quanlybansach');
    }
    public function dongketnoi($con){
        $con->close();
    }
 }
 ?>
