<div class="container-fluid dash_body">
    <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">

            <?php print $sidebar_left; ?>

            <div class="col-md-9">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <h1>User Referrals</h1>
                        <hr/>

                        <div class="top_right_content">
                            <table class="table-bordered table-hover table">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Joining Date</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                foreach ($query as $ref_info) {
                                    $tab = DB()->table('users');
                                    $row = $tab->where('ID',$ref_info->u_id)->get()->getRow();
                                    $class = ($row->status == "Active") ? "btn btn-success" : "btn btn-danger";
                                    ?>
                                    <tr>
                                        <td><?php echo $row->username; ?></td>
                                        <td><?php echo $row->email; ?></td>
                                        <td><?php echo $row->phn_no; ?></td>
                                        <td><?php echo $row->time; ?></td>
                                        <td>
                                            <button type="button" class="<?php print $class; ?>"><?php echo $row->status; ?></button>
                                        </td>
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
