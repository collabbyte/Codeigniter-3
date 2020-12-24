<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller
{
    // Global Function
    function __construct()
    {
        parent::__construct();
        $this->load->model('example_model');
        
        // // Show All Sessions Saved
        // echo '<pre>',print_r($this->session->all_userdata(), 1),'</pre>';
        // // Show All Cookies Saved
        // echo '<pre>',print_r($this->input->cookie(), 1),'</pre>';
    }
    
	public function index()
	{
		$this->load->view('index');
	}
    
    // Function Load View Without Array Variables Sended
	public function view_without_variables()
	{
		$this->load->view('example');
	}
    
    // Function Load View With Array Variables Sended
	public function view_with_variables()
	{
		// Load Related Models.
		$this->load->model('example_model');

        $data = array(
            'object_variable' => $value
        );
		$this->load->view('example', $data);
	}
    
    // Function Load MY_View Without Array Variables Sended
	public function myview_without_variables()
	{
		$this->load->MY_View('example');
	}
    
    // Function Load View With Array Variables Sended
	public function myview_with_variables()
	{
		// Load Related Models.
		$this->load->model('example_model');

        $data = array(
            'object_variable' => $value
        );
		$this->load->MY_View('example', $data);
	}
    
    public function sitemap()
	{
		// Load Related Models.
		$this->load->model('example_model');
        
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
