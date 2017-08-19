<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>James Shao</title>
		<link rel="stylesheet" href="/stylesheets/app.css" />
		<link rel="shortcut icon" href="/images/website/favicon.ico" type="image/x-icon"/>
		<link rel="icon" href="/images/website/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" href="/bower_components/photoswipe/dist/photoswipe.css"/>
		<link rel="stylesheet" href="/bower_components/photoswipe/dist/default-skin/default-skin.css"/>		
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"/>
		<!--[if lt IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
		<script src="/bower_components/modernizr/modernizr.js"></script>
	</head>
	<body>
		<div class="home"><a><span class="fa fa-arrow-left" aria-hidden="true"></span>home</a></div>

<section class="main">

	<!-- MAIN GALLERY -->
	<div class="main-gallery">
		<div class="row">

			<div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">

<?php

//variables
$user_id = "37004245%40N08";
$api_key = "0172718a50c4b8d771cc90b648bb27ba";
$album = "72157686677766545";

function createOutput($photo_id, $location, $desc, $date) {

	$url = "https://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=".$GLOBALS['api_key']."&photo_id=".$photo_id."&format=json&nojsoncallback=1";
	$json2 = json_decode(file_get_contents($url), true);

	$width;
	$height;
	$src;
	$original_src;

	$sizes = $json2['sizes']['size'];
	for ($j = 0; $j < count($sizes); $j++) {
		$size_type = $sizes[$j]['label'];

		//get variables
		if ($size_type === "Large") {
			$width = $sizes[$j]['width'];
			$height = $sizes[$j]['height'];
			$src = $sizes[$j]['source'];
		}
	}

	$output .=	'<div class="large-12 medium-12 small-12 gallery-thumbnail">';

	//LOCATION
	$output .= '<div class="row">';
	$output .= '<div class="large-12 medium-12 small-12">';
	$output .= '<i class="fa fa-map-marker" aria-hidden="true"></i>';
	$output .= '<p>'.$location.'</p>';
	$output .= '</div></div>';

	//PHOTO
	$output .= '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
	$output .= '<a href="'.$src.'" itemprop="contentUrl" data-size="'.$width.'x'.$height.'">';
	$output .= '<img src="'.$src.'" itemprop="thumbnail" alt="Image description" />';
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

	if ($width > $height) { //horizontal
		return array($output, 1);
	}
	else if ($width == $height) { //square
		return array($output, 2);
	}
	else { //vertical
		return array($output, 2.5);
	}
}

function getDescription($title) {
	$title = str_replace(".jpg", "", $title);

	//get image information
	$location;
	$date;
	$desc;

	//open description file
	$descPath = "./images/info/" . $title . ".txt";

	$handle = fopen($descPath, "r");
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
		$location = "N/A (" . $title . ")";
		$date = "N/A";
		$desc = "No Description Available";
	}
	return array($location, $desc, $date);
}

error_reporting(E_ERROR | E_PARSE);

//call url get json
$url = 'https://api.flickr.com/services/rest/?method=flickr.photosets.getPhotos&api_key='.$api_key.'&photoset_id='.$album.'&user_id='.$user_id.'&format=json&nojsoncallback=1';

$json = json_decode(file_get_contents($url), true);
$photos = $json['photoset']['photo'];

//needed vars
$leftCol = "<div class='large-4 left columns show-for-large-up'>";
$midCol = "<div class='large-4 center columns show-for-large-up'>";
$rightCol = "<div class='large-4 right columns show-for-large-up'>";

$left_md = "<div class='medium-6 left columns show-for-medium-only'>";
$right_md = "<div class='medium-6 right columns show-for-medium-only'>";

$disp_sm = "<div class='small-12 columns show-for-small-only'>";

//heights
$leftH = 0;
$midH = 0;
$rightH = 0;

$leftH_md = 0;
$rightH_md = 0;

