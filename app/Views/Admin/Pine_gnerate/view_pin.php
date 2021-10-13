<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pin Generate List</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->            
            <div class="row">
                <div class="col-lg-12">
                        <div class="panel-body no_padding">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="100">User Name</th>
                                            <th width="200">Pin</th>
                                            <th width="200">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php  
                                        foreach ($agent as $rows)
                                        {
                                        ?>
                                        <tr class="odd gradeX" id="download_<?php print $rows->pin_id; ?>">
                                            <td><?php print get_username_by_id($rows->user_id); ?></td>
                                            <td><?php print $rows->pin; ?></td>
                                            <td><?php if ($rows->status =='unused') {
                                                    echo "<b style='color: green'>unused</b>";
                                                } else{
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
            <!-- /.row -->
            
        </div>