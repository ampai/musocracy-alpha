

    <!-- Full Page Image Header Area -->
    <div id="top" class="header">
        <div class="vert-text" style="color: white;">
            <h1>Welcome to Musocracy</h1>
            <h3>
                Fully Democratized, Collaborative Playlist Building
            </h3>
            <a href="#start" class="btn btn-default btn-lg">Get Started</a>
        </div>
    </div>
    <!-- /Full Page Image Header Area -->

    <!-- Intro -->
    <div id="start" class="intro">
        <div class="container">
            <div class="row">
                <div class="col-md-5" >
                    <h2><a href="<?php echo site_url("auth/register"); ?>">Register</a> now and create an event</h2>
                    <p class="lead">It's that easy -- once you log-in and create the event, your guests will be able to join</p>
                </div>
                 <div class="col-md-7" style="padding-left:20px; border-left: 1px solid #ccc;">
                    <h2>Joining the party?</h2>
                    <p class="lead">If you have an access code from the host, type it in below and join the fun!</p>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <label for="nickname">Your Name</label>
                                <input id="nickname" type="text" class="form-control" placeholder="Nickname"> 
                            <label for="accesscode">Key</label>
                                <input id="accesscode" name="accesscode" type="text" class="form-control" placeholder="Access Code" style="text-transform: uppercase; margin-bottom: 15px;">
                            <button class="btn btn-success btn-block" id="guest-access">Go To Event!</button>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /Intro -->

    <!-- Services -->
    <div id="services" class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h2>Features</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-3 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-rocket"></i>
                        <h4>Create Event</h4>
                        <p>A private lobby for your guests to chat and build playlists</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-magnet"></i>
                        <h4>Real-time voting</h4>
                        <p>Thanks to cool web technology, everyone is on the same page.</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-shield"></i>
                        <h4>Dynamic</h4>
                        <p>Not just for parties, use Musocracy for any event!</p>
                    </div>
                </div>
               <!--  <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-pencil"></i>
                        <h4>Pencil Sharpening</h4>
                        <p>We've been voted the best pencil sharpening service for 10 consecutive years. If you have a pencil that feels dull, we'll get it sharp!</p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- /Services -->

    <!-- Callout -->
    <!-- <div class="callout">
        <div class="vert-text">
            <h1>A Dramatic Text Area</h1>
        </div>
    </div> -->
    <!-- /Callout -->

    <!-- Technology -->
    <div id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h2>Architecture </h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="//placehold.it/200x200">
                        </a>
                        <h4>PHP & CodeIgniter</h4>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="//placehold.it/200x200">
                        </a>
                        <h4>Spotify API</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="//placehold.it/200x200">
                        </a>
                        <h4>Javascript & Backbone</h4>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="//placehold.it/200x200">
                        </a>
                        <h4>Pusher</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Technology -->

    <!-- Call to Action -->
    <!-- <div class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h3>The buttons below are impossible to resist.</h3>
                    <a href="#" class="btn btn-lg btn-default">Click Me!</a>
                    <a href="#" class="btn btn-lg btn-primary">Look at Me!</a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- /Call to Action -->


<script type="text/javascript">
    


    
</script>

 <script>
   // Smooth scrolling: http://css-tricks.com/snippets/jquery/smooth-scrolling/
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 600);
                    return false;
                }
            }
        });
    });
    </script>