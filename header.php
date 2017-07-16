<?php
$root = false;
$gallery = false;
if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false) {
	$root = true;
} else if (strpos($_SERVER['SCRIPT_NAME'], 'gallery.php') !== false) {
	$gallery = true;
}
?>


<nav class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
		<li class="name">
			<h1><p>James Shao</p></h1>
		</li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
<?php
if ($root) {
	echo '
			<li><a href="#" class="active">ABOUT ME</a></li>
			<li><a href="#resume">RESUME</a></li>
			<li><a href="#">PROJECTS</a></li>
			<li><a href="gallery.php">PHOTOGRAPHY</a></li>
			<li><a href="#contact">CONTACT ME</a></li>';
} else if ($gallery) {
	echo "gallery is true";
	echo '
			<li><a href="index.php">ABOUT ME</a></li>
			<li><a href="index.php#resume">RESUME</a></li>
			<li><a href="#">PROJECTS</a></li>
			<li><a href="#" class="active">PHOTOGRAPHY</a></li>
			<li><a href="index.php#contact">CONTACT ME</a></li>';
} else {
	echo "defaul";
	echo '
			<li><a href="index.php" class="active">ABOUT ME</a></li>
			<li><a href="index.php#resume">RESUME</a></li>
			<li><a href="#">PROJECTS</a></li>
			<li><a href="gallery.php">PHOTOGRAPHY</a></li>
			<li><a href="index.php#contact">CONTACT ME</a></li>';
}
?>
		</ul>
	</section>
</nav>

