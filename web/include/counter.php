<?php
$wantcount = true; 
$counter_file = "./include/counter.txt";//สร้างไฟล์ใน notepad แล้วตั้งชื่อนี้ counter.txt แล้วpermission 777
if($wantcount){
    if (file_exists($counter_file) and is_writeable($counter_file)){
        $fp = fopen($counter_file,"r+") or die("Read File Error !");
        $count = fread($fp, filesize($counter_file));
        fclose($fp);
        $fp = fopen($counter_file,"w+") or die("Write File Error !");
        $count +=1;
        $count =$count;
        fputs($fp, $count);
        fclose($fp);
        echo "  $count";
    }
}
?>