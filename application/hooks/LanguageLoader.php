<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageLoader
{
  function initialize()
  {
    $ci = & get_instance();
    $ci->load->helper('language');
    $siteLang = $ci->session->userdata('site_lang');
    if($siteLang){
      $ci->lang->load('content', $siteLang);    //โหลดเนื้อหา
      $ci->lang->load('form_validation', $siteLang);  //โหลดฟอร์ม
      $ci->lang->load('admission', $siteLang);  //โหลดงานรับรักเรียน
      $ci->lang->load('db', $siteLang);  //โหลดงานรับรักเรียน
    }else{
      $default_lang = 'english';      
      $ci->lang->load('content',$default_lang);
      $ci->lang->load('form_validation',$default_lang);
      $ci->lang->load('admission',$default_lang);
      $ci->lang->load('db', $default_lang);  //โหลดงานรับรักเรียน
    }
  }
}
