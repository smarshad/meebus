<?php
include("resize-class.php");
function resize_pic($resizimg,$resizW,$resizH,$moveto){
 $resizeObj = new resize($resizimg);

	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj -> resizeImage($resizW, $resizH, 'exact');

	// *** 3) Save image
	$resizeObj -> saveImage($moveto, 100);
}
?>
