<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Agent Add</h1>
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
                    <form method="post" action="<?php echo base_url('Admin/Agent/action')?>">
                        <div class="col-lg-6">

                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="f_name" required>
                                <p class="help-block">Full Name</p>
                            </div>

                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="username" required>
                                <p class="help-block">User Name</p>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required>
                                <p class="help-block">Email</p>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                                <p class="help-block">Password</p>
                            </div>

                            <button type="submit" class="btn btn-default btn btn-primary" name="add_category">Add</button>
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




