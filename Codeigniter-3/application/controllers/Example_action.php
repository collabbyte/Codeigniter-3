<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action extends MY_Controller
{
    // Global Function
    function __construct()
    {
        parent::__construct();
        $this->table = new Dynamic_model('table');
    }
    
    // Kill Index
	public function index()
	{
		show_404();
    }
    
    // Login Function
    public function login()
    {
        // Check Real Input or Fake
        if ($this->input->post('submit_data') === null){
            show_404();
            
        } else {

            // POST to Variables
            $account = $this->input->post('post_account_variable');
            $password = $this->input->post('post_password_variable');

            // Encrypting POST to sha256
            $sha_password = sha_data($account, $password);

            // Checking Data from Table
            $data = $this->table->where_row('colomn_account', $account);
            
            // Checking Query work or not
            if ($data){

                // Checking Data exist or not.
                if ($data->count_data == 0){
                    $result = array(
                        'status' => 'failure',
                        'text' => 'Account Not Found.',
                        'url' => '',
                    );

                    echo 'Account Not Found.';
                    
                // Checking Passwrd Data, same or not.
                } elseif ($data->password !== $sha_password){
                    $result = array(
                        'status' => 'failure',
                        'text' => 'Wrong password.',
                        'url' => '',
                    );
                    
                } else {
    
                    // Saving data to session
                    $this->session->set_userdata('id', $data->id);
                    $this->session->set_userdata('account', $data->account);
    
                    // Redirect to next page
                    $result = array(
                        'status' => 'success',
                        'text' => 'Welcome back, '.$data->account.'.',
                        'url' => '',
                    );
                    
                }
            } else {
                $result = array(
                    'status' => 'failure',
                    'text' => 'Somethink Error, Please Try Again Later.',
                    'url' => '',
                );
            }
            echo json_encode($result);
        }
    }
    
    // Insert Data to Tables
    public function Insert_data()
    {
        // Check Real Input or Fake
        if ($this->input->post('submit_data') === null){
            show_404();
            
        } else {

            // Load Related Models.
            $this->load->model('table');

            // List Data want to insert, format array
            $data = array(
                'colomn_name' => $value
            );

            // Inserting $data array to tables
            $Query = $this->table->insert_data($data);

            // Checking Query work or not
            if ($Query){
                $result = array(
                    'status' => 'success',
                    'text' => 'Insert Data Success.',
                    'url' => '',
                );

            } else {
                $result = array(
                    'status' => 'failure',
                    'text' => 'Somethink Error, Please Try Again Later.',
                    'url' => '',
                );
            }
            echo json_encode($result);
            
        }
    }
    
    // Edit Data Function
    public function edit_data()
    {
        // Check Real Input or Fake
        if ($this->input->post('submit_data') === null){
            show_404();
            
        } else {
            
            // Load Related Models.
            $this->load->model('table');

            // Update row from where Array Data
            $where = array(
                'colomn_name' => $value
            );

            // List Updated data from Array
            $data = array(
                'colomn_name' => $value
            );

            // Update Tables fix $where and update list from $data 
            $Query = $this->table->update_data($where, $data);

            // Checking Query work or not
            if ($Query){
                $result = array(
                    'status' => 'success',
                    'text' => 'Update Data Success.',
                    'url' => '',
                );

            } else {
                $result = array(
                    'status' => 'failure',
                    'text' => 'Somethink Error, Please Try Again Later.',
                    'url' => '',
                );
            }
            echo json_encode($result);
        }
    }
    
    // Delete Data Function
    public function delete_data()
    {
        // Check Real Input or Fake
        if ($this->input->post('submit_data') === null){
            show_404();
            
        } else {
            
            // Load Related Models.
            $this->load->model('table');

            // delete row from where Array Data
            $where = array(
                'colomn_name' => $value
            );

            // Update Tables fix $where and update list from $data 
            $Query = $this->table->delete_data($where);

            // Checking Query work or not
            if ($Query){
                $result = array(
                    'status' => 'success',
                    'text' => 'Delete Data Success.',
                    'url' => '',
                );

            } else {
                $result = array(
                    'status' => 'failure',
                    'text' => 'Somethink Error, Please Try Again Later.',
                    'url' => '',
                );
            }
            echo json_encode($result);
        }
    }
    
    // Upload Image Function
    public function Upload_IMG()
    {
        // Check Real Input or Fake
        if ($this->input->post('submit_data') === null){
            show_404();
            
        } else {

            // Save File Location
            $file_location = 'assets/images/directory/';
            
            // Upload Config
            $config['upload_path']          = $file_location;
            $config['allowed_types']        = 'jpg|jpeg';
            $config['encrypt_name']         = TRUE;
            $config['file_ext_tolower']     = TRUE;
            $config['max_size']             = 5120;
            $config['min_width']            = 512;

            // Load Upload library with config.
            $this->load->library('upload', $config);

            // Checking Upload Image
            if ( $this->upload->do_upload('form_name_input_image')){
                
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = $file_location.$gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['new_image'] = $file_location.$gbr['file_name'];
                
                $this->load->library('image_lib', $config);

                // Checking Image Resize or not
                $resize = $this->image_lib->resize();
                if ($resize) {
                    $result = array(
                        'status' => 'success',
                        'text' => 'Upload Success With Resize.',
                        'url' => '',
                    );
                    
                } else {
                    $result = array(
                        'status' => 'failure',
                        'text' => 'Upload Success Without Resize, Please Try Again Later.',
                        'url' => '',
                    );
                }
                
            } else {
                $result = array(
                    'status' => 'failure',
                    'text' => 'Upload Failed, Please Try Again Later.',
                    'url' => '',
                );
                
            }
            echo json_encode($result);
        }
    }
    
    // Replace exist Image Function
    public function Replace_IMG()
    {
        // Check Real Input or Fake
        if ($this->input->post('submit_data') === null){
            show_404();
            
        } else {
            
            // Get Old filename from Form
            $old_file_name = $this->input->post('form_name_input_image_old');

            // Save File Location
            $file_location = 'assets/images/directory/';
            
            // Deleting File
            $delete_file = unlink($file_location.$old_file_name);

            // Check Deleting File
            if ($delete_file){
            
                // Upload Config
                $config['upload_path']          = $file_location;
                $config['allowed_types']        = 'jpg|jpeg';
                $config['encrypt_name']         = TRUE;
                $config['file_ext_tolower']     = TRUE;
                $config['max_size']             = 5120;
                $config['min_width']            = 512;
    
                // Load Upload library with config.
                $this->load->library('upload', $config);
    
                // Checking Upload Image
                if ( $this->upload->do_upload('form_name_input_image_new')){
                    
                    $gbr = $this->upload->data();
                    //Compress Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $file_location.$gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 1024;
                    $config['new_image'] = $file_location.$gbr['file_name'];
                    
                    $this->load->library('image_lib', $config);
    
                    // Checking Image Resize or not
                    $resize = $this->image_lib->resize();
                    if ($resize) {
                        $result = array(
                            'status' => 'success',
                            'text' => 'Change Success With Resize.',
                            'url' => '',
                        );
                        
                    } else {
                        $result = array(
                            'status' => 'failure',
                            'text' => 'Upload Success Without Resize, Please Try Again Later.',
                            'url' => '',
                        );
                    }
                    
                } else {
                    $result = array(
                        'status' => 'failure',
                        'text' => 'Upload Failed, Please Try Again Later.',
                        'url' => '',
                    );
                    
                }

            } else {
                $result = array(
                    'status' => 'failure',
                    'text' => 'Deleting File Failed, Please Try Again Later.',
                    'url' => '',
                );
            }
            echo json_encode($result);
        }
    }
    
    // Delete exist Image Function
    public function Delete_IMG()
    {
        // Check Real Input or Fake
        if ($this->input->post('submit_data') === null){
            show_404();
            
        } else {
            
            // Get filename from Form
            $file_name = $this->input->post('form_name_input_image');

            // Save File Location
            $file_location = 'assets/images/directory/';
            
            
            // Deleting File
            $delete_file = unlink($file_location.$old_file_name);

            // Check Deleting File
            if ($delete_file){
                $result = array(
                    'status' => 'success',
                    'text' => 'Deleting File Success.',
                    'url' => '',
                );

            } else {
                $result = array(
                    'status' => 'failure',
                    'text' => 'Deleting File Failed, Please Try Again Later.',
                    'url' => '',
                );
            }
            echo json_encode($result);
        }
    }
    
    public function summernote_upload()
    {
        
        if (!isset($_FILES["summernote_image"]) && empty($_FILES["summernote_image"]["name"])){
            show_404();
            
        } else {
            

            // Generate New File Name
            $file_name = Gen_Randomtext(3).'_'.time().'.jpg';

            // Save File Location
            $file_location = 'assets/images/directory/';
            
            $config['file_name']            = $file_name;
            $config['upload_path']          =  $file_location;
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['encrypt_name']         = TRUE;
            $config['file_ext_tolower']     = TRUE;
            $config['max_size']             = 5120;
            $config['min_width']            = 512;

            $this->load->library('upload', $config);

            if ( $this->upload->do_upload('summernote_image')){
                
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] ='gd2';
                $config['source_image'] = $file_location.$gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 1024;
                $config['new_image'] =  $file_location.$gbr['file_name'];
                
                $this->load->library('image_lib', $config);
                if ($this->image_lib->resize()){
                    
                    echo base_url(). $file_location.$file_name;
                    
                } else {
                    echo 'Post Gagal.';
                }
                
            } else {
                print_r($this->upload->display_errors());
                echo 'Gagal Upload Gambar.';
                
            }
        }
    }
    
    public function summernote_delete()
    {
        if (!isset($_POST["src"])){
            show_404();
            
        } else {
            $src = $_POST["src"];
            $file_name = str_replace(RealURL(), '', $src);
            if(unlink($file_name))
            {
                echo 'File Delete Successfully';
            }
            
        }
    }
}