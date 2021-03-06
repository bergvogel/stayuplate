<style id="of_style_admin">
	<?php
		$curr_colors = get_user_option('admin_color');

		$colors_array = array(
			'fresh' => array(
				'link' => '#fff',
				'link_active' => '#fff',
				'bg' => '#222',
				'bg_2' => '#333',
				'col' => '#0074a2',
				'col_2' => '#2ea2cc',
				'base' => '#999',
				'focus' => '#2ea2cc',
				'current' => '#fff'
			),
			'light' => array(
				'link' => '#333',
				'link_active' => '#fff',
				'bg' => '#d64e07',
				'bg_2' => '#e5e5e5',
				'col' => '#999',
				'col_2' => '#04a4cc',
				'base' => '#999',
				'focus' => '#ccc',
				'current' => '#ccc'
			),
			'blue' => array(
				'link' => '#fff',
				'link_active' => '#fff',
				'bg' => '#4796b3',
				'bg_2' => '#52accc',
				'col' => '#096484',
				'col_2' => '#74B6CE',
				'base' => '#e5f8ff',
				'focus' => '#fff',
				'current' => '#fff'
			),
			'coffee' => array(
				'link' => '#fff',
				'link_active' => '#fff',
				'bg' => '#46403c',
				'bg_2' => '#59524c',
				'col' => '#c7a589',
				'col_2' => '#9ea476',
				'base' => '#f3f2f1',
				'focus' => '#fff',
				'current' => '#fff'
			),
			'ectoplasm' => array(
				'link' => '#fff',
				'link_active' => '#fff',
				'bg' => '#413256',
				'bg_2' => '#523f6d',
				'col' => '#a3b745',
				'col_2' => '#d46f15',
				'base' => '#ece6f6',
				'focus' => '#fff',
				'current' => '#fff'
			),
			'midnight' => array(
				'link' => '#fff',
				'link_active' => '#fff',
				'bg' => '#25282b',
				'bg_2' => '#363b3f',
				'col' => '#e14d43',
				'col_2' => '#69a8bb',
				'base' => '#f1f2f3',
				'focus' => '#fff',
				'current' => '#fff'
			),
			'ocean' => array(
				'link' => '#fff',
				'link_active' => '#fff',
				'bg' => '#627c83',
				'bg_2' => '#738e96',
				'col' => '#9ebaa0',
				'col_2' => '#aa9d88',
				'base' => '#f2fcff',
				'focus' => '#fff',
				'current' => '#fff'
			),
			'sunrise' => array(
				'link' => '#fff',
				'link_active' => '#fff',
				'bg' => '#b43c38',
				'bg_2' => '#cf4944',
				'col' => '#dd823b',
				'col_2' => '#ccaf0b',
				'base' => '#f3f1f1',
				'focus' => '#fff',
				'current' => '#fff'
			)
		);

	?>
	#of_container #of-nav a,
	#of_container .of-info a,
	#of_container .support,
	#of_container .support a {
		color:<?php echo $colors_array[$curr_colors]['col']; ?>;
	}
	#of_container a:hover {
		color:<?php echo $colors_array[$curr_colors]['col_2']; ?>;
	}
	#of_container #of-nav > ul > li {
		background-color:<?php echo $colors_array[$curr_colors]['bg']; ?>;
	}
	#of_container #of-nav > ul > li li {
		background-color:<?php echo $colors_array[$curr_colors]['bg_2']; ?>;
	}
	#of_container .parent-group.current > a:after {
		border-top-color:<?php echo $colors_array[$curr_colors]['bg']; ?>;
	}
	#of_container .parent-group.current > a:hover:after {
		border-top-color:<?php echo $colors_array[$curr_colors]['col']; ?>;
	}
	#of_container #of-nav > ul > li:first-child {
		background-color:<?php echo $colors_array[$curr_colors]['col']; ?>;
	}
	#of_container #of-nav li a {
		color:<?php echo $colors_array[$curr_colors]['link']; ?>;
	}
	#of_container #of-nav li a:hover {
		background-color:<?php echo $colors_array[$curr_colors]['col']; ?>;
		color:<?php echo $colors_array[$curr_colors]['link_active']; ?>;
	}
	#of_container #of-nav li.current a {
		color:<?php echo $colors_array[$curr_colors]['link_active']; ?>;
	}
	#of-main-nav {
		background-color:<?php echo $colors_array[$curr_colors]['bg_2']; ?>;
	}
	#of_container .of-lo .of-lo-element.active,
	#of_container .of-lo .of-lo-element:hover {
		box-shadow:0 0 3pt 2pt <?php echo $colors_array[$curr_colors]['col']; ?>;
	}
</style>
<div class="wrap" id="of_container">

	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save"><?php _e('Options Updated', 'snpshpwp'); ?></div>
	</div>
	
	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset"><?php _e('Options Reset', 'snpshpwp'); ?></div>
	</div>
	
	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail"><?php _e('Error!', 'snpshpwp'); ?></div>
	</div>

	<div id="of-popup-install" class="of-save-popup">
		<div class="of-save-install"><?php _e('Installing Demo Content. Please Wait!', 'snpshpwp'); ?></div>
	</div>
	
	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
	
		<div id="header">
		
			<div class="logo">
				<h2>SNAPSHOP <small>/ <?php echo ('v'. THEMEVERSION); ?></small></h2>
			</div>
			<div class="support"><?php _e('Need support for the SNAPSHOP theme? Please visit our forum at this link!', 'snpshpwp'); ?> <a href="http://support.shindiristudio.com/" target="_blank">http://support.shindiristudio.com/</a></div>
			<div id="js-warning"><?php _e('Warning- This options panel will not work properly without javascript!', 'snpshpwp'); ?></div>
			<div class="clear"></div>
		
		</div>

		<div id="main">

			<div id="of-nav">
				<ul>
					<li id="snpshpwp_admin_logo" style="display:block !important"><a href="#"><?php _e('Snapshop Menu', 'snpshpwp'); ?></a></li>
					<?php echo $options_machine->Menu ?>
					<div class="clear"></div>
				</ul>
			</div>

			<div id="content">
				<?php echo $options_machine->Inputs ?>
				<div class="save_bar"> 
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
					<button id ="of_save" type="button" class="of-button"><?php _e('Save All Changes', 'snpshpwp');?></button>			
					<button id ="of_reset" type="button" class="of-button reset-button"><?php _e('Reset All Options', 'snpshpwp');?></button>
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
					<div class="clear"></div>
				</div>
				<div class="smof_footer_info">by br0 / Developed and designed by <a href="http://www.shindiristudio.com/">Shindiri Studio</a> and <a href="http://www.mihajlovicnenad.com/">Mihajlovicnenad.com</a></div>
			</div>

			<div class="clear"></div>
			
		</div>
		


	</form>

	<div style="clear:both;"></div>

</div><!--wrap-->
