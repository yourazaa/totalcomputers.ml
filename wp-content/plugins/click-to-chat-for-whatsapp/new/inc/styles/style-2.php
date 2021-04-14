<?php
/**
 * Style - 2
 * 
 * Andriod like - WhatsApp icon
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s2_options = get_option( 'ht_ctc_s2' );

$s2_img_size = esc_attr( $s2_options['s2_img_size'] );
$img_size = esc_attr( $s2_options['s2_img_size'] );
if ( '' == $img_size ) {
    $img_size = "50px";
}

// Call to action 
$s2_cta_type = (isset( $s2_options['cta_type'])) ? esc_attr( $s2_options['cta_type'] ) : 'hover';

$s2_cta_order = "1";
if ('right' == $options['side_2']) {
    // if side_2 is right then cta is left
    $s2_cta_order = "0";
}

$s2_cta_textcolor = (isset( $s2_options['cta_textcolor'])) ? esc_attr( $s2_options['cta_textcolor'] ) : '';
$s2_cta_bgcolor = (isset( $s2_options['cta_bgcolor'])) ? esc_attr( $s2_options['cta_bgcolor'] ) : '#ffffff';

$s2_cta_textcolor = ('' !== $s2_cta_textcolor) ? "color: $s2_cta_textcolor" : "";
$s2_cta_bgcolor = ('' !== $s2_cta_bgcolor) ? "background-color: $s2_cta_bgcolor" : "";

$s2_cta_css = "padding: 0px 16px; $s2_cta_bgcolor; $s2_cta_textcolor; border-radius:10px; margin:0 10px; ";
$s2_cta_class = "ht-ctc-cta ";
$title = "";
if ( 'hover' == $s2_cta_type ) {
    $s2_cta_css .= " display: none; order: $s2_cta_order; ";
    $s2_cta_class .= " ht-ctc-cta-hover ";
} elseif ( 'show' == $s2_cta_type ) {
    $s2_cta_css .= "order: $s2_cta_order; ";
} elseif ( 'hide' == $s2_cta_type ) {
    $s2_cta_css .= " display: none; ";
    $title = "title = '$call_to_action'";
}

$ht_ctc_svg_css = "pointer-events:none; display:block; height:$img_size; width:$img_size;";

include_once HT_CTC_PLUGIN_DIR .'new/inc/assets/img/ht-ctc-svg-images.php';
?>
<div <?php echo $title ?> style="display: flex; justify-content: center; align-items: center;">
    <p class="<?php echo $s2_cta_class ?>" style="<?php echo $s2_cta_css ?>"><?php echo $call_to_action; ?></p>
    <?php echo ht_ctc_style_2_svg( $img_size, $type, $ht_ctc_svg_css ); ?>
</div>