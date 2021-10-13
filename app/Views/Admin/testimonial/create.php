<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Create Testimonial</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <ul class="nav nav-tabs">
              <li><a href="<?php echo base_url(); ?>testimonial/testimonial_list.html">List</a></li>
              <li class="active"><a href="<?php echo base_url(); ?>testimonial/create.html">Create</a></li>
            </ul>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            	<?php print $report = $this->testimonial_model->create();
								if ($report) {
								?>
                                <meta http-equiv="refresh" content="2;URL=<?php print base_url(); ?>testimonial/create.html" />
                                </div>
                                <div class="col-lg-12">
                                <?php } ?>
                            	<form method="post" action="preview.html">
                                        <div class="form-group col-lg-6">
                                            <label>Student Name</label>
                                            <input class="form-control" name="std_name">
                                            <p class="help-block">Please put the name of student</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Name of Examination</label>
                                            <input class="form-control" name="examination">
                                            <p class="help-block">Please put the name of the exam.</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Son Of</label>
                                            <input class="form-control" name="fname">
                                            <p class="help-block">Please put the father name</p>                                            
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Board Registration No</label>
                                            <input class="form-control" name="reg_number">
                                            <p class="help-block">Please put the board registration no</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Mother</label>
                                            <input class="form-control" name="mname">
                                            <p class="help-block">Please put the motner name</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Seassion</label>
                                            <input class="form-control" name="seassion">
                                            <p class="help-block">Please put seassion</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Village</label>
                                            <input class="form-control" name="village">
                                            <p class="help-block">Please put the village</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Roll No</label>
                                            <input class="form-control" name="roll">
                                            <p class="help-block">Please put roll number</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Post Office</label>
                                            <input class="form-control" name="post">
                                            <p class="help-block">Please put the post office</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Exam. Center</label>
                                            <input class="form-control" name="center">
                                            <p class="help-block">Please put exam center</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Upazilla</label>
                                            <input class="form-control" name="upazilla">
                                            <p class="help-block">Please put the post office</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Group</label>
                                            <input class="form-control" name="group">
                                            <p class="help-block">Please put his/her group</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>District</label>
                                            <input class="form-control" name="district">
                                            <p class="help-block">Please put the district</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>G.P.A</label>
                                            <input class="form-control" name="gpa">
                                            <p class="help-block">Please put his/her G.P.A</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>date of birth</label>
                                            <input class="form-control" name="dob" id="datepicker">
                                            <p class="help-block">format day-month-year(01-02-1999)</p>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label>Date of Result Publish</label>
                                            <input class="form-control" name="publish_result" id="datepicker2">
                                            <p class="help-block">format day-month-year(01-02-1999)</p>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <button type="submit" name="create_tc" class="btn btn-default btn btn-primary">Create</button>
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