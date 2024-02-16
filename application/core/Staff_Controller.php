<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin_Controller by khanchai 20181221
 */
class Staff_Controller extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    if($this->session->userdata('username') == null){
      $this->session->set_userdata(array('url_req' => current_url()));      //เก็บ url
      redirect('users/account/login');    //login
    }else{
      if($this->session->userdata('type') != 4){  //4 = staff
        redirect('users/account/index');
      } //if
    } //if
  } //function
} //class
