<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//config email by khanchai 20190324
$config['protocol']    = 'smtp';
$config['smtp_host']    = 'ssl://smtp.gmail.com';
$config['smtp_port']    = '465';
$config['smtp_timeout'] = '7';
$config['smtp_user']    = 'noreply@pccm.ac.th';
$config['smtp_pass']    = 'password';
$config['charset']    = 'utf-8';
$config['newline']    = "\r\n";
$config['mailtype'] = 'html'; //text or html
$config['validation'] = TRUE; // bool whether to validate email or not
//
