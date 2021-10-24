<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">User Load Balance</h1>
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
            <form  action="<?php print base_url(); ?>/Admin_ut/balance_history/action" method="POST">
                <div class="panel-body no_padding">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th width="150">Username</th>
                            <th width="100">Balance</th>
                            <th width="100">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <th width="150">

                                <input type="text" class="form-control" name="username" id="username" onchange="check_user(this.value)" required>
                                <p class="help-block help_text" id="spon_bar">Please put the user Name here</p>
                            </th>
                            <th width="100"><input type="text" class="form-control" name="balance" id="balance" required></th>
                            <th width="100">
                                <button type="submit" name="add_download" class="btn btn-default btn btn-primary">Load
                                    Balance
                                </button>
                            </th>
                        </tr>

                        </tbody>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel-body no_padding">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th width="150">Username</th>
                            <th width="100">Balance</th>
                            <th width="100">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($records as $rows) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php print $rows->username ?></td>
                                <td><?php print $rows->balance; ?></td>
                                <td><?php print $rows->status; ?></td>
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


<script type="text/javascript">
    function check_user(uname) {
        $.ajax({
            url: '<?php print base_url(); ?>/Ajax/check_user',
            type: "POST",
            dataType: "text",
            data: {username: uname},
            beforeSend: function () {
                $('#spon_bar').css('color', '#238A09');
                $('#spon_bar').html('<img src="<?php print base_url(); ?>/assets/images/loading.gif" width="20" alt="loading"/> Progressing...');
            },
            success: function (message) {
                if (message == 0) {
                    $('#spon_bar').html('<span style="color:red">Invalid Username</span>');
                    document.getElementById('username').value = ''
                } else {
                    $('#spon_bar').html('<span style="color:green">Valid Username</span>');
                }
            }
        });
    }

</script>
        

