<?php
/**
 * Share feature - main page
 * 
 * @subpackage share
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Share' ) ) :

class HT_CTC_Share {

    public function __construct() {
        // $this->share();
    }

    public function share() {
        
        $options = get_option('ht_ctc_share');
        $othersettings = get_option('ht_ctc_othersettings');

        $ht_ctc_share = array();
        $ht_ctc_os = array();

        // share text
        $ht_ctc_share['share_text'] = esc_attr( $options['share_text'] );
        $ht_ctc_share['share_text'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_share['share_text'], 'Click to Chat for WhatsApp', 'share_text__share' );

        // return if share text is blank
        if ( '' == $ht_ctc_share['share_text'] ) {
            return;
        }

        // show/hide
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/show-hide.php';

        if ( 'no' == $display ) {
            return;
        }

        // position
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/position-to-place.php';
        $ht_ctc_share['position'] = $position;
        $ht_ctc_share['position_mobile'] = $position_mobile;

        // is mobile to select styles
        $is_mobile = ht_ctc()->device_type->is_mobile();

        // style
        $ht_ctc_share['style_d'] = esc_attr( $options['style_desktop'] );
        $ht_ctc_share['style_m'] = esc_attr( $options['style_mobile'] );
        if ( 'yes' == $is_mobile ) {
            $ht_ctc_share['style'] = $ht_ctc_share['style_m'];
        } else {
            $ht_ctc_share['style'] = $ht_ctc_share['style_d'];
        }

        $ht_ctc_share['type'] = "share";

        // call to action
        $ht_ctc_share['call_to_action'] = esc_html( $options['call_to_action'] );
        $ht_ctc_share['call_to_action'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_share['call_to_action'], 'Click to Chat for WhatsApp', 'call_to_action__share' );

        // class names
        $ht_ctc_share['class_names'] = " ht-ctc ht-ctc-share ";

        $page_url = get_permalink();
        $post_title = esc_html( get_the_title() );

        // if ( is_home() || is_front_page() ) {
        if ( is_home() ) {
            $page_url = get_bloginfo('url');
            $post_title = HT_CTC_BLOG_NAME;
        }

        $ht_ctc_share['share_text'] = str_replace( array('{{url}}', '{url}', '{{title}}', '{title}', '{{site}}', '{site}' ),  array( $page_url, $page_url, $post_title, $post_title, HT_CTC_BLOG_NAME, HT_CTC_BLOG_NAME ), $ht_ctc_share['share_text'] );

        // webapi: web/api.whatsapp,  api: api.whatsapp
        $ht_ctc_share['webandapi'] = 'api';
        if ( isset( $options['webandapi'] ) ) {
            $ht_ctc_share['webandapi'] = 'webapi';
        }

        $ht_ctc_share['display_mobile'] = (isset($options['hideon_mobile'])) ? 'hide' : 'show';
        $ht_ctc_share['display_desktop'] = (isset($options['hideon_desktop'])) ? 'hide' : 'show';

        $ht_ctc_share['css'] = "display: none; cursor: pointer; z-index: 99999999;";

        // analytics
        $ht_ctc_os['is_ga_enable'] = 'yes';
        $ht_ctc_os['is_fb_pixel'] = 'yes';
        $ht_ctc_os['is_fb_an_enable'] = 'yes';
        // show effect
        $ht_ctc_os['show_effect'] = '';
        $ht_ctc_os['data-attributes'] = '';

        // hooks
        $ht_ctc_share = apply_filters( 'ht_ctc_fh_share', $ht_ctc_share );
        $ht_ctc_os = apply_filters( 'ht_ctc_fh_os', $ht_ctc_os );

        // @uses at styles / easy call (after filter hook)
        $style = $ht_ctc_share['style'];
        $style_d = $ht_ctc_share['style_d'];
        $style_m = $ht_ctc_share['style_m'];
        $type = $ht_ctc_share['type'];
        $call_to_action = $ht_ctc_share['call_to_action'];
        
        $ht_ctc_share['class_names'] .= " style-$style ";

        if ( '' == $call_to_action ) {
            if ( '1' == $style || '4' == $style || '6' == $style || '8' == $style ) {
                $call_to_action = "WhatsApp Share";
            }
        }

        // call style
        $path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style. '.php';

        $path_d = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_d. '.php';
        $path_m = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_m. '.php';


        if ( is_file( $path ) ) {
            do_action('ht_ctc_ah_before_fixed_position');
            // onclick="ht_ctc_share_click(this);"
            ?>
            <div class="<?php echo $ht_ctc_share['class_names'] ?>" 
                style="display: none;"
                data-return_type="<?php echo $ht_ctc_share['type'] ?>" 
                data-share_text="<?php echo $ht_ctc_share['share_text'] ?>" 
                data-is_ga_enable="<?php echo $ht_ctc_os['is_ga_enable'] ?>" 
                data-is_fb_pixel="<?php echo $ht_ctc_os['is_fb_pixel'] ?>" 
                data-is_fb_an_enable="<?php echo $ht_ctc_os['is_fb_an_enable'] ?>" 
                data-webandapi="<?php echo $ht_ctc_share['webandapi'] ?>" 
                data-display_mobile="<?php echo $ht_ctc_share['display_mobile'] ?>" 
                data-display_desktop="<?php echo $ht_ctc_share['display_desktop'] ?>" 
                data-css="<?php echo $ht_ctc_share['css'] ?>" 
                data-position="<?php echo $ht_ctc_share['position'] ?>" 
                data-position_mobile="<?php echo $ht_ctc_share['position_mobile'] ?>" 
                data-show_effect="<?php echo $ht_ctc_os['show_effect'] ?>" 
                <?php echo $ht_ctc_os['data-attributes'] ?>  
                >
                <?php 
                if ( isset( $othersettings['select_styles_issue'] ) ) {
                    ?>
                    <div class="ht_ctc_desktop_share"><?php include $path_d; ?></div>
                    <div class="ht_ctc_mobile_share"><?php include $path_m; ?></div>
                    <?php
                } else {
                    include $path;
                }
                ?>
            </div>
            <?php
            do_action('ht_ctc_ah_after_fixed_position');
        }

        
    }

}

// new HT_CTC_Share();

$ht_ctc_share = new HT_CTC_Share();
add_action( 'wp_footer', array( $ht_ctc_share, 'share' ) );


endif; // END class_exists check