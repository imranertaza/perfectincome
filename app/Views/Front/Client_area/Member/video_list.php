<main id="main" class="no-banner">
    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content pt-5">
                            <h5 class="main-title">Videos</h5>
                            <p id="errorMes">Videos</p>
                            <div class="top_right_content mt-5 border-con">
                                <h6 style="font-weight: bold;">All Video</h6>
                                <table class="table-hover table pt-2" id="tabRelode">
                                    <tbody>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                        foreach ($query as $key => $itme) {
                                        $shown = already_shown($itme->video_id);
                                        if (empty($shown)){
                                    ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $itme->title; ?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary" title="View"
                                                   style="padding: 0px 10px;font-size: 18px;"
                                                   onclick="viewVideo(<?php echo $itme->video_id ?>)"><i
                                                            class="bi bi-eye-fill"></i></a>
                                            </td>
                                        </tr>
                                    <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<div class="modal" id="myModal" style="background-color: #424242fc;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div id="viewVideo"></div>


        </div>
    </div>
</div>


