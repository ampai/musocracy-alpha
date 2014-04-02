<div class="container">

	<!-- Event header information -->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1> 
			<small>You are participating in:  </small>
			<?php echo $event_name; ?>

			</h1>

		</div>


	</div>
	<!-- /Event header -->


	<!-- Guest List and Playlist row -->
	<div class="row">

		<!-- Guest list panel -->
		<div class="col-md-2 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Guests</div>

				<div class="panel-body">

					<ul>
						<li>Guest 1</li>
						<li>Guest 2</li>
					</ul>
					

				</div>

			</div>

		</div>

		<!-- Playlist panel -->
		<div class="col-md-8">
			<div class="panel panel-primary">
			  <!-- Default panel contents -->
			  <div class="panel-heading">Current Playlist</div>
			<!--   <div class="panel-body">
			    <p>...</p>
			  </div> -->

			  <!-- List group -->
			  <ul class="list-group">
			    <li class="list-group-item">
			    	Track Info 1 

			    </li>
			   	<li class="list-group-item">
			   		Track Info 2

			   	</li>
			   	

			  </ul>
			  <div class="panel-footer">
			  	
			  <button class="btn btn-warning" data-toggle="modal" data-target="#song_add_modal">Add Song</button>

			  </div>

			</div>


		</div>

	</div>
	<!-- /Guest List -->



</div>


<!-- Song loader modal -->
<!-- Modal -->
<div class="modal fade" id="song_add_modal" tabindex="-1" role="dialog" aria-labelledby="song_add_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="song_add_label">Track Finder</h4>
      </div>
      <div class="modal-body">
      	<!-- Search for Track -->
        <input class="text" id="track_name"placeholder="Enter a track name..."></input>
        <button class="btn btn-xs btn-primary" id="find_track">Search</button>
        <!-- Search results area -->
        <p id="results">
        	

        </p>
        	<!-- Loading spinner, hidden by default -->
			      				<div id="spinner" style="display: none;">
			      					<img src="<?php echo base_url('img/spinner.gif'); ?>">


			      				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Submit Track</button>
      </div>
    </div>
  </div>
</div>


<!-- Ajax methods -->
<!-- Get track from search query -->
<script type="text/javascript">
	$('body').on('click', '#find_track', function(){

		
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('event/test_ajax_out'); ?>",
         data: {search_q : $('#track_name').val()}, 
        // dataType: 'json',
        success: function(data){
        	$('#results').html(data);
        },
        error: function(data) { 
        	console.log(JSON.stringify(data)); }
   });

	});

</script>


    <!-- Loading spinner -->
<!-- implementation idea thanks to: http://stackoverflow.com/questions/2275342/jquery-ajaxstart-doesnt-get-triggered  -->
<script type="text/javascript">
    $(document).ajaxStart(function() {
      $('#results').hide();
      $("#spinner").show();
    });

    $(document).ajaxStop(function() {
      $("#spinner").hide();
      $('#results').show();
    });



</script>
