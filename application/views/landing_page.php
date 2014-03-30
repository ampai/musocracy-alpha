

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
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2>Create an event to get the party started, or join as a guest if you're already there.</h2>
                    <p class="lead">It's that easy -- but if you're thinking about hosting, you'll need to <a href="<?php echo site_url("auth/register"); ?>">register</a> with us first.</p>
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
                    <h2>Pick one</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-3 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-rocket"></i>
                        <h4>Create Event</h4>
                        <p>Get the ball rolling.</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-magnet"></i>
                        <h4>Join an Event</h4>
                        <p>Glad you've made it, join in on everyone's fun!</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="service-item">
                        <i class="service-icon fa fa-shield"></i>
                        <h4>Register</h4>
                        <p>Registration allows you to weild the throne of the DJ, please have fun.</p>
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

    <!-- Portfolio -->
   <!--  <div id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <h2>Our Work</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-1.jpg">
                        </a>
                        <h4>Cityscape</h4>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-2.jpg">
                        </a>
                        <h4>Is That On Fire?</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-2 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-3.jpg">
                        </a>
                        <h4>Stop Sign</h4>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="portfolio-item">
                        <a href="#">
                            <img class="img-portfolio img-responsive" src="img/portfolio-4.jpg">
                        </a>
                        <h4>Narrow Focus</h4>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- /Portfolio -->

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