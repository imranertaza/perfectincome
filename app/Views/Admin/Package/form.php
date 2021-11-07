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
                            <form method="post" action="<?php echo base_url(); ?>/Admin/Package/action">
                                <div class="col-lg-6">
                                    <label>Package Name </label>
                                    <input class="form-control" name="name"  required>
                                    <p class="help-block help_text" >Please put the Package Name here</p>
                                </div>

                                <div class="col-lg-6">
                                    <label>Price</label>
                                    <input class="form-control" name="price" required>
                                    <p class="help-block help_text">Please put the Price here.</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Sponsor Commission</label>
                                    <input class="form-control" name="sponsor_commission" required>
                                    <p class="help-block help_text">Please put the Sponsor Commission here.</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Matching Commission</label>
                                    <input class="form-control" name="matching_commission" required>
                                    <p class="help-block help_text">Please put the Matching Commission here.</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Point</label>
                                    <input class="form-control" name="point" required>
                                    <p class="help-block help_text">Please put the Point here.</p>
                                </div>
                                <div class="col-lg-12">
                                    <br>
                                    <button type="submit" class="btn btn-default btn btn-primary">Create</button>
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

