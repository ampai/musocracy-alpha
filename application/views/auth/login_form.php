<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'type' => 'text',
	'class' => 'form-control input-sm',
	'placeholder' => 'Email or Login',
);
if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'type' => 'password',
	'class' => 'form-control input-sm',
	'placeholder' => 'Password',
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Please login <small>It's quick!</small></h3>
			 			</div>
			 			<div class="panel-body">

			 			<?php 
			 				// Check to see if we have any flashdata to display
							$mess = $this->session->flashdata('not_logged_in');
			 				if (!empty($mess)) {
			 						
			 					?>
									
			 					<div class="alert alert-warning alert-dismissable">
			 					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			 					  <strong>Oops!</strong><?php echo $mess; ?>
			 					</div>
			 					

			 				
			 			 <?php }?>


			    		<!-- <form role="form"> -->
			    		<?php echo form_open($this->uri->uri_string()); ?>
			    			<div class="row">
			    				<!-- Username -->
			    				<div class="col-xs-6 col-sm-6 col-md-8">
			    					<div class="form-group">
			    						<?php echo form_input($login); ?>
			    						
			                			<!-- <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="$login_label"> -->
			    					</div>
			    				</div>

			    				<div class="col-xs-3 col-sm-3 col-md-3">
			    					
			    					<!-- Error -->
			    						<span class="label label-warning"><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
			    						
			    				</div>
			    				<!-- <div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div> -->
			    			</div>

			    			<!-- <div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div> -->

			    			<div class="row">
			    			<!-- Password -->
			    				<div class="col-xs-6 col-sm-6 col-md-8">
			    					<div class="form-group">
			    						<?php echo form_password($password); ?>
			    						<!-- <span class="label label-warning">Try again!</span> -->
			    						<!-- <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password"> -->
			    					</div>
			    				</div>

			    				<div class="col-xs-3 col-sm-3 col-md-3">
			    					
			    					<!-- Error -->
			    						<span class="label label-warning"><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
			    						
			    				</div>
			    				<!-- <div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div> -->
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-8">
			    				<div class="form-group">
									<?php echo form_checkbox($remember); ?>
									<?php echo form_label('Remember me', $remember['id']); ?>
									
								</div>
									 
			    				</div>

			    			</div>
			    			<?php $anchor_attribs_reg = array('class' => 'btn btn-success btn-block'); 
			    				  $anchor_attribs_forgot = array('class' => 'btn btn-default btn-block');
			    			?>
							<input type="submit" value="Sign In" class="btn btn-info btn-block">
			    			<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register', $anchor_attribs_reg); ?>
			    			
			    			<?php echo anchor('/auth/forgot_password/', 'Forgot password', $anchor_attribs_forgot); ?>
			    		<?php echo form_close(); ?>
			    		<!-- </form> -->
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>