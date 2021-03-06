<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>James Shao</title>
		<link rel="shortcut icon" href="/images/website/favicon.ico" type="image/x-icon"/>
		<link rel="icon" href="/images/website/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" href="/stylesheets/app.css" />
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"/>
		<script src="/bower_components/modernizr/modernizr.js"></script>
	</head>
	<body>
		<?php include 'header.php'; ?>

		<section class="main">

			<!-- MAIN BANNER -->
			<div class="banner main-banner">
				<div class="row banner-text">
					<h1>JAMES</h1>
					<h1>SHAO</h1>
				</div>
				<div class="banner-icon-main row banner-down">
					<i class="banner-icon fa fa-angle-down show-for-medium-up" aria-hidden="true"></i>
				</div>
			</div>

			<!-- ABOUT ME -->
			<div class="about-me">
				<div class="row">
					<div class="row one-liner">
						<div class="large-8 medium-8 small-12">
							<h1>21 // Male // CompSci</h1>
						</div>
					</div>
					<div class="row about-me-content">
						<div class="large-4 medium-4 small-12 columns show-for-medium-up">
							<div class="about-me-brief">
<?php
error_reporting(E_ERROR | E_PARSE);
$handle = fopen("./text/about-me-list.txt", "r");
if ($handle) {
	while (($line = fgets($handle)) !== false) {
		echo '<div class="row">';
		echo '<p>' . $line . '</p>';
		echo '</div>';	
	}
	fclose($handle);
} else {
} 
?>
							</div>
						</div>
						<div class="large-7 large-push-1 medium-8 small-12 columns">
							<div class="about-me-text">
								<p class="text-justify">
									<?php include './text/about-me.txt'; ?>
								</p>
						</div>
						</div>
					</div>
				</div>
			</div>

			<!-- RESUME SECTION -->
			<div id="resume" class="banner resume-banner">
				<div class="row banner-text">
					<h1>RÉSUMÉ</h1>
				</div>
			</div>
			<div class="resume">
				<div class="row">
					<div class="large-10 medium-10 small-12 large-push-1 medium-push-1 columns">
						<img src="/images/website/resume-example.png" width=100% height=100%/>
					</div>
				</div>
			</div>

			<!-- CONTACT SECTION -->
			<div id="contact" class="separator">
				<div class="row">
					<hr/>
				</div>
			</div>

			<div class="contact">
				<div class="row">
					<div class="contact-header large-8 large-push-2 medium-10 medium-push-1 small-12">
						<h1>CONTACT</h1>
					</div>
				</div>
				<div class="row">
					<div class="contact-content large-8 medium-10 small-12 large-push-2 medium-push-1">
						<form class="contact-us-form" method="post" action="send_form_email.php">
							<div class="row">
								<div class="large-6 columns medium-6 small-12 left">
									<input type="text" placeholder="first name" name="first_name">
								</div>
								<div class="large-6 medium-6 small-12 columns right">
									<input type="text" placeholder="last name" name="last_name">
								</div>
							</div>
							<div class="row form-padding">
								<div class="large-6 columns medium-6 small-12 left">
									<input type="email" placeholder="email" name="email">
								</div>
								<div class="large-6 medium-6 small-12 columns right">
									<input type="tel" placeholder="phone number" name="phone">
								</div>
							</div>
							<div class="row">
								<div class="columns">
									<input type="text" placeholder="subject" name="subject">
								</div>
							</div>
							<div class="row">
								<div class="columns">
									<textarea name="message" id="" rows="12" placeholder="Type your message here"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="columns">
									<input type="submit" class="submit large-4 medium-4 small-12 large-push-4 medium-push-4" value="Send it" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

		<?php include 'footer.php'; ?>

		<script src="/bower_components/foundation/js/vendor/jquery.js"></script>
		<script src="/bower_components/foundation/js/vendor/fastclick.js"></script>
		<script src="/bower_components/foundation/js/foundation.min.js"></script>
		<script src="https://use.fontawesome.com/cc84a4a3d6.js"></script>
		<script src="/js/app.js"></script>
	</body>
</html>
