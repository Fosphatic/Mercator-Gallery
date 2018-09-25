<?php

/*

    Mercator Gallery Extension for Pagekit
    Copyright (C) 2018 Helmut Kaufmann

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.

*/

// The following .js in the <script> should be incldued in the header.
// This is currently not working and the following line is incldued till the problem has been resolved.
?>

<script src="/packages/mercator/gallery/assets/js/blueimp-gallery.min.js"></script>

<?php

// Slideshow default values
$imageSize = 2000;    			// Maximum width or height of the resized image
$thumbWidth = 128;    			// Size of a thumbnail
$jpgQuality = 70;				// Thumbnail compression level
$slideShowInterval = 3500;		// Duration a slide is shown (ms)
$startSlideshow = "true";		// Automatically start slideshow
$fullScreen= "true" ;			// Present sldieshow in fullscreen mode

$ran=mt_rand();
require_once('MercatorGalleryHelper.php');

$pagekit_root = $_SERVER["DOCUMENT_ROOT"] . "/storage/Images/";

if (!isset($options['dir'])) {
	echo ("Oups: You must set the 'dir' option in the mercator_gallery plugin");
	return 0;
};
	
$imageDir = $options['dir'] . "/";  // must end with a slash
$thumbDir = $imageDir . "thumbs"; // must end with a slash

$dir = new DirectoryIterator($pagekit_root .$imageDir);
@mkdir ($pagekit_root . $thumbDir);
@mkdir ($pagekit_root . $thumbDir . "-large/");

$FoundFiles = array();

foreach ($dir as $fileinfo) {
    if ($fileinfo->isFile() && !$fileinfo->isDot()) {
		if (!file_exists($pagekit_root . $thumbDir . "/". $fileinfo->getFilename())) {
			resize_image($pagekit_root . $imageDir . "/" . $fileinfo->getFilename(),  $pagekit_root .$thumbDir ."-large/" . $fileinfo->getFilename(), $imageSize, $imageSize, $jpgQuality, null);
			resize_thumb($pagekit_root . $imageDir . "/" .$fileinfo->getFilename(),  $pagekit_root . $thumbDir . "/" . $fileinfo->getFilename(), $thumbWidth, $thumbWidth, $jpgQuality,null);
		}
		$FoundFiles[] = $fileinfo->getFilename();
	}
}

asort($FoundFiles, $sort_flag=SORT_NATURAL);


if (isset($options['options']))
	$myOptions=$options['options'];
else
	$myOptions="";

if (isset($options['fullscreen']))
	$fullScreen=$options['fullscreen'];

if (!isset($options['mode']))
	$options['mode']="default";

if (!isset($options['position']))
	$position="uk-width-1-2 uk-container-center";
else
	$position=$options['position'];

if (!isset($options['duration']))
	$duration=3500;
else
	$duration=$options['duration'];

if (!isset($options['options']))
	$myOptions="";
else
	$myOptions=$options['options'];


switch ($options['mode']) {

	case "carousel":

		echo "<div class='$position'>";
			echo "<div id='blueimp-gallery-carousel-$ran' class='blueimp-gallery blueimp-gallery-carousel'>";
				echo <<< EOT
    			<div class="slides"></div>
   				<h3 class="title"></h3>
    			<a class="prev">‹</a>
    			<a class="next">›</a>
    			<a class="play-pause"></a>
    			<ol class="indicator" hidden></ol>
			</div>
EOT;

		echo ("<div id ='links_" . $ran . "'>");
		foreach ($FoundFiles as $fileinfo) {

			$str = $fileinfo;
			$pos = strrpos($str, "/") +1;
			$res = substr($str, 0, $pos) . htmlentities(substr($str, $pos));

    		echo "<a href='storage/Images/$thumbDir-large/$res'></a>\n";

		}
		echo "</div></div>";
		break;

	case "default":
	default:

		echo "<div id='blueimp-gallery_$ran' class='blueimp-gallery blueimp-gallery-controls'>";
		echo <<< EOT
    		<div class="slides"></div>
   			<h3 class="title"></h3>
    		<a class="prev">‹</a>
    		<a class="next">›</a>
    		<a class="close">×</a>
    		<a class="play-pause"></a>
    		<ol class="indicator"></ol>
		</div>
EOT;

		echo ("<div id ='links_$ran'>");

		foreach ($FoundFiles as $fileinfo) {

			$str = $fileinfo;
			$pos = strrpos($str, "/") +1;
			$res = substr($str, 0, $pos) . htmlentities(substr($str, $pos));

    		echo "<a href='storage/Images/$thumbDir-large/$res'>\n";
    		echo "<img src='storage/Images/$thumbDir/$res'>\n";
    		echo "</a>";
		}
		echo "</div>";
}
?>

<script>

document.getElementById('links_<?php echo $ran;?>').onclick = function (event) {
   	event = event || window.event;
    var target = event.target || event.srcElement,
    link = target.src ? target.parentNode : target,
    options = {index: link, event: event, startSlideshow: <?php echo $startSlideshow; ?>, slideshowInterval: <?php echo $slideShowInterval; ?>, fullScreen: <?php echo $fullScreen; ?>, container: '#blueimp-gallery_<?php echo ($ran); ?>', <?php echo $myOptions; ?>},
    links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};

blueimp.Gallery(document.getElementById('links_<?php echo $ran;?>').getElementsByTagName('a'),
	{
		container: '#blueimp-gallery-carousel-<?php echo $ran;?>',
		carousel: true,
        hidePageScrollbars: false,
    	toggleControlsOnReturn: false,
   		toggleSlideshowOnSpace: false,
    	enableKeyboardNavigation: false,
    	closeOnEscape: false,
    	closeOnSlideClick: false,
    	closeOnSwipeUpOrDown: false,
    	disableScroll: false,
    	startSlideshow: true,
        slideshowInterval: <?php echo $duration; ?>
	}
);
</script>
