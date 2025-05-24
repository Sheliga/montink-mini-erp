<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['protocol']    = 'smtp';
$config['smtp_host']   = 'localhost'; // MailHog padrão
$config['smtp_port']   = 1025;
$config['smtp_user']   = ''; // MailHog não exige auth
$config['smtp_pass']   = '';
$config['mailtype']    = 'html';
$config['charset']     = 'utf-8';
$config['newline']     = "\r\n";
