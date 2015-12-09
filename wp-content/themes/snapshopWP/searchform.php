<?php
/**
 * @package WordPress
 * @subpackage SnapShopWP Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
?>
<div class="snpshpwp_srch">
<a id="snpshpwp_srch_trggr" href="#"><i class="snpshp-wp-search"></i></a>
<form action="<?php echo home_url( '/' ); ?>" method="get">
	<div class="snpshpwp_srch_bx">
		<input class="snpshpwp_srch_inpt snpshpwp_inpt" name="s" type="text" value="<?php _e('Search the website', 'snpshpwp'); ?>" />
		<button type="submit"  class="snpshpwp_srch_sbmt" value="Submit"><i class="snpshp-wp-search"></i></button>
		<div class="clearfix"></div>
	</div>
</form>
</div>