<?php
class product_function extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function edit_product($pro_id) {
		if (isset($_POST['edit_pro'])) {
			
			// Compair with Old image and new image, Also deleteing old image from directory
			$old_image = $this->db->query("SELECT `main_image` FROM `products` WHERE `pro_id` = '$pro_id'")->row();
			$old_f_image = $old_image->main_image;
			
			$error = '';
			if (empty($_FILES["main_img"]["name"])) { $image_name = $old_f_image; }
			else { 
			$get_ext = pathinfo($_FILES["main_img"]["name"]);
			$ext = '.'.$get_ext['extension'];
			
				if ($ext == '.jpg' || $ext == '.JPG' || $ext == '.JPEG' || $ext == '.jpeg' || $ext == '.PNG' || $ext == '.png') {
				$image_name = 'f_pro_'.time().$ext;
				}else{
					$error .= '<p class="error">Image format does not support.</p>';
				}
			}
			
			
			if ((!empty($_FILES["main_img"]["name"])) and (!empty($old_f_image))) {
				if (file_exists('uploads/pro_image/'.$old_f_image)) {
					unlink('uploads/pro_image/'.$old_f_image);
				}
			}
			
			$msg = '';
			
			$name = isset($_POST['name']) ? $_POST['name'] : 0;
			$model = isset($_POST['model']) ? $_POST['model'] : 0;
			$men_id = isset($_POST['men_id']) ? $_POST['men_id'] : 0;			
			$pro_cat_id = isset($_POST['pro_cat_id']) ? $_POST['pro_cat_id'] : 0;
			$filter = isset($_POST['filter_id']) ? $_POST['filter_id'] : 0;			
			$color = isset($_POST['color']) ? $_POST['color'] : 0;
			$size = isset($_POST['size']) ? $_POST['size'] : 0;
			$point = isset($_POST['Point']) ? $_POST['Point'] : 0;
			$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
			$quality = isset($_POST['quality']) ? $_POST['quality'] : 0;			
			$discount = isset($_POST['discount']) ? $_POST['discount'] : 0;			
			$special = isset($_POST['special']) ? $_POST['special'] : 0;
			
			$price = isset($_POST['price']) ? $_POST['price'] : 0;
			$description = isset($_POST['description']) ? $_POST['description'] : 0;
			
			
		
											
																		
			if (empty($error)) {
			$update_pro = $this->db->query("UPDATE `products` SET 
											`name` = '$name', 
											`model` = '$model',
											`men_id` = '$men_id',
											`cat_id` = '$pro_cat_id', 
											`filter_id` = '$filter', 
											`colors` = '$color', 
											`size` = '$size',
											`Point` = '$point',
											`quantity` = '$quantity',
											`quality` = '$quality',
											`discount` = '$discount',
											`special` = '$special',
											`main_image` = '$image_name',
											`price` = '$price',
											`description` = '$description'
											 
											 WHERE `pro_id` = '$pro_id'");
			
			
			
			if ($update_pro) {
				//$target_path = 'uploads/tec_image/'.$image_name;
				//move_uploaded_file($_FILES["main_img"]["tmp_name"], $target_path);
				
				
				$config['upload_path'] = 'uploads/pro_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				//$this->upload->initialize($config);
				$this->upload->do_upload('main_img');
				//$data['upload_data'] = $this->upload->data();
				
				
				
				$msg .= '<p class="success">Updated Successfully.</p>';
			}
			}else {
				$msg .= '<p class="error">'.$error.'</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_product() {
		if (isset($_POST['add_pro'])) {
			$msg = '';
			
			$error = '';
			if (empty($_FILES["main_img"]["name"])) { $image_name = ''; }
			else { 
			$get_ext = pathinfo($_FILES["main_img"]["name"]);
			$ext = '.'.$get_ext['extension'];
			
				if ($ext == '.jpg' || $ext == '.JPG' || $ext == '.JPEG' || $ext == '.jpeg' || $ext == '.PNG' || $ext == '.png') {
				$image_name = 'f_pro_'.time().$ext;
				}else{
					$error .= '<p class="error">Image format does not support.</p>';
				}
			}
			
			$name = $_POST['name'];
			$model = $_POST['model'];
			$pro_cat_id = $_POST['pro_cat_id'];
			$men_id = $_POST['men_id'];			
			$filter = $_POST['filter'];			
			$color = $_POST['color'];			
			$size = $_POST['size'];			
			/*$main_img = $_POST['main_img'];*/
			$point = $_POST['Point'];
			$quantity = $_POST['quantity'];		
			$quality = $_POST['quality'];			
			$discount = $_POST['discount'];			
			$special = $_POST['special'];			
			$description = $_POST['description'];
			$price = $_POST['price'];
			
			
			
			if (empty($error)) {
			$add_pro = $this->db->query("INSERT INTO `products` SET 
											`name` = '$name', 
											`model` = '$model',
											`men_id` = '$men_id',
											`cat_id` = '$pro_cat_id', 
											`filter_id` = '$filter', 
											`colors` = '$color', 
											`size` = '$size',
											`main_image` = '$image_name',
											`Point` = '$point',
											`quantity` = '$quantity',
											`quality` = '$quality',
											`discount` = '$discount',
											`special` = '$special',
											`price` = '$price',
											`description` = '$description'
											");
			}
			if ($add_pro) {
				//$target_path = 'uploads/tec_image/'.$image_name;
				//move_uploaded_file($_FILES["main_img"]["tmp_name"], $target_path);
				
				$config['upload_path'] = 'uploads/pro_image/';
				$config['allowed_types'] = "jpg|JPG|jpeg|JPEG|png|PNG";
				$config['file_name'] = $image_name;
				$config['max_size']	= 0;
		
				$this->load->library('upload', $config);
				//$this->upload->initialize($config);
				$this->upload->do_upload('main_img');
				
				$msg .= '<p class="success">Successfully added.</p>';
			}else {
				$msg .= '<p class="error">'.$error.'</p>';
			}
			return $msg;
		}
	}
	
	
	
	public function view_product_image($pro_id, $w, $h) {
		$pro_image = $this->db->query("SELECT `main_image` FROM `products` WHERE `pro_id` = '$pro_id'")->row();
		if (!empty($pro_image->main_image)) {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/pro_image/'.$pro_image->main_image.'&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}else {
			return '<div class="pre_image"><img src="'.base_url().'assets/timthumb.php?src='.base_url().'uploads/pro_image/no_thumb.jpg&amp;w='.$w.'&amp;h='.$h.'&amp;zc=1" /></div>';
		}
	}
	
	
	
	
	
}
?>