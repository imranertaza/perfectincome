<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4">
                    <div class="footer-logo">
                        <img src="<?php echo base_url(); ?>/assets/img/logo-footer.png" class="img-fluid" alt="">
                    </div>
                    <div class="footer-info">
                        <p>Get connected with us here on social media. We always like to hear your comment.</p>
                        <div class="social-links mt-3">
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 footer-links">
                    <h4>Information</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a
                                    href="<?php print base_url(); ?>/details/page/about-us/">About Us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy Policy</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms and Conditions</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Returns</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Help</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-4 footer-contact">
                    <h4><?php print $footer_widget2_title; ?></h4>
                    <p><i class="bi bi-telephone"></i> <?php //print $footer_widget2_description; ?></p>
                    <p><i class="bi bi-envelope"></i> contact@perfectincome.online</p>
                    <p><i class="bi bi-geo-alt-fill"></i> Street: 3682 Leisure Lane<br>City: Thousand Oaks<br/>State: California</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            Copyright © 2021 PerfectIncome | All rights reserved
        </div>
    </div>
</footer><!-- End Footer -->


<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

<!-- Plugins JS Files -->
<script src="<?php echo base_url(); ?>/assets/plugins/aos/aos.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/php-email-form/validate.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/purecounter/purecounter.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/swiper/swiper-bundle.min.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url(); ?>/assets/js/main.js"></script>

<script>

    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var interval =  setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = 0;
                $('#minCount').hide();
                $("#closeBtn").css('display', 'block');
                clearInterval(interval);
            }
        }, 1000);
    }

    function viewVideo(id) {
        $('#myModal').show();
        $.ajax({
            url: "<?php echo base_url('Member/Video/view_video')?>",
            data: {id: id},
            type: "POST",
            beforeSend: function () {
                $("#debugbar_loader").show();
            },
            success: function (data) {
                $('#viewVideo').html(data);

                var countTime = 10;
                display = document.querySelector('#minCount');
                startTimer(countTime, display);

            }
        });
    }

    function closeModal(id) {
        $.ajax({
            url: "<?php echo base_url('Member/Video/view_video_count')?>",
            data: {id: id},
            type: "POST",
            beforeSend: function () {
                $("#preloader").show();
            },
            success: function (data) {
                $('#viewVideo').html('');
                $('#myModal').hide();
                $("#tabRelode").load(location.href + " #tabRelode");
                $("#balUp").load(location.href + " #balUp");
                // alert(data);
            }
        });
    }
</script>

</body>

</html>