<div class="container-fluid dash_body">
    <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">
            <?php print $sidebar_left; ?>
            <div class="col-md-9">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <h1><b>User Active</b></h1>
                        <hr/>
                        <div class="dashboard_left_area">
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="border: 1px solid;padding: 20px;">
                                        <center><h4>Pin Active</h4></center>
                                        <form action="<?php echo base_url('member/dashboard/pin_active')?>" method="post" >
                                            <div class="input">
                                                <label>Pin</label>
                                                <input type="text" id="myInput" class="form-control" name="pin" placeholder="pin" onchange="pin_check(this.value)" required >
                                                <b id="pin_bar"></b>
                                            </div>
                                            <div class="input" style="padding-top: 20px;">
                                                <button type="submit" class="btn btn-primary">Active</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div style="border: 1px solid;padding: 20px;">
                                        <h4>Perfect Money Active</h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
