<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <h1>Pin Genarate</h1>
                    <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
                    if ($message) {
                        echo $message;
                    } ?>
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="pinlist shadow">
                                <h4>Pin List</h4>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Pin</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
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
                        <div class="col-lg-5">
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
                                <input type="submit" class="btn btn-submit" value="Genarate">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
