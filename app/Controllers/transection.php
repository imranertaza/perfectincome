<?php
class transection extends CI_Controller {
	
	private $login_status;

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('functions');
		//$this->load->model('user_login');
		$this->load->library('form_validation');
		$this->load->helper('settings_functions_helper');
		if ($this->session->userdata('logged_in') == true) {
			$this->login_status = true;
		}else {
			$this->login_status = false;
		}
	}

	public function load_agent_balance()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				#$this->load->model('Location/categoryModel');
			
			$info['msg'] = '';	
			if (isset($_POST['add_balance'])) {
				
				$this->form_validation->set_rules('balance', 'Balance', 'trim|required|xss_clean|integer|numeric');
				$this->form_validation->set_rules('agent_id', 'Agent ID', 'trim|required|xss_clean|callback_username_check');
				
				if ($this->form_validation->run() == true) {
				$agent_id = get_userid_by_username($_POST['agent_id']);
					if (!empty($agent_id)) {
						$old_balance = get_field_by_id_from_table('users', 'balance', 'username', $_POST['agent_id']);
						$balance = $old_balance + $_POST['balance'];
						$data = array(
									'balance' => $balance
									);
						$this->db->where('username', $_POST['agent_id']);
						$succes= $this->db->update('users', $data);
		
						$tran = array(
									'amount' => $_POST['balance'],
									'agent_id' => $agent_id,
									'comment' => 'Agent Loaded',
									'type' => '1',
									'status' => 'Confirm'
									);
						$info['succes'] = $this->db->insert('balance_request', $tran);
						if (isset($succes)) {
							$info['msg'] = '<p class="success">Successfully Loaded</p><META HTTP-EQUIV="refresh" CONTENT="1; URL='.base_url().'transection/load_agent_balance/">';
						}else {
							$info['msg'] = '<p class="error">Sorry! Something your put wrong.</p>';	
						}
					}else {
						$info['msg'] = '<p class="error">Sorry! Sorry this agent ID is not exist.</p>';	
					}
				}
				
			}
			
			
			
			
			
			
			$info['query'] = $this->db->get_where('balance_request', array("status"=>"Confirm"));
				
				$this->load->view('admin/transection/load_agent_balance', $info);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
		}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
		
	}
	
	
	
	
	public function request_agent_balance()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				#$this->load->model('Location/categoryModel');
			
			$info['msg'] = '';
			if (isset($_POST['confirm'])) {
				$re_id= $_POST['re_id'];
				$row = $this->db->get_where('balance_request', array('req_id' => $re_id))->row();
				$old_balance = get_field_by_id_from_table('users', 'balance', 'ID', $row->agent_id);
				$balance = $old_balance + $row->amount;
				$data = array(
							'balance' => $balance
							);
				$this->db->where('ID', $row->agent_id);
				$succes= $this->db->update('users', $data);
				
				
				
				
				$data = array(
               		'status' => "Confirm"
            	);

			$this->db->where('req_id', $re_id);
			$succes = $this->db->update('balance_request', $data); 
				if (isset($succes)) {
					$info['msg'] .= '<p class="success">Successfully Confirmed!</p><META HTTP-EQUIV="refresh" CONTENT="1; URL='.base_url().'transection/request_agent_balance/">';
				}else {
					$info['msg'] .= '<p class="error">Sorry! Something your put wrong.</p>';	
				}
		
			}


			$info['query'] = $this->db->get_where('balance_request', array("status"=>"Panding", "type"=>"1"));
				
				$this->load->view('admin/transection/req_agent_balance', $info);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
	}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
	}
	
	
	
	
	public function request_stock_balance()
	{
		
		if ($this->login_status == true) {
			$this->load->helper('url');
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			if ($this->functions->hasPermission('add_category') == true) {
				#$this->load->model('Location/categoryModel');
			
			$info['msg'] = '';
			if (isset($_POST['confirm'])) {
				$re_id= $_POST['re_id'];
				$row = $this->db->get_where('balance_request', array('req_id' => $re_id))->row();
				$old_balance = get_field_by_id_from_table('users', 'balance', 'ID', $row->agent_id);
				$balance = $old_balance + $row->amount;
				$data = array(
							'balance' => $balance
							);
				$this->db->where('ID', $row->agent_id);
				$succes= $this->db->update('users', $data);
				
				
				
				
				$data = array(
               		'status' => "Confirm"
            	);

			$this->db->where('req_id', $re_id);
			$succes = $this->db->update('balance_request', $data); 
				if (isset($succes)) {
					$info['msg'] .= '<p class="success">Successfully Confirmed!</p><META HTTP-EQUIV="refresh" CONTENT="1; URL='.base_url().'transection/request_stock_balance/">';
				}else {
					$info['msg'] .= '<p class="error">Sorry! Something your put wrong.</p>';	
				}
		
			}


			$info['query'] = $this->db->get_where('balance_request', array("status"=>"Panding", "type"=>"2"));
				
				$this->load->view('admin/transection/req_stock_balance', $info);
			}else {
				$this->load->view('admin/no_permission');
			}
			$this->load->view('admin/footer');
	}else  {
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->view('admin/login');
		}
	}
	
	
	
	
	public function username_check($username){
			$query = $this->db->query("SELECT `ID` FROM `users` WHERE `username` = '$username'");
			if (empty($query->num_rows)) {
					$this->form_validation->set_message('username_check', 'Sorry! This username ('.$username.') is not exist.');
					return FALSE;
			}
			else{ return TRUE; }
    }


}


?>