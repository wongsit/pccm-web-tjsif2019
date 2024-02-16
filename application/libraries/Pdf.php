<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ขอบคุณ บทความจาก http://phpcodemania.blogspot.com/2017/09/php-codeigniter-pdf-tcpdf-fpdi-2.html
และ Library PDF จาก https://www.setasign.com/products/fpdi/demos/tcpdf-demo/
และ https://tcpdf.org/
*/
require_once APPPATH.'third_party/tcpdf/tcpdf.php';
require_once APPPATH.'third_party/fpdi/autoload.php';

use setasign\Fpdi;

class Pdf extends Fpdi\TcpdfFpdi
{
    function __construct()
    {
        parent::__construct();
    }
}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
