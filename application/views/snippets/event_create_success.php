<div class="container">
  <div class="row">
    <div class="col-md-5">
      <h2>Success!</h2>
      <p>You just created an event! Let's get the party started.</p>
      <h2><?php echo $access_code; ?> <small> Use this code to allow guests to join!</small></h2>
      <a class="btn btn-success btn-block" href="<?php echo site_url('event/lobby/').'/'.$event_id; ?>">Go to Lobby</a>
    </div>
  </div>
</div>