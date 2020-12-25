<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * /application/core/MY_Loader.php
 *
 */
class MY_Loader extends CI_Loader {

    public function MY_View($view_file, $vars = array(), $return = FALSE){
        
        // Use this code if you need add some global variable
        // 
        // $CI =& get_instance();
        // $var_1 = array(
        //     'example_var' => 'example',
        //     'example_query' => $CI->example_model->example()
        // );
        
        // $vars = array_merge($vars, $var_1);
        
        if ($return){
            $content  = $this->view('header', $vars, $return);
            $content .= $this->view($view_file, $vars, $return);
            $content .= $this->view('footer', $vars, $return);
            return $content;
            
        } else {
            $this->view('header', $vars);
            $this->view($view_file, $vars);
            $this->view('footer', $vars);
            
        }
    }
}