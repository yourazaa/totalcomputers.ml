<?php
/**
 * Hooks
 * @since 2.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Animations' ) ) :

class HT_CTC_Animations {


    // public function __construct() {
        // $this->base();
    // }


    function animations( $a ) {
        ?>
        <style id="ht-ctc-animations">.ht_ctc_animation {animation-duration:1s;animation-fill-mode:both;animation-delay:0s;animation-iteration-count:1;}</style>
        <?php $this->$a(); ?>
        <?php
    }

    function bounce() {
        ?>
        <style id="ht-ctc-an-bounce">@keyframes bounce{from,20%,53%,to{animation-timing-function:cubic-bezier(0.215,0.61,0.355,1);transform:translate3d(0,0,0)}40%,43%{animation-timing-function:cubic-bezier(0.755,0.05,0.855,0.06);transform:translate3d(0,-30px,0) scaleY(1.1)}70%{animation-timing-function:cubic-bezier(0.755,0.05,0.855,0.06);transform:translate3d(0,-15px,0) scaleY(1.05)}80%{transition-timing-function:cubic-bezier(0.215,0.61,0.355,1);transform:translate3d(0,0,0) scaleY(0.95)}90%{transform:translate3d(0,-4px,0) scaleY(1.02)}}.ht_ctc_an_bounce{animation-name:bounce;transform-origin:center bottom}</style>
        <?php
    }

    function flash() {
        ?>
        <style id="ht-ctc-an-flash">@keyframes flash{from,50%,to{opacity:1}25%,75%{opacity:0}}.ht_ctc_an_flash{animation-name:flash}</style>
        <?php
    }

    function pulse() {
        ?>
        <style id="ht-ctc-an-pulse">@keyframes pulse{from{transform:scale3d(1,1,1)}50%{transform:scale3d(1.05,1.05,1.05)}to{transform:scale3d(1,1,1)}}.ht_ctc_an_pulse{animation-name:pulse;animation-timing-function:ease-in-out}</style>
        <?php
    }



}

// new HT_CTC_Animations();

endif; // END class_exists check