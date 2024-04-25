<?php
include("model/mloaisanpham.php");
class cloaisanpham{
    public function getallloaisp(){
        $p = new mloaisanpham();
        $tblloaisp = $p -> selectallloaisp();
        if(!$tblloaisp){
            return -1;
        }else{
            if($tblloaisp -> num_rows >0){
                return $tblloaisp;
            }else{
                return 0;
            }
        }
    }
}

?>