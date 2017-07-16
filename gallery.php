<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Foundation</title>
		<link rel="stylesheet" href="stylesheets/app.css" />
		<link rel="stylesheet" href="bower_components/photoswipe/dist/photoswipe.css"/>
		<link rel="stylesheet" href="bower_components/photoswipe/dist/default-skin/default-skin.css"/>		
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"/>
		<!--[if lt IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
		<script src="bower_components/modernizr/modernizr.js"></script>
	</head>
	<body>

<?php include 'header.php'; ?>


<section class="main">

	<!-- MAIN BANNER -->
	<div class="banner gallery-banner">
		<div class="row banner-text">
			<h1>PORTFOLIO
				<div class="banner-link" class="row">
					<a href="#gear">GEAR</a>
				</div>
			</h1>
		</div>
		<div class="banner-icon-main row banner-down">
			<i class="banner-icon fa fa-angle-down" aria-hidden="true"></i>
		</div>
	</div>

	<!-- MAIN GALLERY -->
	<div class="main-gallery">
		<div class="row">

			<div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">

<?php
error_reporting(E_ERROR | E_PARSE);
$outputArray = array();

$dir = new DirectoryIterator(dirname('./images/gallery/.'));
foreach ($dir as $fileinfo) {
	$output = "";
	if (!$fileinfo->isDot()) {
		$name = $fileinfo->getFilename();
		$path = "./images/gallery/";
		$size = getimagesize($fileinfo->getPathname());
		$width = $size[0];
		$height = $size[1];

		$location;
		$date;
		$desc;

		//open description file
		$descPath = "./images/info/";
		$descFile = pathinfo($fileinfo->getPathname())['filename'] . ".txt";
		$handle = fopen($descPath.$descFile, "r");
		$i = 0;
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				// process the line read.
				if ($i == 0) {
					$location = $line;
				} else if ($i == 1) {
					$date = $line;
				} else {
					$desc = $line;
				}
				$i++;
			}
			fclose($handle);
		} else {
			// error opening the file.
			$location = "N/A";
			$date = "N/A";
			$desc = "No Description Available";
		} 

		$output .=	'<div class="large-4 medium-4 small-12 columns left gallery-thumbnail">';

		//LOCATION
		$output .= '<div class="row">';
		$output .= '<div class="large-12 medium-12 small-12">';
		$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
		$output .= '<p>'.$location.'</p>';
		$output .= '</div></div>';

		//PHOTO
		$output .= '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
		$output .= '<a href="'.$path.$name.'" itemprop="contentUrl" data-size="'.$width.'x'.$height.'">';
		$output .= '<img src="'.$path.$name.'" itemprop="thumbnail" alt="Image description" />';
		$output .= '</a>';
		$output .= '<figcaption itemprop="caption description">'.$desc.'</figcaption>';
		$output .= '</figure>';

		//DATE
		$output .= '<div class="row">';
		$output .= '<div class="large-12 medium-12 small-12">';
		$output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
		$output .= '<p>'.$date.'</p>';
		$output .= '</div></div>';

		//CLOSE ALL	
		$output .= '</div>';

	}
	$outputArray[] = $output;
}

$outputArray = array_reverse($outputArray);
foreach ($outputArray as $line) {
	echo $line;
}
?>

			</div>

			<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="pswp__bg"></div>
				<div class="pswp__scroll-wrap">
					<div class="pswp__container">
						<div class="pswp__item"></div>
						<div class="pswp__item"></div>
						<div class="pswp__item"></div>
					</div>
					<div class="pswp__ui pswp__ui--hidden">
						<div class="pswp__top-bar">
							<div class="pswp__counter"></div>
							<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
							<button class="pswp__button pswp__button--share" title="Share"></button>
							<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
							<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
							<div class="pswp__preloader">
								<div class="pswp__preloader__icn">
									<div class="pswp__preloader__cut">
										<div class="pswp__preloader__donut"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
							<div class="pswp__share-tooltip"></div> 
						</div>
						<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
						</button>
						<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
						</button>
						<div class="pswp__caption">
							<div class="pswp__caption__center"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include 'footer.php'; ?>

<script src="bower_components/foundation/js/vendor/jquery.js"></script>
<script src="bower_components/foundation/js/vendor/fastclick.js"></script>
<script src="bower_components/foundation/js/foundation.min.js"></script>
<script src="bower_components/photoswipe/dist/photoswipe.min.js"></script> <!-- core js file -->
<script src="bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script> <!-- ui js file -->
<script src="https://use.fontawesome.com/cc84a4a3d6.js"></script>
<script src="js/app.js"></script>
<script src="js/gallery.js"></script>
	</body>
</html>
