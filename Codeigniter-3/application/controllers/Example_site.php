<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller
{
    // Example Call Dynamic Model
    // $this->model = new Dynamic_model('table');
    // $this->model->parameter

    // Global Function
    function __construct()
    {
        parent::__construct();
        $this->table = new Dynamic_model('table');
        
        // // Show All Sessions Saved
        // echo PrintArray($this->session->all_userdata());
        // // Show All Cookies Saved
        // echo PrintArray($this->input->cookie());
    }
    
    // Function Load MY_View Without Array Variables Sended
	public function myview_default()
	{
		$this->load->MY_View('example');
	}
    
    // Function Load View With Array Variables Sended
	public function myview_with_variables()
	{
        $data = array(
            'object_variable' => $value
        );
		$this->load->MY_View('example', $data);
	}
    
    public function sitemap()
	{        
        $data = array(
            'object_variables' => $value
        );
        header("Content-Type: text/xml;charset=iso-8859-1");
		$this->load->view('sitemap', $data);
    }
    
    public function robots()
	{
        header("Content-Type: text/plain");
		$this->load->view('robots');
    }
    
    public function ping_search_engine()
	{
        $google = curl_do_api('https://www.google.com/ping?sitemap='.base_url().'sitemap.xml');
        $bing = curl_do_api('https://www.bing.com/ping?sitemap='.base_url().'sitemap.xml');
    }
}
