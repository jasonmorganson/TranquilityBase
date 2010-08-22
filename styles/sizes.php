/***** SIZES *****/

#banner {
	width:  <?php echo HEADER_IMAGE_WIDTH;  ?>px;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
}

#container,
#main-container {
	width: <?php echo $option["total-width"]; ?>px;
}

#sidebar-left {
	width: <?php echo $option["sidebar-left-width"]; ?>px;
}

#sidebar-right {
	width: <?php echo $option["sidebar-right-width"]; ?>px;
}

#content,
#content[class="both-sides"] {
	width: <?php echo $option["content-width"]; ?>px;
}

#content[class="left-only"] {
	width: <?php echo ( intval($option["total-width"]) - intval($option["sidebar-left-width"]) ); ?>px;
}

#content[class="right-only"] {
	width: <?php echo ( intval($option["total-width"]) - intval($option["sidebar-right-width"]) ); ?>px;
}


#content-container {
	right: <?php echo ( intval($option["sidebar-right-width"]) ); ?>px;
}

#sidebar-left-container {
	right: <?php echo ( intval($option["content-width"]) ); ?>px;
}

#content,
#sidebar-left,
#sidebar-right {
	left: <?php echo ( intval($option["content-width"]) + intval($option["sidebar-right-width"]) ); ?>px;
}

