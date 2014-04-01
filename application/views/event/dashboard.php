<!-- Event Dasboard -->
<div class="container">
	<div class="row vert-text">
		
	<?php 
	// Check to see if we have any flashdata to display
	$mess = $this->session->flashdata('already_logged_in');
	if (!empty($mess)) {
	?>

	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Oops!</strong><?php echo $mess; ?>
	</div>
	<?php }?>

	<h1>

		Welcome <?php echo $curr_username; ?>,

		<small>what do you want to do?</small>

	</h1>	

	</div>

	<!-- Options accordion -->
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#joinevent">
	          Join Event
	        </a>
	      </h4>
	    </div>
	    <div id="joinevent" class="panel-collapse collapse in">
	      <div class="panel-body">
	        <!-- Join Event -->
	        	 <p>You need to know the lobby name and have an access code.</p>
	        	 <div class="row">
	        	   <div class="col-xs-3">
	        	   <form action="<?php echo site_url('event/join'); ?>" method="post" name="join_event_form">
	        	   <select class="form-control" name="selected_event_name">
	        	   		<?php 
	        	   			// Populate options based on what's in the $event_names_arr array
	        	   			// if it's empty, indicate no events were created
	        	   			foreach ($event_names_arr as $key => $value) {
	        	   				?>	
	        	   				<option value=" <?php echo $value; ?>"><?php echo $value; ?></option>
	        	   				<?php
	        	   			}


	        	   		 ?>
	        	   </select>
	        	   <input class="form-control" name="event_access_code" type="text" placeholder="Access Code"></input>

	        	   </div>

	        	 </div>
	        	 
	        	

	        	 <!-- Nick or ID select radios -->
	        	 <div class="row">
	        	 <div class="col-xs-3">
	        	   <div class="radio" >
	        	   <label >
	        	     <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" disabled>
	        	     Use a nickname
	        	   </label>
	        	 </div>
	        	 <div class="radio">
	        	   <label>
	        	     <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2" checked>
	        	     Use your username
	        	   </label>
	        	</div>

	        	 </div>
	        	 </div>

	        	 <div class="row">
	        	   <div class="col-xs-3">
	        	     <button type="submit" class="btn btn-success btn-block">Join</button>

	        	   </div>
	        	   

	        	 </div>
	        	</form>
	        <!-- !Join Event -->
	      </div>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#createevent">
	          Create Event
	        </a>
	      </h4>
	    </div>
	    <div id="createevent" class="panel-collapse collapse">
	      <div class="panel-body">
		      	<div class="event-create-form-hideable">
			      	<!-- Event details form -->
			      	<form id="create_event_form" action="" method="POST">
			      		<div class="container">
			      			<div class="row">
			      				<div class="col-md-4">
			      					<div class="form-group">
			      					   <label for="event_name">Name the event</label>
			      					   <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Enter name">
			      					</div>

			      					<div class="form-group">
			      					 	<label for="datetimepicker1">Starts</label>
			      					    <div class='input-group date' id='datetimepicker1'>
					                        <input type='text' id="time_field_start" name="event_time_start" class="form-control" placeholder="Start date"/>
					                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
					                        </span>
			      					    </div>
			      					</div>

			      					<div class="form-group">
			      					 	<label for="datetimepicker2">Ends</label>
			      					    <div class='input-group date' id='datetimepicker2'>
					                        <input type='text' id="time_field_end" name="event_time_end" class="form-control" placeholder="End date"/>
					                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
					                        </span>
			      					    </div>
			      					</div>
			      					
			      					<div class="form-group">
			      						<label for="guestcount">Maximum allowed guests</label>
			      						<select class="form-control" id="guestcount" name="guestcount">
			      						  <option>1</option>
			      						  <option>2</option>
			      						  <option>3</option>
			      						  <option>4</option>
			      						  <option>5</option>
			      						  <option>6</option>
			      						  <option>7</option>
			      						  <option>8</option>
			      						  <option>9</option>
			      						  <option>10</option>
			      						</select>
			      					</div>  
			      					<input class="btn btn-success btn-block" type="submit" value="Create Event!"> 	
			
			      				</div>
			      			</div>
			      		</div>

			      	</form>
			      	<!-- !event details form -->

		    	</div>
		    	<div class="event-create-ajax-result">
		    		
		    	</div>
	      	
	      </div>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#buildplaylist">
	          Event History
	        </a>
	      </h4>
	    </div>
	    <div id="buildplaylist" class="panel-collapse collapse">
	      <div class="panel-body">

	      	<div class="row">
	      		<div class="col-md-4">
	      			<p>You have currently no hosted events.</p>
	      			<button class="btn btn-primary btn-block">Options</button>
	      			<hr>

	      			<!-- Existing playlists -->
	      			<p>Listing</p>
	      			<table class="table table-striped">
	      				<thead></thead>
	      				<tbody></tbody>
	      				<tfoot></tfoot>
	      			</table>

	      		</div>
	      	</div>
	      	
	      </div>
	    </div>
	    </div>
	</div>

	<!-- !Options -->
	

</div>


 <script type="text/javascript">
    $('#create_event_form').submit(function(e) {

    var form = $(this);

    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('event/create_event'); ?>",
        data: form.serialize(), 
        dataType: 'json',
        success: function(data){
        	$('.event-create-form-hideable').hide();
            $('.event-create-ajax-result').html(data.html);
        	 console.log(JSON.stringify(data.html));
        },
        error: function(data) { 
        	console.log(JSON.stringify(data)); }
   });

});
</script>

  <script>
  $(function() {
    $( "#time_field_start" ).datepicker();
  });

  $(function() {
    $( "#time_field_end" ).datepicker();
  });
  </script>

<!-- !Event Dashboard -->