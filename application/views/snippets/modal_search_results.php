<ul class="list-group modal-track-search">
	<?php 
	$i = 0;
	foreach ($tracks_arr as $info_object) {
		if($i == $max_results) break;

		$t_name = $info_object->name;
		$t_artist = $info_object->artists[0]->name;
		$t_album = $info_object->album->name;
		$t_uri = $info_object->href;
		?>
			<li class="list-group-item"><?php echo $t_name."  /  ".$t_artist."  /  ".$t_album; ?>
			<input id="hidden_href" type="hidden" value="<?php echo $t_uri; ?>">
			</li>

		<?php
		$i++;
	} ?>



</ul>