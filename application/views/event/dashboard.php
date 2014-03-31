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

		Welcome

		<small>What do you want to do?</small>

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
	        	   <input class="form-control" type="text" placeholder="Lobby Name"></input>
	        	   <input class="form-control" type="password" placeholder="Access Code"></input>

	        	   </div>

	        	 </div>
	        	 
	        	

	        	 <!-- Nick or ID select radios -->
	        	 <div class="row">
	        	 <div class="col-xs-3">
	        	   <div class="radio">
	        	   <label>
	        	     <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
	        	     Use a nickname
	        	   </label>
	        	 </div>
	        	 <div class="radio">
	        	   <label>
	        	     <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
	        	     Use registration name
	        	   </label>
	        	</div>

	        	 </div>
	        	 </div>

	        	 <div class="row">
	        	   <div class="col-xs-3">
	        	     <button type="button" class="btn btn-success btn-block">Join</button>

	        	   </div>
	        	   

	        	 </div>
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
	      	<!-- Event details form -->
	      		<div class="container">
	      			<div class="row">
	      				<div class="col-md-4">
	      					<div class="form-group">
	      					   <label for="event_name">Name the event</label>
	      					   <input type="email" class="form-control" id="event_name" placeholder="Enter name">
	      					</div>

	      					<div class="form-group">
	      					 	<label for="datetimepicker1">Start time</label>
	      					    <div class='input-group date' id='datetimepicker1'>
			                        <input type='text' id="start_time" class="form-control" placeholder="Start time"/>
			                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                        </span>
	      					    </div>
	      					</div>

	      					<div class="form-group">
	      					 	<label for="datetimepicker1">End time</label>
	      					    <div class='input-group date' id='datetimepicker2'>
			                        <input type='text' id="start_time" class="form-control" placeholder="End time"/>
			                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                        </span>
	      					    </div>
	      					</div>
	      					
	      					<div class="form-group">
	      						<label for="guestcount">Maximum allowed guests</label>
	      						<select class="form-control" id="guestcount">
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
	      					 	
	      					<button class="btn btn-success btn-block">Create Event!</button>
	      				</div>
	      			</div>
	      		</div>


	      	<!-- !event details form -->
	      </div>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#buildplaylist">
	          Make a playlist
	        </a>
	      </h4>
	    </div>
	    <div id="buildplaylist" class="panel-collapse collapse">
	      <div class="panel-body">

	      	<div class="row">
	      		<div class="col-md-4">
	      			<p>Playlist builder page</p>
	      			<button class="btn btn-primary btn-block">Open playlist builder</button>
	      			<hr>

	      			<!-- Existing playlists -->
	      			<p>Playlists</p>
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
             $(function () {
                 $('#datetimepicker1').datetimepicker();
             });
</script>

<!-- !Event Dashboard -->