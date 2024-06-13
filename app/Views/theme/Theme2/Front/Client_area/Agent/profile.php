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
                            <h5 class="main-title">My Profile</h5>

                            <div class="mt-5 border-con">
                                <h6 style="font-weight: bold;">Profile</h6>
                                <table class=" table-hover table mt-2">

                                    <tbody>

                                    <tr>
                                        <td>Name</td>
                                        <td><?php echo $row->username; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $row->email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td><?php echo $row->phn_no; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address1</td>
                                        <td><?php echo $row->address1; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address2</td>
                                        <td><?php echo $row->address2; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo countryName($row->country); ?></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" style="text-align: right;">
                                            <a type="button" class="btn btn-sm btn-warning"
                                               href="<?php print base_url(); ?>/Agent/Profile/profile_update">Edit
                                                Profile</a>
                                        </td>
                                    </tr>
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


