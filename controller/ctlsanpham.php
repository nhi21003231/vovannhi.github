<?php
include_once("model/msanpham.php");
class csanpham{
    public function getallsp(){
        $p = new msanpham();
        $tblsp = $p -> selectallsp();
        if(!$tblsp){
            return -1;
        }else{
            if($tblsp -> num_rows >0){
                return $tblsp;
            }else{
                return 0;
            }
        }
    }
    public function getallspbyid($id){
        $p = new msanpham();
        $tblsp = $p -> selectallspbyid($id);
        if(!$tblsp){
            return -1;
        }else{
            if($tblsp ->num_rows>0){
                return $tblsp;
            }else{
                return 0;
            }
        }
    }
    public function getallspbyname($name){
        $p = new msanpham();
        $tblsp = $p -> selectallspbyname($name);
        if(!$tblsp){
            return -1;
        }else{
            if($tblsp ->num_rows>0){
                return $tblsp;
            }else{
                return 0;
            }
        }
    }
    public function getspbyid($masach){
        $p = new msanpham();
        $tblsp = $p ->selectspbyid($masach);
        if(!$tblsp){
            return -1;
        }else{
            if($tblsp -> num_rows >0){
                return $tblsp;
            }else{
                return 0;
            }
        }
    }
    public function getdangnhap($username,$password){
        $p = new msanpham();
        $result = $p->dangnhap($username,$password);
        if(!$result){
            echo "không có";
            return -1;
        }else{
            if($result -> num_rows>0){
                return $result;
            }else{
                return 0; // la 0 co dong du lieu 
            }
        }
    }
}

?>
