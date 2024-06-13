<?php
$pages = DB()->table('pages');
$sql = $pages->where('slug',$page_title)->get();
$page_details = $sql->getRow();
?>
<section id="banner" class="d-flex align-items-center justify-content-center">
    <img src="<?php echo base_url(); ?>/assets/img/about-banner.png" class="img-fluid" alt="">
  </section>

  <main id="main">

    <section id="content" class="content">
      <div class="container" data-aos="fade-up">
        <h1><?php print $page_details->page_title; ?></h1>
        <?php print $page_details->page_description; ?>
      </div>
    </section>

    <section id="content" class="content">
      <div class="container" data-aos="zoom-in">

        <div class="row">
          <div class="col-lg-4">
            <img src="<?php echo base_url(); ?>/assets/img/about1.png" class="img-fluid" alt="">
            <h5 class="mt-3">Company Values</h5>
          </div>
          <div class="col-lg-4">
            <img src="<?php echo base_url(); ?>/assets/img/about2.png" class="img-fluid" alt="">
            <h5 class="mt-3">Corporate Priorities</h5>
          </div>
          <div class="col-lg-4">
            <img src="<?php echo base_url(); ?>/assets/img/about3.png" class="img-fluid" alt="">
            <h5 class="mt-3">Executive Team</h5>
          </div>
        </div>
      </div>
    </section>

    <section id="content" class="content">
      <div class="container">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      </div>
    </section>
    
  </main><!-- End #main -->
