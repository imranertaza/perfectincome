<div class="container-fluid dash_body">
    <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <h1>Pin Generate</h1>
                        <hr/>
                        <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
                        if ($message) {
                            echo $message;
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <div class="top_right_content">
                            <h4>Pin List</h4>
                            <hr/>
                            <table class="table-bordered table-hover table">
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Package</th>
                                    <th>Pin</th>
                                    <th>Status</th>
                                </tr>
                                <?php foreach ($query as $key => $item) { ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php echo $item->package_id; ?></td>
                                        <td><?php echo $item->pin; ?></td>
                                        <td><?php echo $item->status; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="top_right_content">
                    <div class="top_right_content">
                        <h4>Pin Generate</h4>
                        <hr/>
                        <form action="<?php echo base_url('Member/General/pin_generat_action') ?>" method="post">
                            <div class="form-group">
                                <label>Package <sup class="required"></sup></label>
                                <select class="form-control" name="package_id" required>
                                    <option value="">Please Select</option>
                                    <?php foreach ($package as $item) { ?>
                                        <option value="<?php echo $item->package_id; ?>"><?php echo $item->package_name; ?>
                                            (<?php echo $item->price; ?>)
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Piece <sup class="required"></sup></label>
                                <input class="form-control" name="amount" type="text" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn btn-primary">Generat</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
