<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class download extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->library('form_validation');
		$this->load->model('users/user_login');
		
		if ($this->session->userdata('logged_in') == true) {
			$this->login_status = true;
		}else {
			$this->login_status = false;
		}
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function download_list()
	{
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('download_list') == true) {
			//$this->load->model('Download/downloads');
			$this->load->library('pagination');
			
			$data['base_url'] = base_url().'Download/download_list/';
			$data['total_rows'] = $this->db->get('downloads')->num_rows();
			$data['per_page'] = 10; 
			$data['uri_segment'] = 4;
			$data['num_links'] = 5;
			$get_segment_uri = $this->uri->segment(4);
			$data['segment'] = empty($get_segment_uri) ? 0 : $get_segment_uri;
			$query = $this->db->query("SELECT * FROM `downloads` ORDER BY `dwn_id` DESC LIMIT ".$data['segment'].", ".$data['per_page']);
			$data['records'] = $query->result();
			$this->pagination->initialize($data);
			$data['pagination'] = $this->pagination->create_links();
			
			$this->load->view('admin/Download/download_list', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	public function add_new_download()
	{
		$data['msg'] = '';
		$data['error'] = '';
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_download') == true) {
				$this->load->model('Download/downloads');

				$this->load->view('admin/Download/add_new_download', $data);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}


	public function add_new_downlaod_action(){
        if (isset($_POST['add_download'])) {

            $title = $_POST['title'];
            $description = $_POST['description'];
            $category = isset($_POST['Category']) ? $_POST['Category'] : 0;
            $cat_id = '';
            if (!empty($category)) {
                foreach($category as $key=>$val) {
                    $cat_id .= $val.',';
                }
            }

            $file_name = 'f_dwn_'.time().'.pdf';

            $config['upload_path'] = 'uploads/downloads/';
            $config['allowed_types'] = "pdf|csv";
            $config['file_name'] = $file_name;
            $config['max_size']	= 0;

            $this->load->library('upload', $config);
            //$this->upload->initialize($config);
            $this->upload->do_upload('userfile');
            //$data['upload_data'] = $this->upload->data();



            $update_page = $this->db->query("INSERT INTO `downloads` SET 
											`title` 			= '$title',
											`cat_id` 			= '$cat_id',
											`description` 		= '$description',
											`file`				= '$file_name'");

            if ($update_page) {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Your account is inactive. You can not transfer balance.</div>");
            }else {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Your account is inactive. You can not transfer balance.</div>");
            }
        }


        redirect("Download/download_list/");

    }
	
	
	public function edit_download($dwn_id)
	{
		$data['msg'] = '';
		$data['error'] = '';
		$data['dwn_id'] = $dwn_id;
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('edit_download') == true) {
			//$this->load->model('Download/downloads');
			if (isset($_POST['edit_download'])) {
				
			
			//$old_file = mysql_fetch_array(mysql_query("SELECT `file` FROM `downloads` WHERE `dwn_id` = '$dwn_id'"));
			$old_file = $this->db->query("SELECT `file` FROM `downloads` WHERE `dwn_id` = '$dwn_id'")->row();
			$old_f_file = $old_file['file'];
			$file_name = empty($_FILES["userfile"]["name"]) ? $old_f_file : 'f_dwn_'.time().'.pdf';
			if (!empty($_FILES["userfile"]["name"])) {
				if (file_exists('uploads/downloads/'.$old_f_file)) {
					unlink('uploads/downloads/'.$old_f_file);
				}
			}
			
			
			$title = $_POST['title'];
			$description = $_POST['description'];
			$category = isset($_POST['Category']) ? $_POST['Category'] : 0;
			$cat_id = '';
			if (!empty($category)) {
				foreach($category as $key=>$val) {
					$cat_id .= $val.',';
				}
			}
			
			
			$config['upload_path'] = 'uploads/downloads/';
			$config['allowed_types'] = "pdf|csv";
			$config['file_name'] = $file_name;
			$config['max_size']	= 0;
	
			$this->load->library('upload', $config);
			
			$update_page = $this->db->query("UPDATE `downloads` SET 
									`title` 			= '$title',
									`cat_id` 			= '$cat_id',
									`description` 		= '$description',
									`file`				= '$file_name'
									WHERE `downloads`.`dwn_id` = '$dwn_id'");
			if ($update_page) {
				$this->upload->do_upload('userfile');
				$data['msg'] = '<p class="success">File Updated Successfully!</p>';
			}
			
			
			
			}
			
			
			
			$this->load->view('admin/Download/edit_download', $data);
			
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */