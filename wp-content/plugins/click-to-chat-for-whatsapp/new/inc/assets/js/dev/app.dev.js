// Click to Chat
var ht_ctc_v = '3.0';
var url = window.location.href;

// is_mobile yes/no,  desktop > 1024 
var is_mobile = 'yes';
if (typeof screen.width !== "undefined" ) {
    is_mobile = ( screen.width > 1024 ) ? "no" : "yes";
}

// post title
var post_title = (typeof document.title !== "undefined" ) ? document.title : '';

function afterdom_loaded() {
    if ( 'complete' == document.readyState || 'interactive' == document.readyState ) {
        // call direclty
        ht_ctc();
    } else {
        document.addEventListener('DOMContentLoaded', ht_ctc);
    }
}
afterdom_loaded();

function ht_ctc_loaded() {
    afterdom_loaded();
}

function ht_ctc() {
    var ht_ctc_chat = document.querySelector('.ht-ctc-chat');
    (ht_ctc_chat) ? hide_basedon_device(ht_ctc_chat) : '';
}

// Hide based on device
function hide_basedon_device(p) {
    if (is_mobile == 'yes') {
        var display_mobile = p.getAttribute('data-display_mobile');
        if ( 'show' == display_mobile ) {

            // remove desktop style
            var rm = document.querySelector('.ht_ctc_desktop_' + p.getAttribute('data-return_type'));
            (rm) ? rm.remove() : '';

            var css = p.getAttribute('data-css');
            var position_mobile = p.getAttribute('data-position_mobile');
            p.style.cssText = position_mobile + css;
            display(p)
        }
    } else {
        var display_desktop = p.getAttribute('data-display_desktop');
        if ( 'show' == display_desktop ) {

            // remove mobile style
            var rm = document.querySelector('.ht_ctc_mobile_' + p.getAttribute('data-return_type'));
            (rm) ? rm.remove() : '';

            var css = p.getAttribute('data-css');
            var position = p.getAttribute('data-position');
            p.style.cssText = position + css;
            display(p)
        }
    }
}

function display(p) {
    // p.style.removeProperty('display');
    // var x = p.style.getPropertyValue("display");
    // p.style.display = "block";
    try {
        var dt = parseInt(p.getAttribute('data-show_effect'));
        jQuery(p).show(dt);
        // jQuery(p).fadeIn(1000);
    } catch (e) {
        p.style.display = "block";
    }
    // jQuery(".ht-ctc-chat").show(120);
    // jQuery(".ht-ctc-chat").fadeIn();

    try {
        ht_ctc_things(p);
    } catch (e) {}

}

function ht_ctc_things(p) {

    // animations
    var animateclass = p.getAttribute('data-an_type')
    setTimeout(function () {
        p.classList.add('ht_ctc_animation', animateclass);
    }, 120);

    // hover effects
    jQuery(".ht-ctc-chat").hover(function () {
        jQuery('.ht-ctc-chat .ht-ctc-cta-hover').show(120);
    }, function () {
        jQuery('.ht-ctc-chat .ht-ctc-cta-hover').hide(100);
    });
}

// shortcode link
function ht_ctc_shortcode_click(values) {
    data_link = values.getAttribute("data-ctc-link");
    data_link = encodeURI(data_link);
    window.open(data_link, '_blank', 'noopener');
    ht_ctc_analytics(values);
}

// floating style - click
function ht_ctc_click(values) {
    // link
    ht_ctc_link(values);
    // analytics
    ht_ctc_analytics(values);
}

