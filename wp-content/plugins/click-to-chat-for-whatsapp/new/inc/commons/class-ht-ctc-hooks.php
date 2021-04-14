<?php
/**
 * Hooks
 * @since 2.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Hooks' ) ) :

class HT_CTC_Hooks {

    public $version = HT_CTC_VERSION;

    public $main_options = '';
    public $other_options = '';

    public function __construct() {
        $this->hooks();
        $this->main_options = get_option('ht_ctc_main_options');
        $this->other_options = get_option('ht_ctc_othersettings');
    }

    private function hooks() {
        // ## Action Hooks ##
        add_action( 'ht_ctc_ah_before_fixed_position', array($this, 'comment') );
        add_action( 'ht_ctc_ah_before_fixed_position', array($this, 'css_styles') );

        // if an issue with cache plugin
        // add_action( 'ht_ctc_ah_after_fixed_position', array($this, 'scripts') );

        // ## Filter Hooks ##
        add_filter( 'ht_ctc_fh_chat', array($this, 'chat_settings') );
        add_filter( 'ht_ctc_fh_load_app_js_bottom', array($this, 'load_app_js_bottom') );

        // other settings
        add_filter( 'ht_ctc_fh_os', array($this, 'other_settings') );
        
        // previous metaboxes to new
        add_action( 'ht_ctc_ah_previous_metabox', array($this, 'previous_metabox') );
        
    }

    /**
     * Action Hooks
     */

    // css styles - before fixed position
    function css_styles() {

        $othersettings = get_option('ht_ctc_othersettings');


        // display effect - if ? scale from center
        if ( isset($othersettings['show_effect']) && 'From Center' == $othersettings['show_effect'] ) {
            ?>
            <style id="ht_ctc_fromcenter">@keyframes ht_ctc_fromcenter{from{transform:scale(0);}to{transform: scale(1);}}.ht-ctc{animation: ht_ctc_fromcenter .25s;}</style>
            <?php
        }

        // Animation styles
        $an_type = ( isset( $othersettings['an_type']) ) ? esc_attr( $othersettings['an_type'] ) : '';
        
        if ( '' !== $an_type && 'no-animation' !== $an_type ) {
            include_once HT_CTC_PLUGIN_DIR .'new/inc/commons/class-ht-ctc-animations.php';
            $animations = new HT_CTC_Animations();
            $animations->animations( $an_type );
        }
        
    }
    
    // comment before floting styles
    function comment() {
        $comment = "<!-- Click to Chat - https://holithemes.com/plugins/click-to-chat/  v$this->version -->";
        echo $comment;
    }

    // scripts - after fixed position
    function scripts() {

        // autoptimize cache plugin
        // as some plugin/theme js have errors and blocks the other scripts. so added like this.
        if( class_exists('autoptimizeCache') ) {
            ?>
            <script>setTimeout(function(){try{ht_ctc_loaded();}catch(e){}},3000);</script>
            <?php
        }
    }


    /**
     * Filter Hooks
     */

     // number format
    function chat_settings( $ht_ctc_chat ) {

        // Number format
        // if random number feature, this have to modify (ltrim, preg_replace)
        // $ht_ctc_chat['number'] = preg_replace('/[^0-9,\s]/', '', $ht_ctc_chat['number'] );
        if( isset($ht_ctc_chat['number']) ) {
            $ht_ctc_chat['number'] = preg_replace('/\D/', '', $ht_ctc_chat['number'] );
            $ht_ctc_chat['number'] = ltrim( $ht_ctc_chat['number'], '0' );
        }


        return $ht_ctc_chat;
    }

    // other settings
    function other_settings( $ht_ctc_os ) {

        $othersettings = get_option('ht_ctc_othersettings');

        $ht_ctc_os['show_effect'] = (isset($othersettings['show_effect'])) ? esc_attr($othersettings['show_effect']) : '';
        $ht_ctc_os['is_ga_enable'] = (isset( $othersettings['google_analytics'] )) ? 'yes' : 'no';
        $ht_ctc_os['is_fb_pixel'] = (isset( $othersettings['fb_pixel'] )) ? 'yes' : 'no';
        $ht_ctc_os['is_fb_an_enable'] = (isset( $othersettings['fb_analytics'] )) ? 'yes' : 'no';

        // show effect ? if 'From Corner' - then return time (from center - this->css_styles() handles)
        if ( 'From Corner' == $ht_ctc_os['show_effect'] ) {
            $ht_ctc_os['show_effect'] = 120;
        }

        // Animations
        $an_type = ( isset( $othersettings['an_type']) ) ? esc_attr( $othersettings['an_type'] ) : 'no-animation';
        if ( 'no-animation' !== $an_type ) {
            $ht_ctc_os['data-attributes'] = "data-an_type='ht_ctc_an_$an_type' ";
        }

        return $ht_ctc_os;
    }



    function load_app_js_bottom( $load_app_js_bottom ) {
        
        // compatibility
        // autoptimize cache plugin
        if( class_exists('autoptimizeCache') ) {
            $load_app_js_bottom = false;
        }
        return $load_app_js_bottom;
    }


    // update from previous method
	function previous_metabox() {
        
		$post_id = get_the_ID();
		$ht_ctc_pagelevel = get_post_meta( $post_id, 'ht_ctc_pagelevel', true );

		if ( !isset($ht_ctc_pagelevel) || empty($ht_ctc_pagelevel) ) {
			$prev_number = esc_attr( get_post_meta( $post_id, 'ht_ctc_page_number', true ) );
			$prev_number = (isset($prev_number)) ? $prev_number : '';
			$prev_call_to_action = esc_attr( get_post_meta( $post_id, 'ht_ctc_page_call_to_action', true ) );
			$prev_call_to_action = (isset($prev_call_to_action)) ? $prev_call_to_action : '';
			$prev_group_id = esc_attr( get_post_meta( $post_id, 'ht_ctc_page_group_id', true ) );
			$prev_group_id = (isset($prev_group_id)) ? $prev_group_id : '';

			$prev_ht_ctc_pagelevel = array();
			if ( '' !== $prev_number ) {
				$prev_ht_ctc_pagelevel['number'] = $prev_number;
			}
			if ( '' !== $prev_call_to_action ) {
				$prev_ht_ctc_pagelevel['call_to_action'] = $prev_call_to_action;
			}
			if ( '' !== $prev_group_id ) {
				$prev_ht_ctc_pagelevel['group_id'] = $prev_group_id;
			}
			$prev_ht_ctc_pagelevel = array_filter( $prev_ht_ctc_pagelevel );
			if ( !empty( $prev_ht_ctc_pagelevel ) ) {
				update_post_meta( $post_id, 'ht_ctc_pagelevel', $prev_ht_ctc_pagelevel );
			}

			delete_post_meta($post_id, 'ht_ctc_page_number', '' );
			delete_post_meta($post_id, 'ht_ctc_page_call_to_action', '' );
			delete_post_meta($post_id, 'ht_ctc_page_group_id', '' );
		}
    }
    


}

new HT_CTC_Hooks();

endif; // END class_exists check