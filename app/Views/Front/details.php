<div class="contentl">
<div class="content single_page">
    	<?php
		$result = mysql_fetch_array(mysql_query("SELECT * FROM `products` WHERE `pro_id` = '$pro_id'"));
		$result = $this->db->query("SELECT * FROM `products` WHERE `pro_id` = '$pro_id'")->row();
		?>
        <div class="product_page">
            <div class="product_img1">
                <div class="product_img_bake">
                    <div class="product_img2"><?php print $this->functions->view_product_image($pro_id, $w='161', $h='255'); ?></div>
                 </div>
            </div>
            <div class="product_details">
                <div class="product_txt1"><?php print $result['name']; ?></div>
                <div class="product_txt2"><?php print $result['description']; ?></div>
                <div class="product_txt3 top_margin">Color: <?php print $this->pro_functions->find_color_by_id($result['pro_id']); ?></div><br />
                <div class="product_txt3">Availability: <?php print $this->pro_functions->available_stock($result['stock']); ?></div><br />
                <div class="product_txt3">Size: <span class="product_size1"><?php print $result['sizes']; ?></span></div>
                <div class="product_Prise">Price: <?php print $result['price']; ?> BDT</div>
                <br clear="all" />
        </div>
        <br clear="all" />
    </div>
    	<?php print $sidebar; ?>
		<br clear="all" />
</div>
<br clear="all" />
</div>