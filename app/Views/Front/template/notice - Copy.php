<main id="main" style="margin-top: 100px;">
    <section id="content" class="content">
      <div class="container" data-aos="fade-up">
        <h1><?php print $page_details->page_title; ?></h1>
        <div class="col-md-12  results" id="cont-padding">
            <ul>
                <?php
                if (is_array($records)) {
                    foreach ($records as $row) {
                        ?>
                        <li><i class="fa fa-angle-right"></i> <a href="<?php print $dwn_path . $row->file; ?>"><?php print $row->title; ?></a>
                        </li>
                    <?php }
                } else {
                    print $records;
                } ?>
            </ul>
        </div>
      </div>
    </section>
</main>