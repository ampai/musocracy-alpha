<li class="list-group-item">
<span class="badge"> <?php echo 0; ?></span>

	<div class="media">
	  <a class="pull-left">
	    <img class="media-object" src="//placehold.it/64x64" alt="Icon">
	  </a>
	  <div class="media-body">
	    <h4 class="media-heading"><?php echo $track_name ?></h4>
	    <p style="margin-bottom: 0;"><strong>Artist: </strong> <?php echo $track_artist; ?>  


	    	<button class="btn btn-default btn-xs pull-right"><span class="glyphicon glyphicon-chevron-up pull-right"></span></button>
	    </p>
	    <p><strong>Album: </strong><?php echo $track_album . '(' . $track_album_date . ')'; ?> 

	    
	    <button class="btn btn-default btn-xs pull-right"><span class="glyphicon glyphicon-chevron-down pull-right"></span></button>

	    </p>
	    <!-- Hidden: <?php echo $track_uri; ?> -->

	    
	  </div>
	


	</div>
	

</li>