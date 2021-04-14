<?php
/**
 * Style - 1
 * 
 * theme button
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s1_options = get_option( 'ht_ctc_s1' );

if ( '' == $call_to_action ) {
    $call_to_action = "WhatsApp us";
}

$s1_fullwidth_css = "";
if ( isset( $s1_options['s1_m_fullwidth'] ) ) {
  $s1_fullwidth_css = "@media(max-width:1201px){.ht-ctc.style-1,.ht-ctc .s1_btn{width:100%;}}";

?>
<style id="ht-ctc-s1"><?php echo $s1_fullwidth_css ?></style>
<?php
}

?>
<button class="ctc-analytics s1_btn"><?php echo $call_to_action ?></button>