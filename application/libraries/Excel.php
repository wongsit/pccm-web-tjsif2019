<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ขอบคุณ บทความจาก https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/
และ Library PDF จาก https://archive.codeplex.com/?p=phpexcel
*/

require_once APPPATH."/third_party/phpexcel/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}
