<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('settings_functions_helper');
		$this->load->database();
		$this->load->model('functions');
		$this->load->library('form_validation');
		$this->load->model('users/user_login');
		if ($this->session->userdata('m_logged_in') == true) {
			$this->m_logged_in = true;
		}else {
			$this->m_logged_in = false;
		}
		
		$this->load->helper('settings_functions_helper');
		$this->load->helper('path');
		$this->load->library('pagination');
		$this->load->model('settings/global_settings');
		$this->load->model('functions');
		
	}

	public function index($user_id=0)
    {
        $this->load->helper('student_functions_helper');

        $data['dwn_path'] = base_url() . "uploads/downloads/";
        $notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
        if ($notice_list->num_rows() > 0) {
            $data['list_notice'] = $notice_list->result();
        } else {
            $data['list_notice'] = 'No notice published';
        }

        $data['footer_widget_title'] = $this->functions->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functions->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functions->show_widget('description', 9);

        $data['page_title'] = 'home';
        $data['slider'] = '';

        if ($this->m_logged_in == true) {
            $data['log_url'] = 'member_form/logout_member.html';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $this->session->userdata('m_logged_in');
            $data['ID'] = $this->session->userdata('user_id');
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
            $data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
            $data['user_id'] = $user_id;
            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
            $this->load->view('front/client_area/header', $data);


            $query = $this->db->get_where('users', array('ID' => $data['ID']));
            $data['row'] = $query->row();

            $this->load->view('front/client_area/member/profile', $data);
            $this->load->view('front/client_area/footer', $data);
        } else {
            redirect("member_form/login/");
        }

    }


    public function change_password()
    {
        $this->load->helper('student_functions_helper');

        $data['dwn_path'] = base_url() . "uploads/downloads/";
        $notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
        if ($notice_list->num_rows() > 0) {
            $data['list_notice'] = $notice_list->result();
        } else {
            $data['list_notice'] = 'No notice published';
        }

        $data['footer_widget_title'] = $this->functions->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functions->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functions->show_widget('description', 9);

        $data['page_title'] = 'home';
        $data['slider'] = '';

        if ($this->m_logged_in == true) {
            $data['log_url'] = 'member_form/logout_member.html';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $this->session->userdata('m_logged_in');
            $data['ID'] = $this->session->userdata('user_id');
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $data['ID']);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $data['ID']);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $data['ID']);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $data['ID']);
            $data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $data['ID']);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $data['ID']);
            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
            $this->load->view('front/client_area/header', $data);


            $query = $this->db->get_where('users', array('ID' => $data['ID']));
            $data['row'] = $query->row();

            $this->load->view('front/client_area/member/change_password', $data);
            $this->load->view('front/client_area/footer', $data);
        } else {
            redirect("member_form/login/");
        }

    }


    public function change_password_action()
    {
        $usrID = $this->session->userdata('user_id');
        $current_pass = md5($this->input->post('current_pass'));
        $new_pass = md5($this->input->post('new_pass'));
        $running_pass = get_field_by_id_from_table('users', 'password', 'ID', $usrID);

        $this->__passChangeRules();

        if ($this->form_validation->run() == TRUE)
        {
            if ($current_pass == $running_pass) {
                // updating data password
                $passData = array(
                    'password' => $new_pass
                );
                $this->db->where('ID', $usrID);
                $this->db->update('users', $passData);

                $this->session->set_flashdata('msg', "<div class='alert alert-success' role='alert'>Success!</div>");
            }else {
                $this->session->set_flashdata('msg', "<div class='alert alert-danger' role='alert'>Sorry! you provide wrong current password.</div>");
            }
        }
        redirect("member/profile/change_password/");

    }

    public function profile_update(){
        $this->load->helper('student_functions_helper');

        $data['dwn_path'] = base_url() . "uploads/downloads/";
        $notice_list = $this->db->query("SELECT * FROM `downloads` WHERE `cat_id` IN (5) ORDER BY `dwn_id` DESC LIMIT 0, 5");
        if ($notice_list->num_rows() > 0) {
            $data['list_notice'] = $notice_list->result();
        } else {
            $data['list_notice'] = 'No notice published';
        }

        $data['footer_widget_title'] = $this->functions->show_widget('title', 8);
        $data['footer_widget_description'] = $this->functions->show_widget('description', 8);

        $data['footer_widget2_title'] = $this->functions->show_widget('title', 9);
        $data['footer_widget2_description'] = $this->functions->show_widget('description', 9);

        $data['page_title'] = 'home';
        $data['slider'] = '';

        $id = $this->session->userdata('user_id');

        if ($this->m_logged_in == true) {
            $data['log_url'] = 'member_form/logout_member.html';
            $data['log_title'] = 'Logout';
            $data['check_user'] = $this->session->userdata('m_logged_in');
            $data['ID'] = $this->session->userdata('user_id');
            $data['u_name'] = get_field_by_id_from_table('users', 'username', 'ID', $id);
            $data['f_name'] = get_field_by_id_from_table('users', 'f_name', 'ID', $id);
            $data['l_name'] = get_field_by_id_from_table('users', 'l_name', 'ID', $id);
            $data['balance'] = get_field_by_id_from_table('users', 'balance', 'ID', $id);
            $data['Point'] = get_field_by_id_from_table('users', 'Point', 'ID', $id);
            $data['role'] = get_field_by_id_from_table('user_roles', 'roleID', 'userID', $id);          
            $data['sidebar_left'] = $this->load->view('front/client_area/sidebar-left', $data, true);
            $this->load->view('front/client_area/header', $data);

            $query = $this->db->get_where('users', array('ID' => $id));
            $data['row'] = $query->row();
            $data['user'] = $query->result();



            $this->load->view('front/client_area/member/update', $data);
            $this->load->view('front/client_area/footer', $data);
        } else {
            redirect("member_form/login/");
        }
    }

    public function profile_update_action(){

            $this->rules();

            if ($this->form_validation->run() == TRUE) {

            $userId = $this->session->userdata('user_id');

            $data = array(
                        'f_name' =>$this->input->post('fname',TRUE), 
                        'l_name' =>$this->input->post('lname',TRUE), 
                        'address1' =>$this->input->post('addr',TRUE), 
                        'address2' =>$this->input->post('per_addr',TRUE), 
                        'phn_no' =>$this->input->post('phone',TRUE), 
                        'nid' =>$this->input->post('nid',TRUE), 
                        'father' =>$this->input->post('father',TRUE), 
                        'mother' =>$this->input->post('mother',TRUE) 
            );

            $this->db->where('ID', $userId);
            $this->db->update('users', $data);

            $this->session->set_flashdata("msg", "<div class='alert alert-success'>Successfully Registered. Please Login</div>");
                redirect("member/profile/profile_update/");
        }else{
                $this->session->set_flashdata("msg", validation_errors('<div class="alert alert-warning">', '</div>'));
                redirect("member/profile/profile_update/");
            }  
    }

    public function personal_update_action(){

       

            $userId = $this->session->userdata('user_id');

            $data = array(
                        'blood' =>$this->input->post('b_group',TRUE), 
                        'division' =>$this->input->post('division',TRUE), 
                        'district' =>$this->input->post('district',TRUE), 
                        'nominee' =>$this->input->post('non',TRUE), 
                        'relationship' =>$this->input->post('relation',TRUE), 
                        'nominee' =>$this->input->post('nodob',TRUE), 
                        'sex' =>$this->input->post('sex',TRUE), 
                        'bank_name' =>$this->input->post('banks',TRUE), 
                        'account_no' =>$this->input->post('account_no',TRUE),
                        'upozila' =>$this->input->post('upozila',TRUE),
                        'union' =>$this->input->post('union',TRUE),
                        'post' =>$this->input->post('post_code',TRUE),
                        'religion' =>$this->input->post('religion',TRUE)
            );
            

            $this->db->where('ID', $userId);
            $this->db->update('users', $data);
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>Successfully Updated </div>");
                redirect("member/profile/profile_update/");
        
    }

    public function account_update_action(){

        $userId = $this->session->userdata('user_id'); 

            
        $data = array(
            'username' => $this->input->post('uname', TRUE),
            'email' => $this->input->post('email', TRUE),
        );
        if ($this->input->post('pass', TRUE)) {
            $data['password'] = md5($this->input->post('pass', TRUE));
        }


            $this->db->where('ID', $userId);
            $this->db->update('users', $data);
            $this->session->set_flashdata("msg", "<div class='alert alert-success'>Successfully Updated </div>");
            redirect("member/profile/profile_update/");

            


    }

    public function photo_update_action(){

                    $userId = $this->session->userdata('user_id');
                     //Image upload into temp file
                    $photo_name = 'profile_' . time() . '.jpg';
                    $config['upload_path'] = 'uploads/temp/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $photo_name;
                    $config['max_size'] = '100';
                    $config['image_width'] = '1024';
                    $config['image_height'] = '768';
                    $config['is_image'] = 1;
                    $config['max_size'] = 0;
                    $this->session->set_userdata("config", $config);
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('photo');

                        $data = array('photo' =>$photo_name);

                    $this->db->where('ID', $userId);
                    $this->db->update('users', $data);
                    $this->session->set_flashdata("msg", "<div class='alert alert-success'>Successfully Updated </div>");
                    redirect("member/profile/profile_update/");
    }


    private function rules() {
        //$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean|encode_php_tags');
        //$this->form_validation->set_rules('phone', 'Phone', 'trim|regex_match[/^[9]{11}$/]');
        // $this->form_validation->set_rules('spon_id', 'Sponsor ID', 'required|xss_clean|encode_php_tags');
        // $this->form_validation->set_rules('p_id', 'Placement ID', 'required|xss_clean|encode_php_tags');
        // $this->form_validation->set_rules('position', 'Hand/Position', 'required|xss_clean|encode_php_tags|integer|min_length[1]|max_length[1]|is_natural_no_zero');
        // $this->form_validation->set_rules('uname', 'Username', 'required|min_length[5]|max_length[20]|is_unique[users.username]');
        // $this->form_validation->set_rules('pass', 'Password', 'required|matches[con_pass]|min_length[6]|max_length[20]');
        // $this->form_validation->set_rules('con_pass', 'Password Confirmation', 'required||min_length[6]|max_length[20]');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    }


    public function __passChangeRules(){
        $this->form_validation->set_rules('current_pass', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|min_length[5]|matches[confirm_pass]');
        $this->form_validation->set_rules('confirm_pass', 'Confirmation Password', 'trim|required');
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */