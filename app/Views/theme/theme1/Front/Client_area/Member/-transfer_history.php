<div class="container-fluid wraper">
  <div class="row">
        <div class="container" id="area_pad">

                <?php print $sidebar_left; ?>

                <div class="col-md-9">
                  <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                      <h1>Transfer History</h1>
                      <hr />
                        <?php print $this->session->flashdata('msg'); ?>



                        <div class="panel with-nav-tabs panel-default">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab1default" data-toggle="tab">Received Balance</a></li>
                                <li class=""><a href="#tab2default" data-toggle="tab">Send Balance</a></li>
                            </ul>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="tab1default">
                                        <h2>Receiving balance history</h2>
                                        <hr>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Sender(From)</th>
                                                <th>Receiver(To)</th>
                                                <th>Amount</th>
                                                <th>date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($receiving_history as $trans) { ?>
                                                <tr>
                                                    <td><?php print get_username_by_id($trans->sender_id); ?></td>
                                                    <td><?php print get_username_by_id($trans->receiver_id); ?></td>
                                                    <td><?php print $trans->amount; ?></td>
                                                    <td><?php print $trans->date; ?></td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade in" id="tab2default">
                                        <h2>Sending balance history</h2>
                                        <hr>
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Sender(From)</th>
                                                <th>Receiver(To)</th>
                                                <th>Amount</th>
                                                <th>date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($sending_history as $trans) { ?>
                                            <tr>
                                                <td><?php print get_username_by_id($trans->sender_id); ?></td>
                                                <td><?php print get_username_by_id($trans->receiver_id); ?></td>
                                                <td><?php print $trans->amount; ?></td>
                                                <td><?php print $trans->date; ?></td>
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
        </div>
    </div>
</div>

<script>
    function check_amount() {
        var amount = document.getElementById("payment_amount").value;
        if (amount >= <?php print $min_amount_load_PM; ?>) {
            $("#PM_load_method").submit();
        }else{
            $('#er_msg').html("Minimum $<?php print $min_amount_load_PM; ?> amount to load.");
        }
    }
</script>
