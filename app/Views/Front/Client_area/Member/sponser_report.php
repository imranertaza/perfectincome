<div class="container-fluid dash_body">
    <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <h1>Sponser Report</h1>
                        <hr/>

                        <div class="top_right_content">
                            <table class="table-bordered table-hover table">
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                                <?php foreach ($querya as $key => $itme) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $itme->createdDtm; ?></td>
                                        <td><?php echo $itme->amount; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
