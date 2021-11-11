<section class="slider-section">
  <div class="container-fluid slider_area">
    <div class="row">
        <img src="<?php print base_url(); ?>/uploads/gallery/banner.jpg" width="100%">
    </div>

  </div>
</section>

<section class="content-section">
  <div class="container-fluid wraper">
  		<div class="row">
          <div class="container" id="area_pad">
            <div class="col-md-12 text-center">
        	     <h1><b><?php print $title; ?></b></h1>
               <center><p class="front-border"></p></center>
            </div>
            <div class="col-md-12  results" id="cont-padding">
              <p><?php print $description; ?></p>
            </div>
            
          </div>
      </div>
  </div>
</section>

<section class="incentives-offers-section">
  <div class="container-fluid" style="background-image: url('uploads/gallery/banner.jpg'); background-attachment: fixed; background-position: center; 
  background-repeat: no-repeat; 
  background-size: cover; ">
      <div class="row" style="background-color: rgba(36, 29, 29, 0.42);">
                <div class="container" id="area_pad">  
                      <div class="col-md-12 text-center" >
                        <h1 ><b>Incentives Offers</b></h1> 
                        <center><p class="front-border" ></p></center>                       
                      </div>                      
                      <div class="col-md-12 results" style="margin-top:30px; ">                      
                        <section class="customer-logos slider">
                          <div class="slide"><img src="<?php print base_url(); ?>/assets/images/1ster.JPG"></div>
                          <div class="slide"><img src="<?php print base_url(); ?>/assets/images/2ster.JPG"></div>
                          <div class="slide"><img src="<?php print base_url(); ?>/assets/images/3ster.JPG"></div>
                          <div class="slide"><img src="<?php print base_url(); ?>/assets/images/4 star.JPG"></div>
                          <div class="slide"><img src="<?php print base_url(); ?>/assets/images/5 star.JPG"></div>
                          <div class="slide"><img src="<?php print base_url(); ?>/assets/images/6 star.JPG"></div>
                          <div class="slide"><img src="<?php print base_url(); ?>/assets/images/7 star.JPG"></div>
                       </section>
                      </div>
                </div>
      </div>
  </div>
</section>

<section class="notice-section">
  <div class="container-fluid wraper" >
      <div class="row" >
            <div class="container" id="area_pad" style="" >  
                  <div class="col-md-12">
                      <div class="col-md-12 text-center" >
                        <h1><b>Products</b></h1>
                        <center><p class="front-border"></p></center>       
                      </div>                         
                      <div class="col-md-12  results " id="cont-padding" >
                          <div class="col-md-4">
                            <img style="border:1px solid; " src="<?php print base_url(); ?>/uploads/gallery/product.jpg" width="100%" class="img-rounded">

                          </div>
                          <div class="col-md-8">
                            <p class="font-size" ><b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                            <a type="button" class="btn btn-info btn-lg" >Price: <?php echo Tk_view(660);?></a>
                          </div>
                      </div>
                    </div>
            </div>
      </div>
  </div>
</section>

<section class="About-section">
  <div class="container-fluid " style="background-image: url('uploads/gallery/bb (2).jpg'); background-attachment: fixed; background-position: center; 
  background-repeat: no-repeat; 
  background-size: cover; " >
      <div class="row" style="background-color: rgba(36, 29, 29, 0.48);">
            <div class="container" id="area_pad" >  
                  <div class="col-md-12">
                      <div class="col-md-12 text-center" >
                        <h1><b>About Us</b></h1>
                        <center><p class="front-border"></p></center>
                                                    
                      </div>                         
                      <div class="col-md-12  results" id="cont-padding">
                          <div class="col-md-8">
                            <p class="font-size" style="color: white;"><b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                          </div>
                          <div class="col-md-4">
                            <img src="<?php print base_url(); ?>/uploads/gallery/bb (1).jpg" width="100%" class="img-rounded">
                          </div>
                    </div>
                        
                </div>
            </div>
      </div>
  </div>
</section>

<section class="notice-section">
  <div class="container-fluid wraper" >
      <div class="row" >
            <div class="container" id="area_pad" style="" >  
                  <div class="col-md-12">
                      <div class="col-md-12 text-center" >
                        <h1><b>Notice</b></h1>
                        <center><p class="front-border"></p></center>       
                      </div>                         
                      <div class="col-md-12  results text-center" id="cont-padding" >
                          <ul class="notice">                      
                            <?php foreach($list_notice as $row) { ?>
                              <li ><p><a style="font-size: 16px;" href=""><?php print $row->title; ?></a></p></li>
                            <?php }?>                          
                          </ul>
                      </div>
                    </div>
            </div>
      </div>
  </div>
</section>


