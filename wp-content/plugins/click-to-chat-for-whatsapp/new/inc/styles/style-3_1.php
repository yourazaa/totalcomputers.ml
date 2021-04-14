<?php
/**
 * Style - 3_1 - s3 extend
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s3_1_options = get_option( 'ht_ctc_s3_1' );

$img_size = esc_attr( $s3_1_options['s3_img_size'] );
if ( '' == $img_size ) {
    $img_size = "40px";
}

// Call to action 
$s3_1_cta_type = (isset( $s3_1_options['cta_type'])) ? esc_attr( $s3_1_options['cta_type'] ) : 'hover';

$s3_1_cta_order = "1";
if ('right' == $options['side_2']) {
    // if side_2 is right then cta is left
    $s3_1_cta_order = "0";
}

$s3_1_cta_textcolor = (isset( $s3_1_options['cta_textcolor'])) ? esc_attr( $s3_1_options['cta_textcolor'] ) : '';
$s3_1_cta_bgcolor = (isset( $s3_1_options['cta_bgcolor'])) ? esc_attr( $s3_1_options['cta_bgcolor'] ) : '#ffffff';

$s3_1_cta_textcolor = ('' !== $s3_1_cta_textcolor) ? "color: $s3_1_cta_textcolor" : "";
$s3_1_cta_bgcolor = ('' !== $s3_1_cta_bgcolor) ? "background-color: $s3_1_cta_bgcolor" : "";

$s3_1_cta_css = "padding: 0px 16px; $s3_1_cta_bgcolor; $s3_1_cta_textcolor; border-radius:10px; margin:0 10px; ";
$s3_1_cta_class = "ht-ctc-cta ";
$title = "";
if ( 'hover' == $s3_1_cta_type ) {
    $s3_1_cta_css .= " display: none; order: $s3_1_cta_order; ";
    $s3_1_cta_class .= " ht-ctc-cta-hover ";
} elseif ( 'show' == $s3_1_cta_type ) {
    $s3_1_cta_css .= "order: $s3_1_cta_order; ";
} elseif ( 'hide' == $s3_1_cta_type ) {
    $s3_1_cta_css .= " display: none; ";
    $title = "title = '$call_to_action'";
}

$ht_ctc_svg_css = "pointer-events:none; display:block; height:$img_size; width:$img_size;";

include_once HT_CTC_PLUGIN_DIR .'new/inc/assets/img/ht-ctc-svg-images.php';


// extend
$s3_1_padding = ( isset( $s3_1_options['s3_padding']) ) ? esc_attr( $s3_1_options['s3_padding'] ) : '';
$s3_1_bg_color = ( isset( $s3_1_options['s3_bg_color']) ) ? esc_attr( $s3_1_options['s3_bg_color'] ) : '#25D366';
$s3_1_bg_color_hover = ( isset( $s3_1_options['s3_bg_color_hover']) ) ? esc_attr( $s3_1_options['s3_bg_color_hover'] ) : '#25D366';

$s3_1_box_shadow = "";
if ( isset( $s3_1_options['s3_box_shadow'])) {
    $s3_1_box_shadow = "box-shadow: 0px 0px 11px rgba(0,0,0,.5);";
}
$s3_1_extend_css = "background-color: $s3_1_bg_color; padding: $s3_1_padding; border-radius: 50%; $s3_1_box_shadow";

$s3_1_box_shadow_hover = "";
if ( isset( $s3_1_options['s3_box_shadow_hover'])) {
    $s3_1_box_shadow_hover = "box-shadow:0px 0px 11px rgba(0,0,0,.5);";
}
// hover css
$s3_1_hover_css = "background-color:$s3_1_bg_color_hover !important;$s3_1_box_shadow_hover";

$others = array(
    'bg_color' => "$s3_1_bg_color",
);

?>
<style id="ht-ctc-s3">
.ht-ctc:hover svg stop{stop-color:<?php echo $s3_1_bg_color_hover ?>;}.ht-ctc:hover .ht_ctc_padding{<?php echo $s3_1_hover_css ?>}
</style>

<div <?php echo $title ?> style="display: flex; justify-content: center; align-items: center;">
    <p class="<?php echo $s3_1_cta_class ?>" style="<?php echo $s3_1_cta_css ?>"><?php echo $call_to_action ?></p>
    <div class="ht_ctc_padding" style="<?php echo $s3_1_extend_css ?>">
        <?php echo ht_ctc_style_3_1_svg( $img_size, $type, $ht_ctc_svg_css, $others ); ?>
    </div>
</div>