<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_mail extends CI_Model{
    
    function  __construct(){
        parent::__construct();
        $this->load->library('email');
    }

    function send($info) {
        $this->email->from($info['from']['email'], $info['from']['name']);
        $this->email->to($info['to']);
        $this->email->subject($info['subject']);
        $this->email->message($info['content']);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
 
}