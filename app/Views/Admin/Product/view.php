
<script type="text/javascript" src="<?php print base_url(); ?>/assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	
                                <div class="col-lg-12">
                                
                                	<div class="col-lg-6">
                                        <b>Product Name</b><br />
                                        <?php print empty($row->name) ? "Not Set" : $row->name; ?><br />
                                        <b>Product Price</b><br />
                                        <?php print empty($row->price) ? "Not Set" : $row->price; ?><br />   
                                        <b>Model</b><br />
                                        <?php print empty($row->model) ? "Not Set" :$row->model; ?><br />                                    
                                        <b>Menufacture</b><br />
                                        <?php print get_menufacture_by_id($row->men_id); ?><br />
                                        <b>Catagories</b><br />
                                        <?php print get_cat_name_by_id($row->cat_id); ?><br />
                                        <b>Color</b><br /> 
                                        <?php print color_by_id($row->colors); ?><br />
                                        <b>Size</b><br />
                                        <?php print $row->size; ?>  <br />                                   
                                        <b>Point</b><br />
                                        <?php print $row->point; ?><br /> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                    	<?php print $pro_image; ?><br />
                                        <b>Quality</b><br />
                                        <?php print quality_by_id($row->quality); ?><br />
                                        
                                        <b>Quantity</b><br />
                                        <?php print empty($row->quantity) ? "Not Set" : $row->quantity; ?><br /> 
                                        
                                        <b>Discount</b><br />
                                        <?php print empty($row->discount) ? "Not Set" : $row->discount; ?><br /> 
                                        
                                        <b>Special</b><br />
                                        <?php print special_by_id($row->special); ?><br />
                                        
                                        <b>Description</b><br />
                                        <?php print empty($row->description) ? "Not Set" : $row->description; ?><br /> 
                                      
                                    </div>
                                   
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            
        </div>