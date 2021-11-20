<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">Video Add</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;
            if ($message) {
                echo $message;
            } ?>
        </div>
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <form method="post" action="<?php echo base_url('Admin/Video/action') ?>">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Video Title</label>
                                    <input class="form-control" name="title" required>
                                    <p class="help-block">Video title</p>
                                </div>
                                <div class="form-group">
                                    <label>Video Url</label>
                                    <input class="form-control" name="vi_url" required>
                                    <p class="help-block">Video url embed code</p>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" id="">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default btn btn-primary" name="add_category">Add
                                </button>
                            </div>
                        </form>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

</div>



