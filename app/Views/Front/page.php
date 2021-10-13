
<?php
$pages = DB()->table('pages');
$sql = $pages->where('slug',$page_title)->get();
$page_details = $sql->getRow();


if (empty($page_details->temp)) { ?>
	<section class="content-section">
		<div class="container-fluid " style="background-image: url('<?php print base_url(); ?>uploads/gallery/aa.jpg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
        <div class="row" style="background-color: rgba(36, 29, 29, 0.48); color: white;">
				<div class="container" id="area_pad" >
					<div class="col-md-12" style="min-height:350px; ">
						<div class="col-md-12 text-center" >
                            <h1><b><?php print $page_details->page_title; ?></b></h1>
                            <center><p class="front-border"></p></center>
                        </div>
                        <div class="col-md-12  results" id="cont-padding" >
                        	<ul>
                        		<li ><?php print $page_details->page_description; ?></li>
                        	</ul>

				        </div>
			        	
			    	</div>
			    </div>
		    </div>
		</div>
	</section>
<?php
}else {
	
                            include("template/".$page_details->temp);

				        
		
}
?>

