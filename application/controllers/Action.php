<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action extends MY_Controller
{
    // Global Function
    function __construct()
    {
        parent::__construct();
    }
    
    // Kill Index
	public function index()
	{
		show_404();
	}
}