for ($i = 0; $i < count($photos); $i++) {
	$photo_id =	$photos[$i]["id"];
	$title = $photos[$i]['title'];

	//get specific information
	$desc = getDescription($title);
	$output = createOutput($photo_id, $desc[0], $desc[1], $desc[2]);

	//large size	
	if ($leftH <= $midH && $leftH <= $rightH) { //if left col is the least tall
		$leftCol .= $output[0];	
		$leftH += $output[1];
	}
	else if ($midH <= $leftH && $midH <= $rightH) { //if mid col is least tall
		$midCol .= $output[0];
		$midH += $output[1];
	}
	else {
		$rightCol .= $output[0];
		$rightH += $output[1];
	}	

	//medium size
	if ($leftH_md <= $rightH_md) {
		$left_md .= $output[0];
		$leftH_md += $output[1];
	}
	else {
		$right_md .= $output[0];
		$rightH_md += $output[1];
	}

	//small size by date
	$disp_sm .= $output[0];
}

echo $leftCol . "</div>";
echo $midCol . "</div>";
echo $rightCol . "</div>";

echo $left_md . "</div>";
echo $right_md . "</div>";

echo $disp_sm . "</div>";

/*
$outputArray = array();
$imgHeight = array();

$dir = new DirectoryIterator(dirname('./images/gallery/.'));
$dirList = array();
foreach ($dir as $fileinfo) {
	if (!$fileinfo->isDot()) {
		if ($fileinfo->getFilename() !== '.DS_Store') {
			$dirList[] = $fileinfo->getFilename();
		}
	}
}

//sort list of files, reverse order
rsort($dirList);

//needed vars
$leftCol = "<div class='large-4 medium-4 small-12 left columns'>";
$midCol = "<div class='large-4 medium-4 small-12 center columns'>";
$rightCol = "<div class='large-4 medium-4 small-12 right columns'>";

//heights
$leftH = 0;
$midH = 0;
$rightH = 0;

//iterate through and get info
foreach ($dirList as $filename) {
	//get image data	
	$img = "./images/gallery/" . $filename;
	$size = getimagesize($img);
	$width = $size[0];
	$height = $size[1];

	//get image information
	$location;
	$date;
	$desc;

	//open description file
	$descPath = "./images/info/" . str_replace(".jpg","",$filename) . ".txt";

	$handle = fopen($descPath, "r");
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

	$output = createOutput($location, $width, $height, $img, $date, $desc);

	$imgHeight;
	if ($width > $height) {
		$imgHeight = 1;
	} else {
		$imgHeight = 2.5;
	}

	if ($leftH <= $midH && $leftH <= $rightH) { //if left col is the least tall
		$leftCol .= $output;	
		$leftH += $imgHeight;
	}
	else if ($midH <= $leftH && $midH <= $rightH) { //if mid col is least tall
		$midCol .= $output;
		$midH += $imgHeight;
	}
	else {
		$rightCol .= $output;
		$rightH += $imgHeight;
	}	
}

echo $leftCol . "</div>";
echo $midCol . "</div>";
echo $rightCol . "</div>";
 */
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
	<!--
	<div id="gear" class="separator">
		<div class="row">
			<hr/>
			</div>
		</div>

		<div class="gear">
			<div class="row gear-header">
				<h2>Gear</h2>
				</div>
				<div class="row gear-content">
					<div class="row gear-row">
						<div class="large-5 medium-6 small-12 columns gear-image">

						</div>
						<div class="large-1 large-up columns"></div>
							<div class="large-6 medium-6 small-12 columns gear-text">
								<p>

								</p>
							</div>
						</div>
					</div>
				</div>
				-->
</section>

<script src="/bower_components/foundation/js/vendor/jquery.js"></script>
<script src="/bower_components/foundation/js/vendor/fastclick.js"></script>
<script src="/bower_components/foundation/js/foundation.min.js"></script>
<script src="/bower_components/photoswipe/dist/photoswipe.min.js"></script> <!-- core js file -->
<script src="/bower_components/photoswipe/dist/photoswipe-ui-default.min.js"></script> <!-- ui js file -->
<script src="https://use.fontawesome.com/cc84a4a3d6.js"></script>
<script src="/js/app.js"></script>
<script src="/js/gallery.js"></script>
	</body>
</html>
