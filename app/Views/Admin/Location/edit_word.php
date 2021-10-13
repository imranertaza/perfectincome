<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Word</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">

                        <form method="post" action="<?php echo base_url('Location/update_ward') ?>">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Ward Name</label>
                                    <input class="form-control" name="ward_name" value="<?php echo $row->name?>" required>
                                    <input type="hidden" name="lo_id" value="<?php echo $row->lo_id?>" required>
                                    <p class="help-block">Name of the ward</p>
                                </div>

                                <div class="form-group">
                                    <label>Name of the Division</label>
                                    <select class="form-control" name="division" onchange="get_district(this.value);" required>
                                        <option value="0">Select Division.</option>
                                        <?php
                                        $dis = get_id_by_data('per_id','location','lo_id',$row->per_id);
                                        $div = get_id_by_data('per_id','location','lo_id',$dis);
                                        print get_location(0,$div);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name of the District</label>
                                    <select class="form-control" name="district" id="district"
                                            onchange="get_thana(this.value);" required>
                                        <option value="0">Select District.</option>
                                        <?php
                                            echo get_district($dis, $div);
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name of the Thana/Upazila</label>
                                    <select class="form-control" name="perent" id="thana" required>
                                        <option value="0">Select Thana/Upazila.</option>
                                        <?php echo get_upozila($row->per_id, $dis); ?>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default btn btn-primary" name="add_ward">Update
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


    function get_thana(district_id) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/thana',
            type: "POST",
            dataType: "text",
            data: {district_id: district_id},
            beforeSend: function () {
                $('#thana').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (msg) {
                $('#thana').html(msg);
            }
        });
    }
</script>