<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Thana</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">

                        <form method="post" action="<?php echo base_url('Location/update_thana') ?>">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Add Thana </label>
                                    <input class="form-control" name="thana" value="<?php echo $row->name;?>" required>
                                    <input type="hidden" name="lo_id" value="<?php echo $row->lo_id;?>" required>
                                </div>
                                <div class="form-group">
                                    <p class="help-block">Name of the Division</p>
                                    <select class="form-control" name="division" onchange="get_district(this.value);"
                                            required>
                                        <?php
                                        $divId = get_id_by_data('per_id','location','lo_id',$row->per_id);
                                        print get_division($divId); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p class="help-block">Name of the District</p>
                                    <select class="form-control" name="perent" id="district"
                                            onchange="get_thana(this.value);" required>
                                        <?php print get_district($row->per_id,$divId); ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default btn btn-primary" name="add_thana">Update
                                </button>
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

<script>
    function get_district(division_id) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/district',
            type: "POST",
            dataType: "text",
            data: {division_id: division_id},
            beforeSend: function () {
                $('#district').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (msg) {
                $('#district').html(msg);
            }
        });
    }
</script>