<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add District</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            
                            	<form method="post" action="<?php echo base_url('Location/action_district')?>">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Add District </label>
                                            <input class="form-control" name="district_name" required>
                                            <p class="help-block">Select District.</p>
                                           
                                        </div>
                                       
                                       <div class="form-group">
                                        	<select class="form-control" name="perent" required>
                                            	<option value="0">Select Division.</option>
                                            	<?php print get_location(0); ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default btn btn-primary" name="add_district">Add</button>
                                </div>
                                </form>
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
            
        </div>