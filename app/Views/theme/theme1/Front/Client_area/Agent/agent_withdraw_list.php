<main id="main" class="no-banner">

    <section class="my-account">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php print $sidebar_left; ?>
                </div>
                <div class="col-lg-9">
                    <div class="right_contant dashboard_right">
                        <div class="top_right_content pt-4">
                            <h5 class="main-title">Withdraw request list</h5>
                            <span id="message"></span>
                            <div class="mt-5 border-con text-capitalize">
                                <table class=" table-hover table mt-2" id="reload">
                                    <thead>
                                        <tr>
                                            <td>Id</td>
                                            <td>Date</td>
                                            <td>Amount</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($withdrawData as $row){?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row->date;?></td>
                                            <td><?php echo Tk_view($row->amount);?></td>
                                            <td><?php echo $row->status; ?></td>
                                        </tr>
                                        <?php }?>

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

