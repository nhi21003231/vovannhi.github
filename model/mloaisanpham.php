<?php
include_once('ketnoi.php');
    class mloaisanpham{
        public function selectallloaisp(){
            $p = new clsketnoi();
            $con = $p->moketnoi();
            $con -> set_charset('utf8');
            if($con){
                $str = " select * from loaisach";
                $tblloaisp = $con -> query($str);
                $p ->dongketnoi($con);
                return $tblloaisp;
            }else{
                return "false";
            }
        }
    }
?>