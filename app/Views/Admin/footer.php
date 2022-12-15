</div>
    <!-- /#wrapper -->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/js/sb-admin-2.js"></script>
    
<script>

$(document).ready(function() {
    $('#dataTables-example').DataTable();
} );


CKEDITOR.replace( 'ckeditor', { 
	filebrowserBrowseUrl: '<?php print base_url(); ?>/assets/ckeditor/plugins/w3bdeveloper_uimages/index.php',
	filebrowserWindowWidth: '860',
	filebrowserWindowHeight: '660'
});

function activeUser(u_id){
    if (confirm('Are you sure?')) {
        $("#activeBtn").attr("disabled", true);
        document.getElementById("activeBtn").onclick = null;
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Admin/Deposit/active')?>",
            data: {id: u_id},
            success: function (result) {
                $("#dataTables-example").load(location.href + " #dataTables-example");
            }
        });
    }
}
</script>

</body>

</html>
