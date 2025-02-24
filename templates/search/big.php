<?php
/*
 * @Theme Name:One Nav
 * @Theme URI:https://www.iotheme.cn/
 * @Author: iowen
 * @Author URI: https://www.iowen.cn/
 * @Date: 2021-03-01 10:19:07
 * @LastEditors: iowen
 * @LastEditTime: 2023-04-04 00:14:59
 * @FilePath: \onenav\templates\search\big.php
 * @Description: 
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } 
// 搜索列表请到 inc\search-list.php 文件修改
$search_list = get_search_list();
$search_skin = io_get_option('search_skin',array());
?> 
<div class="s-search">
<div id="search" class="s-search mx-auto">
    <?php if($bm_route = get_query_var('bookmark_id')){ 
        global $bookmark_id,$bookmark_user,$bookmark_set;
        $big_title = get_bookmark_seting('sites_title',$bookmark_set);
        if($big_title!='' && get_bookmark_seting('hide_title',$bookmark_set)){
    ?>
    <div class="big-title text-center mb-3 mb-md-5 mt-2">
        <p class="h1" style="letter-spacing: 6px;"><?php echo $big_title ?></p>
    </div>
    <?php }
    }elseif($search_skin['big_title']){ 
    ?>
    <div class="big-title text-center mb-3 mb-md-5 mt-2">
        <h2 class="h1" style="letter-spacing: 6px;"><?php echo _iol($search_skin['big_title']) ?></h2>
    </div>
    <?php } ?>
    <div id="search-list-menu" class="">
        <div class="s-type text-center">
            <div class="s-type-list big tab-auto-scrollbar overflow-x-auto">
                <div class="anchor" style="position: absolute; left: 50%; opacity: 0;"></div>
                <?php 
                $index=0; 
                if($search_skin['search_station']){
                    echo '<label for="type-big-zhannei" class="active" data-page="'.$search_list['id'].'" data-id="group-z"><span>'. __('站内','i_theme') .'</span></label>';
                    $index=1; 
                }
                if (isset($search_list['list']) && !empty($search_list['list'])) {
                    foreach ($search_list['list'] as $value) {
                        echo '<label for="' . $value['default'] . '" ' . ($index == 0 ? 'class="active"' : '') . ' data-page="' . $search_list['id'] . '" data-id="' . $value['id'] . '"><span>' . $value['name'] . '</span></label>';
                        $index++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <form action="<?php echo esc_url(home_url()) ?>?s=" method="get" target="_blank" class="super-search-fm">
        <input type="text" id="search-text" class="form-control smart-tips search-key" zhannei="" placeholder="<?php _e( '输入关键字搜索', 'i_theme' ); ?>" style="outline:0" autocomplete="off" data-status="true">
        <button type="submit" id="btn_search"><i class="iconfont icon-search"></i></button>
    </form> 
    <div id="search-list" class="hide-type-list">
        <?php 
        $i=0;
        if($search_skin['search_station']){
            ?>
            <div class="search-group justify-content-center group-z s-current">
                <ul class="search-type tab-auto-scrollbar overflow-x-auto">
                    <li ><input checked="checked" hidden="" type="radio" name="type" data-page="<?php echo $search_list['id'] ?>" id="type-big-zhannei" value="<?php echo esc_url(home_url()) ?>/?post_type=<?php echo key(io_get_option('search_page_post',array('enabled'=>array('sites'=>'网址')))['enabled']) ?>&amp;s=" data-placeholder="<?php _e('站内搜索','i_theme') ?>"></li>
                    <?php wp_menu("search_menu");$i=1; ?>
                </ul>
            </div>
            <?php
            $i=1; 
        }
        ?>
        <?php
        if (isset($search_list['list']) && !empty($search_list['list'])) {
            foreach ($search_list['list'] as $value) {
                echo '<div class="search-group justify-content-center ' . $value['id'] . ' ' . ($i == 0 ? 's-current' : '') . '">';
                echo '<ul class="search-type tab-auto-scrollbar overflow-x-auto">';
                foreach ($value['list'] as $s) {
                    if ($i == 0 && $s['id'] == $value['default'])
                        echo '<li><input checked="checked" hidden type="radio" name="type" data-page="' . $search_list['id'] . '" id="' . $s['id'] . '" value="' . $s['url'] . '" data-placeholder="' . $s['placeholder'] . '"><label for="' . $s['id'] . '"><span class="text-muted">' . $s['name'] . '</span></label></li>';
                    else
                        echo '<li><input hidden type="radio" name="type" data-page="' . $search_list['id'] . '" id="' . $s['id'] . '" value="' . $s['url'] . '" data-placeholder="' . $s['placeholder'] . '"><label for="' . $s['id'] . '"><span class="text-muted">' . $s['name'] . '</span></label></li>';
                }
                echo '</ul>';
                echo '</div>';
                $i++;
            }
        } ?>
    </div>
    <div class="card search-smart-tips" style="display: none">
        <ul></ul>
    </div>
</div>
</div>
