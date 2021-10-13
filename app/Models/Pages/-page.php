<?php
class page extends CI_model {

	public function __construct() {
		$this->load->database();
	}
	
	public function page_list() {
		$sql =  $this->db->query("SELECT * FROM `pages` WHERE `page_type` = 'page'");
		//while($rows =  $sql)) {
		foreach ($sql->result() as $rows)
		{
			$page_id = $rows->page_id;
		?>
        <tr class="odd gradeX" id="page_<?php print $page_id; ?>">
            <td><?php print $rows->page_id; ?></td>
            <td><?php print $rows->page_title; ?></td>
            <td><?php print $rows->short_des; ?></td>
            <td class="center">
            <?php if ($this->functions->hasPermission('edit_page') == true) { ?>
            <a href="<?php print base_url(); ?>pages/edit_page/<?php print $page_id; ?>.html" class="btn btn-primary take_margin" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <?php } ?>
            <?php if ($this->functions->hasPermission('delete_page') == true) { ?>
            <a onclick="delete_page(<?php print $page_id; ?>);" class="btn btn-danger take_margin" title="Delete"><i class="fa fa-trash-o"></i></a>
            <?php } ?>
            </td>
        </tr>
        <?php
		}
	}
	
	
	public function edit_page($page_id) {
		if (isset($_POST['edit_page'])) {
			$msg = '';
			$temp = $_POST['page_template'];
			$title = $_POST['page_tilte'];
			//$get_slug = $this->functions->seoUrl($title);
			//$slug = $this->functions->check_slug($get_slug);
			$description = $_POST['description'];
			$short_description = $_POST['short_description'];
			
			$update_page = $this->db->query("UPDATE `pages` SET 
											`temp` 					= '$temp',
											`page_title` 			= '$title',
											`short_des` 			= '$short_description',
											`page_description` 		= '$description' 
											WHERE `pages`.`page_id` = '$page_id'");
			if ($update_page) {
				$msg .= '<p class="success">Page successfully updated.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function add_new_page() {
		if (isset($_POST['add_page'])) {
			$msg = '';
			$temp = $_POST['page_template'];
			$title = $_POST['page_tilte'];
			$get_slug = $this->functions->seoUrl($title);
			$slug = $this->functions->check_slug($get_slug);
			$description = strip_tags(htmlentities($_POST['description']));
			$short_description = strip_tags(htmlentities($_POST['short_description']));

            $data = array(
                'temp' => $temp,
                'page_title' => $title,
                'slug' => $slug,
                'short_des' => $short_description,
                'page_description' => $description,
                'page_type' => 'page'
            );
            $update_page = $this->db->insert("pages", $data);
//			$update_page = $this->db->query("INSERT INTO `pages` SET
//											`temp` 				= '$temp',
//											`page_title` 		= '$title',
//											`slug`		 		= '$slug',
//											`short_des` 		= '$short_description',
//											`page_description` 	= '$description',
//											`page_type` 		= 'page'");
			if ($update_page) {
				$msg .= '<p class="success">Page successfully added.</p>';
			}else {
				$msg .= '<p class="error">Sorry! something wrong in it.</p>';
			}
			return $msg;
		}
	}
	
	
	public function find_template($page_id=0) {
		$sel_temp = $this->db->query("SELECT `temp` FROM `pages` WHERE `page_id` = '$page_id'")->row();
		$template = '';
		$dir = 'application/views/front/template/';
		$files = scandir($dir);
		foreach($files as $key=>$file) {
			if (($file != '.') && ($file != '..')) {
				if ($sel_temp->temp == $file) { $selected = 'selected="selected"'; }else { $selected = ''; }
				$template .= '<option '.$selected.'>'.$file.'</option>';
			}
		}
		print $template;
	}
	
	
	
}
?>