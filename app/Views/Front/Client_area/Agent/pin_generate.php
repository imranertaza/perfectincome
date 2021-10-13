<div class="container-fluid dash_body">
    <div class="row">
        <div class="container wraper" style="padding-bottom: 20px;">
            <?php print $sidebar_left; ?>
            <div class="col-md-9">
                <div class="right_contant dashboard_right">
                    <div class="top_right_content">
                        <h1>Pin Generate</h1>
                        <div class="message">
                            <?php $message = isset($_SESSION['message']) ? $_SESSION['message'] : 0;if($message){  echo $message; } ?>
                        </div>
                        <hr/>

                        <div class="dashboard_left_area">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form method="post" action="<?php echo base_url(); ?>/agent/agent_pin/pin_generat_action">

                                                        <input class="form-control" type="hidden" name="pin" value="12"
                                                               hidden>

                                                        <div class="col-lg-4">
                                                            <input class="form-control" name="amount" required>
                                                            <p class="help-block help_text">Please put the Piece
                                                                here.</p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <button type="submit"
                                                                    class="btn btn-default btn btn-primary">Generat
                                                            </button>
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


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel-body no_padding">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover"
                                                   id="dataTables-example">
                                                <thead>
                                                <tr>
                                                    <th width="10">Serial</th>
                                                    <th width="200">Pin</th>
                                                    <th width="200">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                $i = 0;
                                                foreach ($agentInfo as $rows) {
                                                    ?>
                                                    <tr class="odd gradeX" id="download_<?php print $rows->pin_id; ?>">
                                                        <td><?php echo ++$i; ?></td>
                                                        <td><?php print $rows->pin; ?></td>
                                                        <td><?php if ($rows->status == 'unused') {
                                                                echo "<b style='color: green'>unused</b>";
                                                            } else {
                                                                echo "<b style='color: red'>used</b>";
                                                            }
                                                            ?></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>