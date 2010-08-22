<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11 http://purl.org/uF/hAtom/0.1/ http://purl.org/uF/2008/03/">
	
	<title><?php wp_title('&laquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>

	<base href="<?php bloginfo('url'); ?>" />
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?> charset="<?php bloginfo('charset'); ?>" />

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />


	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="alternate" type="text/xml"             title="RSS 0.92" href="<?php bloginfo('rss_url');  ?>" />
	<link rel="alternate" type="application/rss+xml"  title= "RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<?php automatic_feed_links(); ?>
	
	<?php locale_stylesheet(); ?> 

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


	<div id="wrapper">

		<div id="container">
	
	
			<div id="header">
	
	
				<div id="title">
				
					<div id="name"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></div> 
			
					<div id="description"><?php bloginfo('description'); ?></div>
					
				</div>
	
	
				<div id="intro"><?php dynamic_sidebar('Intro'); ?></div> 
			
	
				<div id="menu">
		
					<?php wp_nav_menu( array( 'theme_location' => 'Header' ) ); ?>
		
				</div>				
	
		
			<div id="band"></div>
	
				
				<div id="banner" onclick="location.href='<?php bloginfo('url'); ?>';" style="cursor: pointer;"></div>
			
			</div>