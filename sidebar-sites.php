<?php
/*
 * @Theme Name:One Nav
 * @Theme URI:https://www.iotheme.cn/
 * @Author: iowen
 * @Author URI: https://www.iowen.cn/
 * @Date: 2021-07-15 00:43:42
 * @LastEditors: iowen
 * @LastEditTime: 2022-06-25 22:34:11
 * @FilePath: \onenav\sidebar-sites.php
 * @Description: 
 */ 
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (io_is_show_sidebar()==" sidebar_no" || wp_is_mobile()) return; 
?>
<?php if ( is_active_sidebar( 'sidebar-sites-r' ) ) : ?> 
	<div class="sidebar sidebar-tools d-none d-lg-block">
		<?php  dynamic_sidebar( 'sidebar-sites-r' ) ?> 
	</div>
<?php endif; ?>
