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
                            <h5 class="main-title">User Referrals</h5>

                            <div class="top_right_content mt-5 border-con">
                                <h6 style="font-weight: bold;">All Referrals</h6>
                                <table class=" table-hover table">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Joining Date</th>
                                    </tr>
                                    <?php foreach ($query as $ref_info) {
                                        $tab = DB()->table('users');
                                        $row = $tab->where('ID',$ref_info->u_id)->get()->getRow();
                                        $class = ($row->status == "Active") ? "btn btn-success" : "btn btn-danger";
                                        ?>
                                        <tr>
                                            <td><?php echo $row->username; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><?php echo $row->phn_no; ?></td>
                                            <td><?php echo $row->time; ?></td>
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
    </section>

</main><!-- End #main -->


