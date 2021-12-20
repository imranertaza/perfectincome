<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-md-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content pt-5">
                            <h5 class="main-title">Member Withdraw Report</h5>
                            <hr />
                                  <table class=" table-hover table">
                                    <tbody>
                                      <tr class="strong">
                                        <td>Payee Account Name</td>
                                        <td>Amount</td>
                                        <td>Batch Number</td>
                                        <td>Date</td>
                                      </tr>
                                      <?php foreach($with_match as $row) { ?>
                                      <tr>
                                        <td><?php echo $row->Payee_Account_Name;?></td>
                                        <td><?php echo $row->amount;?></td>
                                        <td><?php echo $row->batch_number;?></td>
                                        <td><?php echo $row->createdDtm;?></td>
                                      </tr>
                                      <?php } ?>
                                    </tbody>
                                  </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->




