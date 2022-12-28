<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User update</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
        </div>
        <div class="col-lg-12">
            <div class="panel-body">
                <div class="row">
                    <form method="post" action="<?php echo base_url('Admin/Users/update_action')?>">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="f_name" value="<?php echo $agent->f_name;?>" required>
                                <p class="help-block">First Name</p>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" name="l_name" value="<?php echo $agent->l_name;?>" required>
                                <p class="help-block">Last Name</p>
                            </div>

                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $agent->username;?>" required>
                                <p class="help-block">User Name</p>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $agent->email;?>" required>
                                <p class="help-block">Email</p>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" >
                                <p class="help-block">Password</p>
                            </div>


                            <button type="submit" class="btn btn-default btn btn-primary" name="add_category">update</button>
                        </div>

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" class="form-control" name="phn_no" value="<?php echo $agent->phn_no;?>" >
                                <p class="help-block">Phone</p>
                            </div>
                            <div class="form-group">
                                <label>Present Addres</label>
                                <input type="text" class="form-control" name="address1" value="<?php echo $agent->address1;?>" >
                                <p class="help-block">Present Addres</p>
                            </div>

                            <div class="form-group">
                                <label>Permanent Addres</label>
                                <input type="text" class="form-control" name="address2" value="<?php echo $agent->address2;?>" >
                                <input type="hidden" class="form-control" name="ID" value="<?php echo $agent->ID;?>" >
                                <p class="help-block">Permanent Addres</p>
                            </div>

                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control" name="country">
                                    <option value="">Please select</option>
                                    <?php foreach (country() as $key => $val) {
                                        $sel = ($key == $agent->country) ? 'selected' : ''; ?>
                                        <option value="<?php echo $key; ?>" <?php echo $sel; ?> ><?php echo $val; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label>status</label>-->
<!--                                <select class="form-control" name="status">-->
<!--                                    <option value="">Please select</option>-->
<!--                                    <option value="Active" --><?php //echo ($agent->status == 'Active')?'selected':''; ?><!-- >Active</option>-->
<!--                                    <option value="Inactive" --><?php //echo ($agent->status == 'Inactive')?'selected':''; ?><!-- >Inactive</option>-->
<!--                                </select>-->
<!--                            </div>-->



                        </div>
                    </form>
                    <!-- /.col-lg-6 (nested) -->
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>




