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
                            <h5 class="main-title">Matching Report</h5>
                            <div class="mt-5 border-con">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">Accept
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile" type="button" role="tab"
                                                aria-controls="profile" aria-selected="false">Waiting
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active pt-4" id="home" role="tabpanel"
                                         aria-labelledby="home-tab">
                                        <h6 style="font-weight: bold;">All Accepted Matching Commissions</h6>
                                        <hr/>
                                        Total Accepted Matching: <?php echo $com_taken_matching; ?><br/>
                                        Total Matching
                                        Commission: <?php //echo $total_matching_amount[0]["SUM(amount)"]; ?>
                                        <table class=" table-hover table">
                                            <tbody>
                                            <tr>

                                                <th>Matching Date / Time</th>
                                                <th>Status</th>
                                            </tr>

                                            <?php
                                            foreach ($querya as $row) {
                                                ?>
                                                <tr>

                                                    <td><?php echo $row->date; ?></td>
                                                    <td>Accept</td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade pt-4" id="profile" role="tabpanel"
                                         aria-labelledby="profile-tab">
                                        <h6 style="font-weight: bold;">All Waiting Matching Commissions</h6>
                                        <hr/>
                                        <p>This page is under development</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->



    
