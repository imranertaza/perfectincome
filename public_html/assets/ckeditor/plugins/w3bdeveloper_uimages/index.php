<?php
/*
 * This code was created by Halmagean Daniel ( halmageandaniel@yahoo.com )
 * This is ment to be free to be used by anyone, you can develop it further, you can sell it..etc.
 * If you will do, please add our link somewhere on your website in order to suport us by growing in google.
 * w3bdeveloper.com 
 * If you need this more customizable, feel free to contact me. :)
 * 
 *      Instructions
 * 
 * Please follow this url: http://www.w3bdeveloper.com/how-to/ckeditor-upload-images-plugin-free-download/
 */
?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="uploader/jquery.uploadify.js" ></script>
<link rel="stylesheet" type="text/css" href="uploader/uploadify.css">
<link rel="stylesheet" type="text/css" href="w3bdeveloper_style.css">
<?php
#include config file
require_once 'config.php';
#get all images in order to be displayed
$mediaItems = $db->query("SELECT * FROM w3bdeveloper_media");
$mediaItems = $mediaItems->fetchAll(PDO::FETCH_ASSOC);	
?>
<script>
	//making the tabs to function
	$(function(){
		$( "#tabs" ).tabs();
	});
	//instantite the uploader
	<?php $timestamp = time();?>
	$(function() {
		$('#file_upload').uploadify({
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'swf'      : 'uploader/uploadify.swf',
			'uploader' : 'upload.php?action=upload',
			'auto'     :  false,
			'fileTypeExts': '*.*'
		});
	});
	// this function will insert the url of the picture in the inage handler
	function insert_url(url)
	{
	     window.close();
	     window.opener.CkEditorURLTransfer(url);
	}
	//this will be triggered when a delete button will be clicked in order to delete an image
	function remove_media_file(file_id)
	{
		$.ajax({type:"POST",
		        url: 'upload.php?action=delete', 
		        data: {file_id : file_id}
		        })
	    .done(function(response)
	    {
			$("#media-item-"+file_id).fadeOut(300, function() {$(this).remove()}); 
		});															
	}
</script>
<div class="modal scrooled_div" id="media_modal" style="display: block;">
	<div id="tabs">
	  <ul>
	    <li><a href="#tabs-1">Media Files</a></li>
	    <li><a href="#tabs-2">Upload</a></li>
	     <li><a href="#tabs-3">Developers</a></li>
	  </ul>
	  <div id="tabs-1">
	  	<a href="http://dnationsoft.com/" target="_blank"><img src="http://dnationsoft.com/assact/images/logo.png" height="50"></a>
	  	<br/>
    	<?php 
   			if(!empty($mediaItems))
			{
				foreach($mediaItems as $k=>$v)
				{
			      ?>
			      <div class="media-item" id="media-item-<?php echo $v['id']; ?>">
			      	<a href="#" onclick="insert_url('<?php echo $uploadDir.$v['path'] ?>')" class="image_cke">
			      		<img src="<?php echo $uploadDir.$v['path'] ?>" class="media-item-image" />
			      	</a>
			      	<a class="close_small_btn remove_media" id="media-<?php echo $v['id']; ?>" title="Delete Picture" onclick="remove_media_file(<?php echo $v['id']; ?>)"></a>
			      </div>
			      <?php
				}
			}
			else
			{
				echo '<p class="media-item" style="padding:10px 0px 10px 0px;">You have no images yet! Please Upload.</p>';
			}
		?>
	  </div>
	  <div id="tabs-2">
	   		<form>
				<div id="queue"></div>
				<input id="file_upload" name="file_upload" type="file" multiple="true">
				<input type="button" id="start_upload" name="start_upload" class="upload_btn hidden" value="Upload" onclick="$('#file_upload').uploadify('upload')">
			</form>
	  </div>
	  <div id="tabs-3">
	  		<a href="http://dnationsoft.com/" target="_blank"><img src="http://dnationsoft.com/assact/images/logo.png" height="50"></a>
	  		<br/>
	  		If need any kind of help. Contact with our support team. <a href="mailto:contact@dnationsoft.com">contact@dnationsoft.com</a>
	  		<br/>
	  		<p>Visit us at: <a href="http://dnationsoft.com/" target="_blank">dnationsoft.com</a></p>
            <!--http://www.w3bdeveloper.com/how-to/ckeditor-upload-images-plugin-free-download/-->
	  </div>
	</div>
</div>
<?php
exit;
?>