<!-- Event Lobby -->

	<div class="container">
		<div class="row">
			
			<div class="col-md-4 col-md-offset-4">
				<h1>Search-o-matic 9000</h1>

			</div>
			
		</div>
		<hr>
		<div class="row" style="padding-top: 20px">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?php echo site_url("song/get_spotify_results"); ?>" method="post">
				<input class="text" name="searchq" placeholder="Type in a song...">
				<button class="btn btn-primary" name="submit" id="submit" > Search! </button>
				<button class="btn btn-warning" id="emptyall">Clear results</button>

			</form>

			</div>
			
				
				

			

		</div>

		<div class="row" style="padding-top:20px;">

				<div class="col-md-4 col-md-offset-4 well" id="search_results">
					<h3>Results</h3>

					<span id="results" > </span>
					<div id="loading_gif"> <img src="http://musocracy.net/img/spinner.gif"> </div>
				</div>
			</div>
	</div>
	<script type="text/javascript">
		var $loading = $('#loading_gif').hide();
			$(document)
				.ajaxStart(function(){
					$loading.show();

				})
				.ajaxStop(function(){
					$loading.hide();

				});

	</script>
	<script type="text/javascript">
		
		$('#submit').click(function() {
			var form_data = {

				song: $('input[name="searchq"]').val()
				// ajax: '1'

			};


			

		$.ajax({
			url: "<?php echo site_url('event/test_spotify_connection'); ?>",
			type: 'POST',
			data: form_data,
			success: function(msg){
				// feed the result into the html

				$('#results').append(msg);
			}


		});

		return false;

		});

		$('#emptyall').click(function() {

			$('#results').empty();

			return false;
		});
	</script>

<hr/>

	<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-list"></span>Sortable Lists
                    <div class="pull-right action-buttons">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog" style="margin-right: 0px;"></span>
                            </button>
                            <ul class="dropdown-menu slidedown">
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-pencil"></span>Edit</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-trash"></span>Delete</a></li>
                                <li><a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-flag"></span>Flag</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">
                                    List group item heading
                                </label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox2" />
                                <label for="checkbox2">
                                    List group item heading 1
                                </label>
                            </div>
                           <div class="pull-right action-buttons">
                                <a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox3" />
                                <label for="checkbox3">
                                    List group item heading 2
                                </label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox4" />
                                <label for="checkbox4">
                                    List group item heading 3
                                </label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox5" />
                                <label for="checkbox5">
                                    List group item heading 4
                                </label>
                            </div>
                           <div class="pull-right action-buttons">
                                <a href="http://www.jquery2dotnet.com"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="trash"><span class="glyphicon glyphicon-trash"></span></a>
                                <a href="http://www.jquery2dotnet.com" class="flag"><span class="glyphicon glyphicon-flag"></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>
                                Total Count <span class="label label-info">25</span></h6>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
