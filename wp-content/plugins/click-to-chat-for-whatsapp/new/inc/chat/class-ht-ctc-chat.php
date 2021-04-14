<?php
/**
 * WhatsApp Chat  - main page .. 
 * 
 * @subpackage chat
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Chat' ) ) :

class HT_CTC_Chat {

    public function chat() {
        
        $options = get_option('ht_ctc_chat_options');
        $othersettings = get_option('ht_ctc_othersettings');

        $ht_ctc_chat = array();
        $ht_ctc_os = array();

        // show/hide
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/show-hide.php';

        if ( 'no' == $display ) {
            return;
        }
        
        // position
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/position-to-place.php';
        $ht_ctc_chat['position'] = $position;
        $ht_ctc_chat['position_mobile'] = $position_mobile;
        
        // is mobile
        $is_mobile = ht_ctc()->device_type->is_mobile();

        $wp_device = '';

        // style
        $ht_ctc_chat['style_d'] = esc_attr( $options['style_desktop'] );
        $ht_ctc_chat['style_m'] = esc_attr( $options['style_mobile'] );
        if ( 'yes' == $is_mobile ) {
            $ht_ctc_chat['style'] = $ht_ctc_chat['style_m'];
            $wp_device = 'ctc_wp_mobile';
        } else {
            $ht_ctc_chat['style'] = $ht_ctc_chat['style_d'];
            $wp_device = 'ctc_wp_desktop';
        }

        $ht_ctc_chat['type'] = "chat";

        $page_id = get_the_ID();
        $page_url = get_permalink();
        $post_title = esc_html( get_the_title() );

		do_action('ht_ctc_ah_previous_metabox');	

        // page level
        $ht_ctc_pagelevel = get_post_meta( $page_id, 'ht_ctc_pagelevel', true );

        // Number
        $ht_ctc_chat['number'] = (isset($ht_ctc_pagelevel['number'])) ? esc_attr($ht_ctc_pagelevel['number']) : esc_attr( $options['number'] );
        $ht_ctc_chat['number'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['number'], 'Click to Chat for WhatsApp', 'number' );

        // call to action
        $ht_ctc_chat['call_to_action'] = (isset($ht_ctc_pagelevel['call_to_action'])) ? esc_attr($ht_ctc_pagelevel['call_to_action']) : __( esc_attr( $options['call_to_action'] ) , 'click-to-chat-for-whatsapp' );
        $ht_ctc_chat['call_to_action'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['call_to_action'], 'Click to Chat for WhatsApp', 'call_to_action' );

        // prefilled text
        $ht_ctc_chat['pre_filled'] = esc_attr( $options['pre_filled'] );
        $ht_ctc_chat['pre_filled'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['pre_filled'], 'Click to Chat for WhatsApp', 'pre_filled' );

        // webapi: web/api.whatsapp,  wa: wa.me
        $ht_ctc_chat['webandapi'] = 'wa';
        if ( isset( $options['webandapi'] ) ) {
            $ht_ctc_chat['webandapi'] = 'webapi';
        }

        $ht_ctc_chat['display_mobile'] = (isset($options['hideon_mobile'])) ? 'hide' : 'show';
        $ht_ctc_chat['display_desktop'] = (isset($options['hideon_desktop'])) ? 'hide' : 'show';

        // number not added and is administrator
        $no_number = "added";
        $admin_url = admin_url( 'admin.php?page=click-to-chat' );
        $admin_link = "<a href='$admin_url'>WhatsApp number</a>";

        if ( '' == $ht_ctc_chat['number'] ) {
            $no_number = "<p style='background-color: #ffffff; margin:0; border: 1px solid #fbfbfb; padding:7px; border-radius:4px; box-shadow: 5px 10px 8px #888888;'>No WhatsApp Number Found!</p>";
            if ( current_user_can('administrator') ) {
                $no_number = "<p style='background-color: #ffffff; margin:0; border: 1px solid #fbfbfb; padding:11px; border-radius:4px; box-shadow: 5px 10px 8px #888888;'>No WhatsApp Number Found!<br><small style='color: red;'>Admin Notice:<br></small><small>Add $admin_link at pluign Settings<br>If already added, <strong>clear the Cache</strong> and try.<br>If still an issue, please contact plugin developers</small></p>";
                
            }
        }

        // class names
        $ht_ctc_chat['class_names'] = "ht-ctc ht-ctc-chat $wp_device ctc-analytics ";

        $ht_ctc_chat['css'] = "display: none; cursor: pointer; z-index: 99999999;";

        // analytics
        $ht_ctc_os['is_ga_enable'] = 'yes';
        $ht_ctc_os['is_fb_pixel'] = 'yes';
        $ht_ctc_os['is_fb_an_enable'] = 'yes';
        // show effect
        $ht_ctc_os['show_effect'] = '';
        $ht_ctc_os['data-attributes'] = '';

        // hooks
        $ht_ctc_chat = apply_filters( 'ht_ctc_fh_chat', $ht_ctc_chat );
        $ht_ctc_os = apply_filters( 'ht_ctc_fh_os', $ht_ctc_os );

        // pre-filled  - have to run after filter hook. 
        $ht_ctc_chat['pre_filled'] = str_replace( array('{{url}}', '{url}', '{{title}}', '{title}', '{{site}}', '{site}' ),  array( $page_url, $page_url, $post_title, $post_title, HT_CTC_BLOG_NAME, HT_CTC_BLOG_NAME ), $ht_ctc_chat['pre_filled'] );

        // Fallback support - js will override this css
        $backend_position = $ht_ctc_chat['position'];

        // @uses at styles / easy call (after filter hook)
        $style = $ht_ctc_chat['style'];
        $style_d = $ht_ctc_chat['style_d'];
        $style_m = $ht_ctc_chat['style_m'];
        $type = $ht_ctc_chat['type'];
        $call_to_action = $ht_ctc_chat['call_to_action'];

        $ht_ctc_chat['class_names'] .= " style-$style ";

        // call style
        $path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style. '.php';

        $path_d = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_d. '.php';
        $path_m = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_m. '.php';

        
        if ( '' == $call_to_action ) {
            if ( '1' == $style || '4' == $style || '6' == $style || '8' == $style ) {
                $call_to_action = "WhatsApp us";
            }
        }



        if ( is_file( $path ) ) {
            do_action('ht_ctc_ah_before_fixed_position');
            ?>  
            <div onclick="ht_ctc_click(this);" class="<?php echo $ht_ctc_chat['class_names'] ?>" 
                style="display: none; <?php echo $backend_position ?>"
                data-return_type="<?php echo $ht_ctc_chat['type'] ?>" 
                data-style="<?php echo $ht_ctc_chat['style'] ?>" 
                data-number="<?php echo $ht_ctc_chat['number'] ?>" 
                data-pre_filled="<?php echo $ht_ctc_chat['pre_filled'] ?>" 
                data-is_ga_enable="<?php echo $ht_ctc_os['is_ga_enable'] ?>" 
                data-is_fb_pixel="<?php echo $ht_ctc_os['is_fb_pixel'] ?>" 
                data-is_fb_an_enable="<?php echo $ht_ctc_os['is_fb_an_enable'] ?>" 
                data-webandapi="<?php echo $ht_ctc_chat['webandapi'] ?>" 
                data-display_mobile="<?php echo $ht_ctc_chat['display_mobile'] ?>" 
                data-display_desktop="<?php echo $ht_ctc_chat['display_desktop'] ?>" 
                data-css="<?php echo $ht_ctc_chat['css'] ?>" 
                data-position="<?php echo $ht_ctc_chat['position'] ?>" 
                data-position_mobile="<?php echo $ht_ctc_chat['position_mobile'] ?>" 
                data-show_effect="<?php echo $ht_ctc_os['show_effect'] ?>" 
                data-no_number="<?php echo $no_number ?>" 
                <?php echo $ht_ctc_os['data-attributes'] ?>
                >
                <?php
                if ( isset( $othersettings['select_styles_issue'] ) ) {
                    ?>
                    <div class="ht_ctc_desktop_chat"><?php include $path_d; ?></div>
                    <div class="ht_ctc_mobile_chat"><?php include $path_m; ?></div>
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

// new HT_CTC_Chat();

$ht_ctc_chat = new HT_CTC_Chat();

// wp_footer / wp_head / get_footer
$ht_ctc_chat_load_position = apply_filters( 'ht_ctc_chat_load_position', 'wp_footer' );

add_action( "$ht_ctc_chat_load_position", array( $ht_ctc_chat, 'chat' ) );

endif; // END class_exists check