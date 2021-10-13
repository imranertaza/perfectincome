<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pin_generat extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('settings_functions');
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


	public function pin_generate_list()
	{
				
		
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_download') == true) {
				$this->load->model('pingenerat/pingenerat');

			
				// $data['pinList'] = $this->db->get('pins')->result();


					$this->db->select('user_id');
				 	$this->db->group_by('user_id'); 
					$this->db->order_by('user_id', 'desc'); 
				 	$data['pinList'] =$this->db->get('pins')->result();





				$this->load->view('admin/Pine_gnerate/pin_generate',$data);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
		
		
	}
	
	public function pin_generate()
	{
		// if ($this->login_status == true) {
		// 	$this->load->view('admin/header');
		// 	$this->load->view('admin/sidebar');;
		// 	if ($this->functions->hasPermission('add_download') == true) {
		// 		$this->load->model('pingenerat/pingenerat');
				

				

		// 		$this->load->view('admin/Pine_gnerate/pin_generate_form');
		// 	}else {
		// 		$this->load->view('admin/no_permission');
		// 	}
		// 	$this->load->view('admin/footer');
		// }else  {
		// 	$this->load->view('admin/login');
		// }

		print "This module is currently stopped.";
	}

	public function view_agent_pin($id){
		if ($this->login_status == true) {
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');;
			if ($this->functions->hasPermission('add_download') == true)
			 {
						

				$data['agent']=$this->db->get_where('pins',array('user_id' => $id))->result();

				$this->load->view('admin/Pine_gnerate/view_pin',$data);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->view('admin/login');
		}
	}
	
	
	public function pin_generat_action()
	{
		$this->load->library('session');
		$this->_rules();

	        if ($this->form_validation->run() == FALSE) {
	            $this->create();
	       	 } else {
	       	 		$num_pins = $this->input->post('amount',TRUE);
	    			$userName = $this->input->post('user_id',TRUE);
	    			$usrID = get_userid_by_username($userName);
	    			for($i = 1; $i <= $num_pins; $i++) {
	    				$pin = $this->generate();
			            $data = array(
			      			'user_id' => $usrID,
							'pin' => $pin,
						);
		            	$query = $this->db->insert('pins', $data);
	            	}
	            	$this->session->set_flashdata('message', "<P class='success'>Create Record Success</p>");
	            	redirect(site_url('pin_generat/pin_generate_list'));
				}
	}

	public function generate() 
	{
	    $len_pins = 15; 
	    $pins = random_string('alnum', $len_pins); 
	    return $pins;
	}

	public function _rules(){
		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required');
		$this->form_validation->set_rules('pin', 'pin', 'trim|required');
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */