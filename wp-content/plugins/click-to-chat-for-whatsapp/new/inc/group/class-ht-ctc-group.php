<?php
/**
 * Group chat/invite feature - main page
 * 
 * @subpackage group
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Group' ) ) :

class HT_CTC_Group {

    public function __construct() {
        // $this->group();
    }

    public function group() {
        
        $options = get_option('ht_ctc_group');
        $othersettings = get_option('ht_ctc_othersettings');

        $ht_ctc_group = array();
        $ht_ctc_os = array();

        // show/hide
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/show-hide.php';

        if ( 'no' == $display ) {
            return;
        }

        // position
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/position-to-place.php';
        $ht_ctc_group['position'] = $position;
        $ht_ctc_group['position_mobile'] = $position_mobile;

        // is mobile to select styles
        $is_mobile = ht_ctc()->device_type->is_mobile();

        // style
        $ht_ctc_group['style_d'] = esc_attr( $options['style_desktop'] );
        $ht_ctc_group['style_m'] = esc_attr( $options['style_mobile'] );
        if ( 'yes' == $is_mobile ) {
            $ht_ctc_group['style'] = $ht_ctc_group['style_m'];
        } else {
            $ht_ctc_group['style'] = $ht_ctc_group['style_d'];
        }

        $ht_ctc_group['type'] = "group";

        // call to action
        $ht_ctc_group['call_to_action'] = esc_attr( $options['call_to_action'] );
        $ht_ctc_group['call_to_action'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_group['call_to_action'], 'Click to Chat for WhatsApp', 'call_to_action__group' );

        // class names
        $ht_ctc_group['class_names'] = "ht-ctc ht-ctc-group ";

        // group id
        $ht_ctc_group['group_id'] = esc_attr( $options['group_id'] );

        // group_id - at page level
        $page_id = get_the_ID();
        $page_group_id = esc_attr( get_post_meta( $page_id, 'ht_ctc_page_group_id', true ) );

        if ( isset( $page_group_id ) && '' !== $page_group_id ){
            $group_id = $page_group_id;
        }

        $ht_ctc_group['group_id'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_group['group_id'], 'Click to Chat for WhatsApp', 'group_id__group' );

        // analytics
        $is_ga_enable = apply_filters( 'ht_ctc_fh_is_ga_enable', 'no' );
        $is_fb_pixel = apply_filters( 'ht_ctc_fh_is_fb_pixel', 'no' );
        $is_fb_an_enable = apply_filters( 'ht_ctc_fh_is_fb_an_enable', 'no' );

        $ht_ctc_group['display_mobile'] = (isset($options['hideon_mobile'])) ? 'hide' : 'show';
        $ht_ctc_group['display_desktop'] = (isset($options['hideon_desktop'])) ? 'hide' : 'show';



        $ht_ctc_group['css'] = "display: none; cursor: pointer; z-index: 99999999;";

        // analytics
        $ht_ctc_os['is_ga_enable'] = 'yes';
        $ht_ctc_os['is_fb_pixel'] = 'yes';
        $ht_ctc_os['is_fb_an_enable'] = 'yes';
        // show effect
        $ht_ctc_os['show_effect'] = '';
        $ht_ctc_os['data-attributes'] = '';

        // hooks
        $ht_ctc_group = apply_filters( 'ht_ctc_fh_group', $ht_ctc_group );
        $ht_ctc_os = apply_filters( 'ht_ctc_fh_os', $ht_ctc_os );


        // @uses at styles / easy call (after filter hook)
        $style = $ht_ctc_group['style'];
        $style_d = $ht_ctc_group['style_d'];
        $style_m = $ht_ctc_group['style_m'];
        $type = $ht_ctc_group['type'];
        $call_to_action = $ht_ctc_group['call_to_action'];
        
        $ht_ctc_group['class_names'] .= " style-$style ";

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
            ?>
            <div class="<?php echo $ht_ctc_group['class_names'] ?>" 
                style="display: none;"
                data-return_type="<?php echo $ht_ctc_group['type'] ?>" 
                data-group_id="<?php echo $ht_ctc_group['group_id'] ?>" 
                data-is_ga_enable="<?php echo $ht_ctc_os['is_ga_enable'] ?>" 
                data-is_fb_pixel="<?php echo $ht_ctc_os['is_fb_pixel'] ?>" 
                data-is_fb_an_enable="<?php echo $ht_ctc_os['is_fb_an_enable'] ?>" 
                data-display_mobile="<?php echo $ht_ctc_group['display_mobile'] ?>" 
                data-display_desktop="<?php echo $ht_ctc_group['display_desktop'] ?>" 
                data-css="<?php echo $ht_ctc_group['css'] ?>" 
                data-position="<?php echo $ht_ctc_group['position'] ?>" 
                data-position_mobile="<?php echo $ht_ctc_group['position_mobile'] ?>" 
                data-show_effect="<?php echo $ht_ctc_os['show_effect'] ?>" 
                <?php echo $ht_ctc_os['data-attributes'] ?>  
                >
                <?php 
                if ( isset( $othersettings['select_styles_issue'] ) ) {
                    ?>
                    <div class="ht_ctc_desktop_group"><?php include $path_d; ?></div>
                    <div class="ht_ctc_mobile_group"><?php include $path_m; ?></div>
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

// new HT_CTC_Group();

$ht_ctc_group = new HT_CTC_Group();
add_action( 'wp_footer', array( $ht_ctc_group, 'group' ) );


endif; // END class_exists check