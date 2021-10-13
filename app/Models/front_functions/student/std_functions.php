<?php
class std_functions extends CI_model {
	
	public function show_products_by_catID($cat_id) {
		$query = $this->db->query("SELECT * FROM `students` WHERE FIND_IN_SET(".$cat_id.", `cat_id`)");
		if (mysql_num_rows($query)) {
		while($product_query = mysql_fetch_array($query)) {
			$std_id = $product_query['std_id'];
		?>        
        <div class="sell_box">
            <div class="title_box"><?php print $product_query['name']; ?></div><!--end of title_box-->
            <div class="box_img"><?php print $this->functions->view_student_image($std_id, $w='170', $h='138'); ?></div><!--end of box_img-->
            <div class="box_img"><img src="<?php echo base_url(); ?>assets/images/line.png" /></div><!--end of box_img-->
            <div class="configaration"><h3>HP laptop</h3>Sandy Bridge Core i5 2450m @ 2.5GHz <br />
                6GB DDR3 RAM
                <br />
                1GB DDR5 Graphics Card AMD Radeon HD 7470m
            </div><!--end of configaration-->
            <a href="<?php print base_url(); ?>details/iteam_details/<?php print $std_id; ?>.html" class="Ditales">Ditales</a><!--end of Ditales-->
            <a href="<?php print base_url(); ?>details/iteam_details/<?php print $std_id; ?>.html" class="take">taka <br /><?php print $product_query['price']; ?></a><!--end of taka-->
        </div>
        <?php
		}
		}else {
			print '<p class="not_found">Result Not Found</p>';	
		}
	}
	
	
	public function find_color_by_id($pro_id) {
		$color = '';
		$get_name = $this->db->query("SELECT `color_name` FROM products,pro_color WHERE `pro_id` = '$pro_id' AND FIND_IN_SET(`color_id`, `colors`)");
		while ($name = mysql_fetch_array($get_name)) {
			$color .= $name['color_name'].', ';
		}
		return substr($color, 0, -2);
	}
	
	
	
}

?>