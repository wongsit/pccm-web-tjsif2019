<?php
if (!defined('BASEPATH'))
 exit('No direct script access allowed');

 /**
  * profile model by khanchai 2018122101
  */
 class System_model extends CI_Model
 {
   public function __cinstruc(){
     parent::__construc();
   }
    /* Function to get the client IP address ขอบคุณฟังก์ชั่นจาก stackoverflow
    https://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
    */
    public function get_client_ip() {
       $ipaddress = '';
       if (getenv('HTTP_CLIENT_IP'))
           $ipaddress = getenv('HTTP_CLIENT_IP');
       else if(getenv('HTTP_X_FORWARDED_FOR'))
           $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
       else if(getenv('HTTP_X_FORWARDED'))
           $ipaddress = getenv('HTTP_X_FORWARDED');
       else if(getenv('HTTP_FORWARDED_FOR'))
           $ipaddress = getenv('HTTP_FORWARDED_FOR');
       else if(getenv('HTTP_FORWARDED'))
          $ipaddress = getenv('HTTP_FORWARDED');
       else if(getenv('REMOTE_ADDR'))
           $ipaddress = getenv('REMOTE_ADDR');
       else
           $ipaddress = 'UNKNOWN';
       return $ipaddress;
    }

    /*
    Date Function ขอบคุณ w3schools
    https://www.w3schools.com/php/php_date.asp
    date(format,timestamp)
    d - Represents the day of the month (01 to 31)
    m - Represents a month (01 to 12)
    Y - Represents a year (in four digits)
    l (lowercase 'L') - Represents the day of the week

    h - 12-hour format of an hour with leading zeros (01 to 12)
    i - Minutes with leading zeros (00 to 59)
    s - Seconds with leading zeros (00 to 59)
    a - Lowercase Ante meridiem and Post meridiem (am or pm)
    */
    public function get_date_time(){
      date_default_timezone_set("Asia/Bangkok");
      return date("Y-m-d h:i:sa");
    }

    public function get_date(){
      date_default_timezone_set("Asia/Bangkok");
      return date("Y-m-d");
    }
}
