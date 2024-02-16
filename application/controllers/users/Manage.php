<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * profile by khanchai 20181221
 */
class Manage extends Users_Controller
{

  function index()
  {
    $data['users'] = $this->Users_model->findAll();
    $data['title'] = $this->lang->line('site_name');
    $data['page'] = 'users/profile/index';
    $this->load->view('templates/kaesad',$data);
  }
}
