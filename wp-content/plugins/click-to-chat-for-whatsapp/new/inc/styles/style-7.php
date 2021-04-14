<?php
/**
 * Style - 7
 * icon with customize padding
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$s7_options = get_option( 'ht_ctc_s7' );

$s7_icon_size = esc_attr( $s7_options['s7_icon_size'] );
$s7_icon_color = esc_attr( $s7_options['s7_icon_color'] );
$s7_icon_color_hover = esc_attr( $s7_options['s7_icon_color_hover'] );
$s7_border_size = esc_attr( $s7_options['s7_border_size'] );
$s7_border_color = esc_attr( $s7_options['s7_border_color'] );
$s7_border_color_hover = esc_attr( $s7_options['s7_border_color_hover'] );
$s7_border_radius = esc_attr( $s7_options['s7_border_radius'] );

// Call to action 
$s7_cta_type = (isset( $s7_options['cta_type'])) ? esc_attr( $s7_options['cta_type'] ) : 'hover';
$s7_cta_textcolor = (isset( $s7_options['cta_textcolor'])) ? esc_attr( $s7_options['cta_textcolor'] ) : '';
$s7_cta_bgcolor = (isset( $s7_options['cta_bgcolor'])) ? esc_attr( $s7_options['cta_bgcolor'] ) : '#ffffff';

$s7_n1_styles = "display:flex;justify-content:center;align-items:center;";
$s7_icon_css = "font-size: $s7_icon_size; color: $s7_icon_color; padding: $s7_border_size; background-color: $s7_border_color; border-radius: $s7_border_radius;";

// Call to action 
$s7_cta_order = "1";
if ('right' == $options['side_2']) {
    // if side_2 is right then cta is left
    $s7_cta_order = "0";
}

$s7_cta_css = "padding: 0px 16px; color: $s7_cta_textcolor; background-color: $s7_cta_bgcolor; border-radius:10px; margin:0 10px; ";
$s7_cta_class = "ht-ctc-cta ";
$title = "";
if ( 'hover' == $s7_cta_type ) {
    $s7_cta_css .= " display: none; order: $s7_cta_order; ";
    $s7_cta_class .= " ht-ctc-cta-hover ";
} elseif ( 'show' == $s7_cta_type ) {
    $s7_cta_css .= "order: $s7_cta_order; ";
} elseif ( 'hide' == $s7_cta_type ) {
    $s7_cta_css .= " display: none; ";
    $title = "title = '$call_to_action'";
}

// svg values
$ht_ctc_svg_css = "pointer-events:none; display:block; height:$s7_icon_size; width:$s7_icon_size;";
$s7_svg_attrs = array(
    'color' => "$s7_icon_color",
    'icon_size' => "$s7_icon_size",
    'type' => "$type",
    'ht_ctc_svg_css' => "$ht_ctc_svg_css",
);

// cta order
$s7_cta_order = "1";
if ('right' == $options['side_2']) {
    // if side_2 is right then cta is left
    $s7_cta_order = "0";
}


// hover
$s7_hover_icon_styles = ".ht-ctc.style-7:hover .ctc_s_7_icon_padding{background-color:$s7_border_color_hover !important;}.ht-ctc.style-7:hover svg g path{fill:$s7_icon_color_hover !important;}";

include_once HT_CTC_PLUGIN_DIR .'new/inc/assets/img/ht-ctc-svg-images.php';
?>
<style id="ht-ctc-s7">
<?php echo $s7_hover_icon_styles ?>
</style>

<div <?php echo $title ?> class="ctc_s_7" style="<?php echo $s7_n1_styles; ?>">
    <p class="ctc_s_7_cta ctc-analytics <?php echo $s7_cta_class ?>" style="<?php echo $s7_cta_css ?>"><?php echo $call_to_action; ?></p>
    <div class="ctc_s_7_icon_padding ctc-analytics " style="<?php echo $s7_icon_css ?>">
        <?php echo ht_ctc_singlecolor( $s7_svg_attrs ); ?>
    </div>
</div>