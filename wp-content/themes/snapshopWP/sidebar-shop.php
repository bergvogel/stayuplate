<?php
	global $snpshpwp_data;
	$sidebar_class = '';

	if ( is_product() ) {
		$sidebar = 'sidebar-woo-single';
		$position = $snpshpwp_data['woo-sidebar-position-single'];
	}
	else {
		$sidebar = 'sidebar-woo';
		$position = $snpshpwp_data['woo-sidebar-position'];
	}

	switch ($snpshpwp_data['sidebar-size-woo']):
	case '3' :
		$sidebar_class = 'snpshpwp_sidebar_wrapper fbuilder_column fbuilder_column-1-3';
	break;
	case '4' :
		$sidebar_class = 'snpshpwp_sidebar_wrapper fbuilder_column fbuilder_column-1-4';
	break;
	case '5' :
		$sidebar_class = 'snpshpwp_sidebar_wrapper fbuilder_column fbuilder_column-1-5';
	break;
	default :
		die('Not set right.');
	endswitch;
?>
<div class="<?php echo $sidebar_class; ?> snpshpwp_sidebar_<?php echo ( $position !== '1' ? 'right' : 'left' ); ?>">
	<?php dynamic_sidebar( $sidebar ); ?>
</div>