<section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container" data-aos="fade-up">

        <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-xl-4 col-lg-4">
                <h1><?php print \App\Models\Settings\Global_settings::get_each_setting_value("site_title")?></h1>
                <p>Perfect Income Life helps you generate more income efficiently and easily.</p>
                <p><a class="btn btn-primary" href="#">Contact Us <i class="bi bi-arrow-right-short"></i></a></p>
            </div>
        </div>

    </div>
</section>

<main id="main">

    <section id="welcome" class="welcome">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                    <img src="<?php print base_url(); ?>/assets/img/logo-big.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0content" data-aos="fade-right" data-aos-delay="100">
                    <h5 class="title">Our Info</h5>
                    <h1><?php print $title; ?></h1>
                    <?php print $description; ?>
                </div>
            </div>

        </div>
    </section>

    <section id="offers" class="offers">
        <div class="container" data-aos="zoom-in">
            <div class="text-center">
                <h2 class="title">Incentives Offers</h2>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <img src="assets/img/offer3.png" class="img-fluid" alt="">
                    <p class="text-center">15,000 Matching = <?php echo Tk_view('50,000')?></p>
                    <h3 class="text-center">Standard</h3>
                </div>
                <div class="col-lg-3">
                    <img src="assets/img/offer1.png" class="img-fluid" alt="">
                    <p class="text-center">30,000 Matching = <?php echo Tk_view('2,00,000')?></p>
                    <h3 class="text-center">Bronze</h3>
                </div>
                <div class="col-lg-3">
                    <img src="assets/img/offer2.png" class="img-fluid" alt="">
                    <p class="text-center">50,000 Matching = <?php echo Tk_view('5,00,000')?></p>
                    <h3 class="text-center">Golden</h3>
                </div>
                <div class="col-lg-3">
                    <img src="assets/img/offer4.png" class="img-fluid" alt="">
                    <p class="text-center">100,000 Matching = <?php echo Tk_view('10,00,000')?></p>
                    <h3 class="text-center">Premium</h3>
                </div>
            </div>
        </div>
    </section>

    <section id="packages" class="packages">
        <div class="container" data-aos="fade-up">
            <div class="text-center">
                <h2 class="title">Package</h2>
            </div>
            <div class="row">
                <?php foreach ($package as $item) { ?>
                    <div class="col-lg-4">
                        <table class="table-responsive" width="100%">
                            <tr>
                                <th colspan="2"><?php echo $item->package_name;?></th>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>$<?php echo $item->price;?></td>
                            </tr>
                            <tr>
                                <td>Sponsor Commission</td>
                                <td>$<?php echo $item->sponsor_commission;?></td>
                            </tr>
                            <tr>
                                <td>Point</td>
                                <td><?php echo $item->point;?></td>
                            </tr>
                            <tr>
                                <td>Matching Commission</td>
                                <td>$<?php echo $item->matching_commission;?></td>
                            </tr>


                        </table>
                    </div>
                <?php } ?>


            </div>

        </div>
    </section>

    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <h2>About Us</h2>
                    <p>Perfect Income has started this business with new business module that helps generating more money.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="notice" class="notice">
        <div class="container" data-aos="fade-up">
            <h2 class="text-center">Notice</h2>
            <div class="row">
                <div class="col-lg-5">
                    <img src="assets/img/notice.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-1 text-center">
                    <i class="bi bi-arrow-up-circle-fill"></i>
                </div>
                <div class="col-lg-6">
                    <ul>
                        <?php foreach($list_notice as $row) { ?>
                            <li ><?php print $row->title; ?></li>
                        <?php }?>
                    </ul>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->