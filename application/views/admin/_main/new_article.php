<div class="col-md-10 offset-md-1">
	<div class="card">
		<div class="card-header bg-white"><h5><b>New Article</b></h5></div>
		<div class="card-body">
        <?php $this->load->helper("form"); ?>
        <form id="form_article" method="POST" action="<?php print_r(site_url('adm/go_make_article')) ?>" enctype="multipart/form-data">
	        <div class="form-group"> 
	        	<label for="category" class="mx-2 my-auto">Category: </label>
				<select class="form-control mt-2" id="category" name="category" required>
					<option value="Event">Event</option>
					<option value="Update">Update</option>
					<option value="News">News</option>
					<option value="Page">Page</option>
				</select>
	        </div>
	        <div class="form-group"> 
	        	<label for="content" >Title: </label>
	            <input type="text" class="form-control" placeholder="Article title" name="title" id="title">
	        </div>
	        <div class="input-group mb-4">
	            <div class="input-group-prepend">
	              <a class="btn input-group-text text-primary" id="edit_icon" data-stat="off"><i class="fas fa-lock"></i></a>
	            </div>
	            <input type="text" class="form-control required" placeholder="Article url" id="url_article" name="url_article" readonly>
	        </div>
	        <div class="form-group">
				<label for="userfile" >Image : </label>
				<input type="file" id="userfile" name="userfile" />
			</div>
			<div class="form-group">
				<label for="content" >Content: </label>
				<textarea type="text" class="summernote form-control required" rows="6" placeholder="content" id="content" name="content"></textarea>
			</div>
	        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){

	$('.summernote').summernote({height: 250});

	$("#title").keyup(function () {
	      var str = $(this).val();
	      if(str.length != 0){
	        var final = str.toLowerCase().replace(/[^A-Z0-9]+/ig, "-");
	        $('#url_article').val(final);
	      }else{
	      	$('#url_article').val('');
	      }
	}).keyup();

	$("#edit_icon").click(function(){
	  var check = $(this).data('stat');

	  if(check=='off'){

	  	$(this).data('stat','on').html('<i class="fas fa-lock-open"></i>');

	    $("#url_article").removeAttr("readonly");
	    
	  }else if(check=='on'){

	  	$(this).data('stat','off').html('<i class="fas fa-lock"></i>');

	    $("#url_article").attr("readonly","");
	    
	  }
	  
	});
})
</script>