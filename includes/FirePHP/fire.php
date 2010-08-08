<?php

/* Setup FireBug debugging */

require_once( 'fb.php' );
require_once( 'FirePHP.class.php' );
$firephp = FirePHP::getInstance(true);

$firephp->setEnabled(true);
ob_start();

?>