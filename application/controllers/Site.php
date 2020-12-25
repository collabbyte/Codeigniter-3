<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller
{
    // Example Call Dynamic Model
    // $this->model = new Dynamic_model('table');
    // $this->model->parameter

    function __construct()
    {
        parent::__construct();
        $this->model = new Dynamic_model('data');
    }
    
	public function index()
	{
		$this->load->view('index');
	}
    
	public function images($FileDir, $width, $filename)
	{
        if (isset($filename)){
            
            $FileUrl = 'assets/images/'.$FileDir.'/'.$filename;
            
            if(!file_exists($FileUrl)){
                show_404();
            }
            
            $this->load->library('image_lib');
            
            // configure image library
            $config = array(
                'image_library' => 'gd2',
                'source_image' => $FileUrl,
                'create_thumb' => true,
                'maintain_ratio' => true,
                'dynamic_output' => true,
                'quality' => '60%',
                'width' => $width
            );
            
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            
        }
	}
}
