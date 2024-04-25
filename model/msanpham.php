<?php
include_once('ketnoi.php');
class msanpham{
//lấy toàn bộ sách
    public function selectallsp(){
        $p = new clsketnoi();
        $con = $p->moketnoi();
        $con ->set_charset('utf8');
        if($con){
            $str ="select * from sach order by masach desc";
            $tblsp = $con ->query($str);
            $p->dongketnoi($con);
            return $tblsp;
        }else{
            return false;
        }
    }
    public function selectallspbyid($id){
        $p = new clsketnoi();
        $con =$p -> moketnoi();
        $con ->set_charset('utf8');
        if($con){
            $str = "select * from sach where maloaisach like '$id'";
            $tblsp = $con ->query($str);
            $p->dongketnoi($con);
            return $tblsp;
        }else{
            return false;
        }
    }
    public function selectallspbyname($name){
        $p = new clsketnoi();
        $con = $p -> moketnoi();
        $con -> set_charset('utf8');
        if($con){
            $str = "select * from sach where tensach like '%$name%'";
            $tblsp = $con ->query($str);
            $p ->dongketnoi($con);
            return $tblsp;
        }else{
            return false;
        }
    }
    //thêm sách

    public function themsach($masach, $tensach, $anh, $tacgia, $gia, $cty){
        $p = new clsketnoi();
        $con = $p->moketnoi();
        $con->set_charset('utf8');
        if($con){
            $diachi = "../web_ck/img/";
            $file = $diachi.basename($anh["name"]);
            move_uploaded_file($anh["tmp_name"], $file);
            $anh_name = basename($anh["name"]);
            $str = "insert into sach (masach, tensach, hinhanh, tacgia, gia, maloaisach) 
                    values (N'$masach', N'$tensach','$anh_name', N'$tacgia', $gia, $cty)";
            if($con->query($str) == true){
                // $last_insert_id = $con->insert_id;
                $p->dongketnoi($con);
                return true;
            }else{
                echo "Error".$str."<br>".$con->error;
                return false;
            }
        }else{
            return false;
        }
    }
    public function xoasp($id){
        $p = new clsketnoi();
        $con = $p->moketnoi();
        $con->set_charset('utf8');

        if($con){
            $xoa_id = $con->real_escape_string($id);
            $str = "DELETE FROM sach WHERE masach = '$xoa_id'";
            if($con->query($str)){
                $p->dongketnoi($con);
                return true;
            }else
                return false;
        }
    }
            //sửa
            public function selectspbyid($masach){
                $p = new clsketnoi();
                $con = $p->moketnoi();
                $con->set_charset('utf8');
                if($con){
                    $str = "select * from sach where masach = $masach";
                    $tblsp = $con->query($str);
                    $p->dongketnoi($con);
                    return $tblsp;
                }else{
                    return false;
                }
            }
            public function sua($masach, $tensach, $anh, $tacgia, $gia, $cty){
                $p = new clsketnoi();
                $con = $p->moketnoi();
                $con->set_charset('utf8');
                if($con){
                    $str ="update sach 
                    set tensach=N'$tensach', hinhanh='$anh', tacgia = N'$tacgia', gia ='$gia',maloaisach = '$cty' where masach='$masach' ";
                    if($con->query($str) == true){
                        $p->dongketnoi($con);
                        return true;
                    }else{
                        echo "Error".$str."<br>".$con->error;
                        return false;
                    }
                }else{
                    return false;
                }
            }
    
            public function dangnhap($username,$password){
                $p = new clsketnoi();
                $con = $p->moketnoi();
                $con->set_charset('utf8');
                if($con){
                    $str = "select * from taikhoan where username = '$username' and password = '$password'";
                    $tblsp = $con ->query($str);
                    $p-> dongketnoi($con);
                    return $tblsp; 
                }else{
                    return false;
                }
            }
            //đăng ký
            public function dangky($iduser, $username, $password, $hodem, $ten){
                $p = new clsketnoi();
                $con = $p->moketnoi();
                $con->set_charset('utf8');
                if ($con) {
                    $stmt = $con->prepare("INSERT INTO taikhoan (iduser, username, password, hodem, ten) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("issss", $iduser, $username, $password, $hodem, $ten);
                    if ($stmt->execute()) {
                        $p->dongketnoi($con);
                        return true;
                    } else {
                        echo "Error: " . $stmt->error;
                        return false;
                    }
                } else {
                    return false;
                }
            }
}
?>