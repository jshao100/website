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

		<div class="experiment">
			<div class="circle large red pos_me reset">
				<a class="top">James</br>Shao</a>
			</div>
			<div class="circle large blue pos_gallery">
				<a class="middle">Gallery</a>
			</div>
			<div class="circle medium yellow pos_projects">
				<a class="middle click_to_zoom">Projects</a>
			</div>	
			<div class="circle medium green pos_exp">
				<a class="middle click_to_zoom">Experience</a>
			</div>	
			<div class="circle medium blue pos_about">
				<a class="middle click_to_zoom">Me</a>
			</div>
			<div class="circle small orange pos_resume">
				<a class="fa fa-file-text-o resume" aria-hidden="true"></a>
			</div>
			<div class="circle small orange pos_mailto">
				<a class="fa fa-envelope-o mailto" aria-hidden="true"></a>
			</div>
			<div class="circle small orange pos_github">
				<a class="fa fa-github github" aria-hidden="true"></a>
			</div>
			<div class="circle small orange pos_instagram">
				<a class="fa fa-instagram instagram" aria-hidden="true"></a>
			</div>
			<div class="circle small orange pos_linkedin">
				<a class="fa fa-linkedin linkedin" aria-hidden="true"></a>
			</div>

			<!-- PROJECTS -->
			<div class="proj_content">

<?php 
	/* FILE FORMAT
	 *
	 * Project Title
	 * Date
	 * Technology
	 * Sentence 1
	 * (optional) Sentence 2
	 * Github Link
	 *
	 */

error_reporting(E_ERROR | E_PARSE);
$numProj = 4;

for ($i = 1; $i <= $numProj; $i++) {
	$handle = fopen("./text/projects/proj".$i.".txt", "r");
	if ($handle) {
		$title;
		$date;
		$tech;
		$s1;
		$s2 = false;
		$git;

		$count = 0;
		while (($line = fgets($handle)) !== false) {
			if ($count == 0) {
				$title = $line;
			} else if ($count == 1) {
				$date = $line;
			} else if ($count == 2) {
				$tech = $line;
			} else if ($count == 3) {
				$s1 = $line;
			} else if ($count == 4) {
				$next = fgets($handle);

				//next not null
				if ($next !== false) {
					$s2 = $line;
					$git = $next;
				} else {
					$git = $line;
				}
			}
			$count++;
		}
		fclose($handle);

		echo '<div class="proj'.$i.'">';
		echo '<div class="circle small blue pos_proj'.$i.'">';
		echo '<a class="middle x2">'.$title.'<span>'.$date.'</span></a></div>';
		echo '<div class="circle x-small red pos_proj'.$i.'_tech"><p>'.$tech.'</div>';
		echo '<div class="circle x-small yellow pos_proj'.$i.'_s1"><p>'.$s1.'</div>';
		if ($s2 !== false) {
			echo '<div class="circle x-small orange pos_proj'.$i.'_s2"><p>'.$s2.'</div>';
		}
		echo '<div class="circle xx-small green pos_proj'.$i.'_git">';
		echo '<a href="'.$git.'" class="fa fa-github" aria-hidden="true" target="_blank"></a></div>';
		echo '</div>';
	}
}
?>
			</div>

			<!-- EXPERIENCE -->
			<div class="exp_content">
<?php 
	/* FILE FORMAT
	 *
	 * Title
	 * Date
	 * S1
	 * S2
	 * S3
	 *
	 */

error_reporting(E_ERROR | E_PARSE);
$numProj = 4;

for ($i = 1; $i <= $numProj; $i++) {
	$handle = fopen("./text/experience/exp".$i.".txt", "r");
	if ($handle) {
		$title;
		$date;
		$s1;
		$s2;
		$s3;

		$count = 0;
		while (($line = fgets($handle)) !== false) {
			if ($count == 0) {
				$title = $line;
			} else if ($count == 1) {
				$date = $line;
			} else if ($count == 2) {
				$s1 = $line;
			} else if ($count == 3) {
				$s2 = $line;
			} else if ($count == 4) {
				$s3 = $line;
			}
			$count++;
		}
		fclose($handle);

		echo '<div class="exp'.$i.'">';
		echo '<div class="circle small yellow pos_exp'.$i.' show_on_zoom">';
		echo '<a class="middle x2">'.$title.'<span>'.$date.'</span></a></div>';
		echo '<div class="circle x-small blue pos_exp'.$i.'_1"><p>'.$s1.'</p></div>';
		echo '<div class="circle x-small green pos_exp'.$i.'_2"><p>'.$s2.'</p></div>';
		echo '<div class="circle x-small red pos_exp'.$i.'_3"><p>'.$s3.'</p></div>';
		echo '</div>';

	}

}
		?>
			</div>

		</div>
		<script src="/bower_components/foundation/js/vendor/jquery.js"></script>
		<script src="/bower_components/foundation/js/vendor/fastclick.js"></script>
		<script src="/bower_components/foundation/js/foundation.min.js"></script>
		<script src="https://use.fontawesome.com/cc84a4a3d6.js"></script>
		<script src="/js/experiment.js"></script>
	</body>
</html>
