<?php
/*
Name: Snpshpwp Menu Items
URI:
Description:
Version:
Author:
Author URI:
License:
*/

	/**
	 * Hook da stuff!
	 */
	add_action( 'wp_edit_nav_menu_walker', 'snpshpwp_edit_nav_menu_walker' );
	add_action( 'wp_update_nav_menu_item', 'snpshpwp_update_nav_menu_item', 10, 3 );


	
	/**
	 * Change the admin menu walker class name.
	 * @param string $walker
	 * @return string
	 */
	function snpshpwp_edit_nav_menu_walker( $walker ) {

		if ( !class_exists( "Snpshpwp_Walker_Nav_Menu_Edit" ) && class_exists( 'Walker_Nav_Menu_Edit' ) ):

		class Snpshpwp_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
			
			
			function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {

				// append next menu element to $output
				parent::start_el($output, $object, $depth, $args, $current_object_id);
				
				
				// now let's add a custom form field
				
				if ( ! class_exists( 'phpQuery') ) {
					// load phpQuery at the last moment, to minimise chance of conflicts (ok, it's probably a bit too defensive)
					require_once 'phpQuery-onefile.php';
				}
				
				$_doc = phpQuery::newDocumentHTML( $output );
				$_li = phpQuery::pq( 'li.menu-item:last' ); // ":last" is important, because $output will contain all the menu elements before current element
				
				// if the last <li>'s id attribute doesn't match $item->ID something is very wrong, don't do anything
				// just a safety, should never happen...
				$menu_item_id = str_replace( 'menu-item-', '', $_li->attr( 'id' ) );
				if( $menu_item_id != $object->ID ) {
					return;
				}
				
				// fetch previously saved meta for the post (menu_item is just a post type)
				$curr_bg = esc_attr( get_post_meta( $menu_item_id, 'snpshpwp_menu_item_bg', TRUE ) );
				$curr_bg_pos = esc_attr( get_post_meta( $menu_item_id, 'snpshpwp_menu_item_bg_pos', TRUE ) );


				$curr_upldr = '<span class="button media_upload_button" id="snpshpwp_upload_'.$menu_item_id.'">'.__('Upload', 'snpshpwp').'</span>';

				// by means of phpQuery magic, inject a new input field
				$_li->find( 'a.item-delete' )
					->before( "
					<p class='snpshpwp_menu_item_bg description description-thin'>
					<label for='snpshpwp_menu_item_bg_$menu_item_id'>".__('Background image', 'snpshpwp')."<br/>
					<input type='text' value='$curr_bg' name='snpshpwp_menu_item_bg_$menu_item_id' /><br/>
					</label>
					$curr_upldr
					</p>
					<p class='snpshpwp_menu_item_bg_pos description description-thin'>
					<label for='snpshpwp_menu_item_bg_$menu_item_id'>".__('Background orientation', 'snpshpwp')."<br/>
					<select name='snpshpwp_menu_item_bg_pos_$menu_item_id'>
						<option value='left-landscape'".( $curr_bg_pos == 'left-landscape' ? ' selected' : '' ).">".__('Left Landscape', 'snpshpwp')."</option>
						<option value='left-portraid'".( $curr_bg_pos == 'left-portraid' ? ' selected' : '' ).">".__('Left Portraid', 'snpshpwp')."</option>
						<option value='right-landscape'".( $curr_bg_pos == 'right-landscape' ? ' selected' : '' ).">".__('Right Landscape', 'snpshpwp')."</option>
						<option value='right-portraid'".( $curr_bg_pos == 'right-portraid' ? ' selected' : '' ).">".__('Right Portraid', 'snpshpwp')."</option>
						<option value='pattern-repeat'".( $curr_bg_pos == 'pattern-repeat' ? ' selected' : '' ).">".__('Pattern', 'snpshpwp')."</option>
						<option value='framed-full'".( $curr_bg_pos == 'framed-full' ? ' selected' : '' ).">".__('Framed', 'snpshpwp')."</option>
					</select>
					</label>
					</p>
					" );
				
				// swap the $output
				$output = $_doc->html();
				
			}

		}

		endif;
		
		// swap the menu walker class only if it's the default wp class (just in case)
		if ( $walker === 'Walker_Nav_Menu_Edit' ) {
			$walker = 'Snpshpwp_Walker_Nav_Menu_Edit';
		}
		return $walker;
	}

	
	/**
	 * Save post meta. Menu items are just posts of type "menu_item".
	 * 
	 * 
	 * @param type $menu_id
	 * @param type $menu_item_id
	 * @param type $args
	 */
	function snpshpwp_update_nav_menu_item($menu_id, $menu_item_id, $args) {
		
		if ( isset( $_POST[ "snpshpwp_menu_item_bg_$menu_item_id" ] ) ) {
			update_post_meta( $menu_item_id, 'snpshpwp_menu_item_bg', $_POST[ "snpshpwp_menu_item_bg_$menu_item_id" ] );
			update_post_meta( $menu_item_id, 'snpshpwp_menu_item_bg_pos', $_POST[ "snpshpwp_menu_item_bg_pos_$menu_item_id" ] );
		} else {
			#mfmfmf("DEL");
			delete_post_meta( $menu_item_id, 'snpshpwp_menu_item_bg_pos' );
		}
	}

?>