// link - chat
function ht_ctc_link(values) {

    var number = values.getAttribute('data-number');
    var pre_filled = values.getAttribute('data-pre_filled');
    pre_filled = pre_filled.replace(/\[url]/gi, url);
    pre_filled = encodeURIComponent(pre_filled);
    var webandapi = values.getAttribute('data-webandapi');

    if ( '' == number ) {
        values.innerHTML = values.getAttribute('data-no_number');
        return;
    }

    // web/api.whatsapp or wa.me 
    if ( 'webapi' == webandapi ) {
        if (is_mobile == 'yes') {
            var base_link = 'https://api.whatsapp.com/send';
        } else {
            var base_link = 'https://web.whatsapp.com/send';
        }
        window.open(base_link + '?phone=' + number + '&text=' + pre_filled, '_blank', 'noopener');
    } else {
        // wa.me
        var base_link = 'https://wa.me/';
        window.open(base_link + number + '?text=' + pre_filled, '_blank', 'noopener');
    }
    
}






/**
 * Global
 */

// Analytics
function ht_ctc_analytics(values) {
    var return_type = values.getAttribute('data-return_type');
    var id = '';
    if ( 'chat' == return_type ) {
        id = values.getAttribute('data-number');
    } else if ( 'group' == return_type ) {
        id = values.getAttribute('data-group_id');
    } else if ( 'share' == return_type ) {
        id = values.getAttribute('data-share_text');
    }
    // Google Analytics
    ht_ctc_ga( return_type, id, values );
    // FB Pixel
    var is_fb_pixel = values.getAttribute('data-is_fb_pixel');
    if ( 'yes' == is_fb_pixel ) {
        ht_ctc_fb_pixel( return_type, id );
    }
    // FB Analytics
    var is_fb_an_enable = values.getAttribute('data-is_fb_an_enable');
    if ( 'yes' == is_fb_an_enable ) {
        ht_ctc_fb_an( return_type, id );
    }
}

// Google Analytics - have to improve
function ht_ctc_ga( return_type, id, values ) {
    var ga_category = 'Click to Chat for WhatsApp';
    var ga_action = return_type + ': ' + id ;
    var ga_label = post_title + ', ' + url ;
    // if ga_enabled
    var is_ga_enable = values.getAttribute('data-is_ga_enable');
    if ( 'yes' == is_ga_enable ) {
        if (typeof gtag !== "undefined") {
            gtag('event', ga_action, {
                'event_category': ga_category,
                'event_label': ga_label,
            });
        } else if (typeof ga !== "undefined" && typeof ga.getAll !== "undefined" ) {
            var tracker = ga.getAll();
            tracker[0].send("event", ga_category, ga_action, ga_label );
            // ga('send', 'event', ga_category, ga_action, ga_label);
        } else if (typeof __gaTracker !== "undefined") {
            __gaTracker('send', 'event', ga_category, ga_action, ga_label);
        }
    }
    // dataLayer
    if (typeof dataLayer !== "undefined") {
        dataLayer.push({
            'event': 'Click to Chat',
            'event_category': ga_category,
            'event_label': ga_label,
            'event_action': ga_action
          });
    }

}

// FB Pixel
function ht_ctc_fb_pixel( return_type, id ) {

    if (typeof fbq !== "undefined") {
        fbq('trackCustom', 'Click to Chat by HoliThemes', {
            'Category': 'Click to Chat for WhatsApp',
            'return_type': return_type,
            'ID': id,
            'Title': post_title,
            'URL': url
        });
    }

    // if (typeof fbq !== "undefined") {
    //     fbq('track', 'Lead', {
    //         'Category': 'Click to Chat for WhatsApp',
    //         'return_type': 'Chat',
    //         'Title': post_title,
    //         'url': url,
    //     });
    // }



}

// FB Analytics
function ht_ctc_fb_an( return_type, id ) {
    var fb_event_name = 'Click to Chat for WhatsApp';
    var params = {};
    params['Category'] = 'Click to Chat for WhatsApp';
    params['return_type'] = return_type;
    params['ID'] = id;
    params['Label'] = post_title + ', ' + url ;
    if (typeof FB !== "undefined") {
        FB.AppEvents.logEvent( fb_event_name, null, params);
    }
}


// function test_customevent() {
//     console.log('custome event');
// }