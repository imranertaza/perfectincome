
<div class="footer">
<div class="container" id="area_pad">  
    <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-3">
            <div class="costomer_support">Help Center</div><!--end of costomer_support-->
            <div class="footer_menu">
                <ul>
                   <li> <a href="#"><i class="fa fa-chevron-right"></i> Privecy Policy</a></li>
                   <li><a href=""><i class="fa fa-chevron-right"></i> Term Of Use</a></li>
                   <li><a href=""><i class="fa fa-chevron-right"></i> Documentations</a></li>
               </ul>


            </div><!--end of costomer_support_ditals-->
        </div><!--end of footer_left-->
        <div class="col-md-3">
            <div class="footer_menu_write">Quick Links</div> 
            <div class="footer_menu">
               <ul>
                   <li><a href="<?php print base_url(); ?>/details/page/about-us/"><i class="fa fa-chevron-right"></i> About Us</a></li>
                   <li><a href="<?php print base_url(); ?>/gallery/"><i class="fa fa-chevron-right"></i> Event Gallery</a></li>
                   <li><a href="<?php print base_url(); ?>/details/page/contact-us/"><i class="fa fa-chevron-right"></i> Contact Us</a></li>
               </ul>
            </div>
        </div><!--end of footer_midil-->
        <div class="col-md-3">
            <div class="footer_right_icone_write">Follow Us</div><!--end of footer_right_icone_write-->
            <div class="footer_right_icone"><a href="#"><i class="fa fa-facebook-square sosal"></i></a></div><!--end of footer_right_icone-->
            <div class="footer_right_icone"><a href="#"><i class="fa fa-twitter-square sosal"></i></a></div><!--end of footer_right_icone-->
            <div class="footer_right_icone"><a href="#"><i class="fa fa-linkedin-square sosal"></i></a></div><!--end of footer_right_icone-->
            <div class="footer_right_icone"><a href="#"><i class="fa fa-google-plus-square sosal"></i></a></div><!--end of footer_right_icone-->
        </div><!--end of footer_menu_write-->
        <div class="col-md-3">
            <div class="costomer_support"><?php print $footer_widget2_title; ?></div><!--end of costomer_support-->
            <div class="costomer_support_ditals"><?php print $footer_widget2_description; ?></div><!--end of costomer_support_ditals-->
        </div><!--end of footer_left-->
        </div>
        </div>
    </div>
    
</div>
</div>

<div class="short_footer short_footerl">
	<div class="container">  
    <div class="row">
    <div class="col-md-12 short_footer_write">Copyright © 2019 Starsfairbd  | All rights reserved | </div><!--end of short_footer_write-->
    </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>/assets/front/js/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/front/slick/slick.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
        $('.customer-logos').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    });
    </script>

<script type="application/javascript">
$('.variable-width').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true
});
</script>
 
</body>
</html>
