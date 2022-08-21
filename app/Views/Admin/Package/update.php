<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Package Create</h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="<?php echo base_url(); ?>/Admin/Package/update_action">
                                <div class="col-lg-6">
                                    <label>Package Name </label>
                                    <input class="form-control" name="name" value="<?php echo $package->package_name; ?>"  required>
                                    <input type="hidden" name="package_id" value="<?php echo $package->package_id; ?>"  required>
                                    <p class="help-block help_text" >Please put the Package Name here</p>
                                </div>

                                <div class="col-lg-6">
                                    <label>Price</label>
                                    <input class="form-control" name="price" value="<?php echo $package->price; ?>" required>
                                    <p class="help-block help_text">Please put the Price here.</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Sponsor Commission</label>
                                    <input class="form-control" name="sponsor_commission" value="<?php echo $package->sponsor_commission; ?>" required>
                                    <p class="help-block help_text">Please put the Sponsor Commission here.</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Matching Commission</label>
                                    <input class="form-control" name="matching_commission" value="<?php echo $package->matching_commission; ?>" required>
                                    <p class="help-block help_text">Please put the Matching Commission here.</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Point</label>
                                    <input class="form-control" name="point" value="<?php echo $package->point; ?>" required>
                                    <p class="help-block help_text">Please put the Point here.</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Video Commission</label>
                                    <input class="form-control" name="video_watch_earning" value="<?php echo $package->video_watch_earning; ?>" required>
                                    <p class="help-block help_text">Please put the video commission here.</p>
                                </div>
                                <div class="col-lg-12">
                                    <label>Description</label>
                                    <textarea name="description" id="ckeditor" class="ckeditor"><?php echo $package->description; ?></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <button type="submit" class="btn btn-default btn btn-primary">Update</button>
                                </div>


                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

