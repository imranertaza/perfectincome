<?php
/*$selete_page = $this->db->get_where('products', array('pro_id' => $pro_id));
$row = $selete_page->row_array();*/
?>
<script type="text/javascript" src="<?php print base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View The Stockist</h1>
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
                                        <table class="table-bordered table-hover table">
         <table class="table-bordered table-hover table">
        <tbody>
            <tr>
                <th width="181">Username</th>
                <th width="10">:</th>
                <td width="181"><?php   print $row['username']; ?></td>
                <th width="181"><?php print $pro_image; ?> </th>
            </tr>            
            <tr>                               
                <th width="181">Email</th>
                <th width="10">:</th>
                <td width="181"><?php   print $row['email']; ?></td>
            </tr>          
            <tr>
                <th width="181">First name</th>
                <th width="10">:</th>
                <td width="181"><?php   print $row['f_name']; ?></td>
            </tr>
            <tr>            
                <th width="181">Last name</th>
                <th width="10">:</th>
                <td width="181"><?php   print $row['l_name']; ?></td>
            </tr>
            <tr>
                <th width="181">Father</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['father']; ?></td>
            </tr>
            <tr>
                <th width="181">Mother</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['mother']; ?></td>
            </tr>
            <tr>
                <th width="181">Address1</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['address1']; ?></td>
            </tr>
            <tr>
                <th width="181">Address2</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['address2']; ?></td>
            </tr>
            <tr>
                <th width="181">Mobile</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['phn_no']; ?></td>
            </tr>
            <tr>
                <th width="181">National id</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['nid']; ?></td>
            </tr>
            <tr>
                <th width="181">Religion</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['religion']; ?></td>
            </tr>
            <tr>
                <th width="181">Blood</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['blood']; ?></td>
            </tr>
            <tr>
                <th width="181">Sex</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['sex']; ?></td>
            </tr>
            <tr>
                <th width="181">Division</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['division']; ?></td>
            </tr>            
            <tr>
                <th width="181">District</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['district']; ?></td>
            </tr>
            <tr>
                <th width="181">Upozila</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['upozila']; ?></td>
            </tr>
            <tr>
                <th width="181">Union</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['union']; ?></td>
            </tr>
            <tr>
                <th width="181">Post</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['post']; ?></td>
            </tr>
            <tr>
                <th width="181">Nominee</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['nominee']; ?></td>
            </tr>
            <tr>
                <th width="181">Nominee relationship id</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['relationship']; ?></td>
            </tr>
            <tr>
                <th width="181">nom_dob</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['nom_dob']; ?></td>
            </tr>
            <tr>
                <th width="181">Bank Name</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['bank_name']; ?></td>
            </tr>
            <tr>
                <th width="181">Account_no</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['account_no']; ?></td>
            </tr>
            <tr>
                <th width="181">Balance</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['balance']; ?></td>
            </tr>
            <tr>
                <th width="181">Commission</th>
                <th width="10">:</th>
                <td width="181"> <?php print $row['commission']; ?></td>
            </tr>
           
           
            <tr>
                <th width="181">Point</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['Point']; ?></td>
            </tr>
            <tr>
                <th width="181">pr_point</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['pr_point']; ?></td>
            </tr>
            <tr>
                <th width="181">Type</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['type']; ?></td>
            </tr>
            <tr>
                <th width="181">Status</th>
                <th width="10">:</th>
                <td width="181"><?php print $row['status']; ?></td>
            </tr>
             
                                        
              
            
            </tbody>
            </table>        
                                       
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