<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Show All Sessions Saved
        // echo '<pre>',print_r($this->session->all_userdata(), 1),'</pre>';
        
        // Show All Cookies Saved
        // echo '<pre>',print_r($this->input->cookie(), 1),'</pre>';
    }
}