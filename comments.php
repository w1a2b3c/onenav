<?php
/*
 * @Author: iowen
 * @Author URI: https://www.iowen.cn/
 * @Date: 2021-06-03 08:55:57
 * @LastEditors: iowen
 * @LastEditTime: 2023-04-23 23:02:19
 * @FilePath: \onenav\comments.php
 * @Description: 
 */
/*
 * 如果当前帖子受密码保护，而访问者尚未输入密码，将不加载评论。
 */
if ( post_password_required() ) {
	return;
}
?>

<!-- comments -->
<?php  
show_ad('ad_comments_top',false, '<div class="post-apd mt-4">' , '</div>'); 
if(io_get_option('nav_comment',false)){
?>
<div id="comments" class="comments">
	<h2 id="comments-list-title" class="comments-title h5 mx-1 my-4">
		<i class="iconfont icon-comment"></i>
		<span class="noticom">
			<?php comments_popup_link(__('暂无评论','i_theme'), __('1 条评论','i_theme'), __('% 条评论','i_theme'),'comments-title'); ?> 
		</span>
	</h2> 
	<div class="card">
		<div class="card-body"> 
			<?php if(comments_open() != false) {?>
			<div id="respond_box">
				<div id="respond" class="comment-respond">
					<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
					<div class="rounded bg-light text-center p-4 mb-4">
						<div class="text-muted text-sm mb-2"><?php _e('您必须登录才能参与评论！','i_theme') ?></div>
						<a class="btn btn-light btn-sm btn-rounded" href="<?php echo esc_url(wp_login_url( urlencode(get_permalink()) )) ?>"><?php _e('立即登录','i_theme') ?></a>
					</div>
					<?php else : ?>
					<form id="commentform" class="text-sm mb-4">	
						<div class="visitor-avatar d-flex flex-fill mb-2">
							<?php if ( is_user_logged_in() )://判断是否登录，获取admin头像 ?>
							<?php global $current_user;wp_get_current_user(); ?>
							<?php echo get_avatar($current_user->user_email, 64,'',$current_user->display_name, array('class'=>'v-avatar'))  ?>	
							<p class="loginby ml-2" style="line-height: 32px;"><a href="<?php echo get_option('siteurl'); ?>/author/<?php echo $current_user->ID ?>"><?php echo $current_user->display_name; ?></a>&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('退出','i_theme') ?>">[ <?php _e( '退出','i_theme') ?> ]</a></p>
							<?php elseif($comment_author_email): ?>	
								<?php echo get_avatar($comment_author_email, 64,'',$comment_author, array('class'=>'v-avatar')) ?>
								<p class="loginby ml-2" style="line-height: 32px;"><?php echo $comment_author; ?></p>
							<?php else: ?>
							<img class="v-avatar rounded-circle" src="<?php echo  get_theme_file_uri('/images/gravatar.jpg') ?>">
							<?php endif; ?>
						</div> 
						<div class="comment-textarea mb-3">
							<textarea name="comment" id="comment" class="form-control" placeholder="<?php _e('输入评论内容...','i_theme') ?>" tabindex="4" cols="50" rows="3"></textarea>
						</div>
						<?php if ( ! is_user_logged_in() ): ?>	
						<div id="comment-author-info" class="row  row-sm">
							<div class="col-12 col-md-6 mb-3"><input type="text" name="author" id="author" class="form-control" value="<?php echo $comment_author; ?>" size="22" placeholder="<?php _e('昵称','i_theme') ?>" tabindex="2"/></div>	
							<div class="col-12 col-md-6 mb-3"><input type="text" name="email" id="email" class="form-control" value="<?php echo $comment_author_email; ?>" size="22" placeholder="<?php _e('邮箱','i_theme') ?>" tabindex="3" /></div>
						</div>
						<?php endif; ?>
						<?php do_action('comment_form', $post->ID); ?>
						<div class="com-footer d-flex justify-content-end flex-wrap">
							<?php wp_nonce_field('comment_ticket'); ?>
							<a rel="nofollow" id="cancel-comment-reply-link" style="display: none;" href="javascript:;" class="btn btn-light custom_btn-outline mx-2"><?php _e('再想想','i_theme') ?></a>
							<?php echo get_captcha_input_html('ajax_comment') ?>
							<button class="btn btn-dark custom_btn-d ml-2" type="submit" id="submit"><?php _e('发表评论','i_theme') ?></button>
							<input type="hidden" name="action" value="ajax_comment"/>
							<?php comment_id_fields(); ?>
						</div>
					</form>
					<div class="clear"></div>
					<?php endif; ?>
				</div>
			</div>	
			<?php } else { ?>
			<div class="commclose card  mb-4"><div class="card-body text-center color-d"><?php _e('评论已关闭...','i_theme') ?></div></div>
			<?php } ?>
			<div id="loading-comments"><span></span></div>
			<?php if(have_comments()) { ?>
			<ul class="comment-list">
				<?php wp_list_comments('type=comment&callback=io_comment_default_format&max_depth=10000'); ?>	
			</ul>
				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
				<nav id="comments-navi"  class="text-center my-3">
				<?php paginate_comments_links('prev_text=<i class="iconfont icon-arrow-l"></i>&next_text=<i class="iconfont icon-arrow-r"></i>');?>
				</nav>	
				<?php } ?>
			<?php }else { ?>
			<div class="not-comment card"><div class="card-body nothing text-center color-d"><?php _e('暂无评论...','i_theme') ?></div></div>
			<?php } ?>		
		</div>	
	</div>
</div><!-- comments end -->
<?php } ?>
