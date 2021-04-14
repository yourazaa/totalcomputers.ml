var ht_ctc_v = "2.11"
    , url = window.location.href
    , is_mobile = "yes";
void 0 !== screen.width && (is_mobile = 1024 < screen.width ? "no" : "yes");
var post_title = void 0 !== document.title ? document.title : "";
function afterdom_loaded() {
    "complete" == document.readyState || "interactive" == document.readyState ? ht_ctc() : document.addEventListener("DOMContentLoaded", ht_ctc)
}
function ht_ctc_loaded() {
    afterdom_loaded()
}
function ht_ctc() {
    var t = document.querySelector(".ht-ctc-chat");
    t && hide_basedon_device(t);
    var e = document.querySelector(".ht-ctc-share");
    e && hide_basedon_device(e);
    var a = document.querySelector(".ht-ctc-group");
    a && hide_basedon_device(a)
}
function hide_basedon_device(t) {
    var e, a, n, o;
    "yes" == is_mobile ? "show" == t.getAttribute("data-display_mobile") && ((a = document.querySelector(".ht_ctc_desktop_" + t.getAttribute("data-return_type"))) && a.remove(),
        n = t.getAttribute("data-css"),
        e = t.getAttribute("data-position_mobile"),
        t.style.cssText = e + n,
        display(t)) : "show" == t.getAttribute("data-display_desktop") && ((a = document.querySelector(".ht_ctc_mobile_" + t.getAttribute("data-return_type"))) && a.remove(),
            n = t.getAttribute("data-css"),
            o = t.getAttribute("data-position"),
            t.style.cssText = o + n,
            display(t))
}
function display(t) {
    t.style.display = "block"
}
function ht_ctc_shortcode_click(t) {
    data_link = t.getAttribute("data-ctc-link"),
        data_link = encodeURI(data_link),
        window.open(data_link, "_blank", "noopener"),
        ht_ctc_analytics(t)
}
function ht_ctc_click(t) {
    ht_ctc_link(t),
        ht_ctc_analytics(t)
}
function ht_ctc_link(t) {
    var e = t.getAttribute("data-return_type");
    if ("group" == e) {
        var a = "https://chat.whatsapp.com/"
            , n = t.getAttribute("data-group_id");
        window.open(a + n, "_blank", "noopener")
    } else if ("share" == e) {
        var o = t.getAttribute("data-share_text")
            , i = "api";
        "webapi" == (c = t.getAttribute("data-webandapi")) && (i = "yes" == is_mobile ? "api" : "web");
        a = "https://" + i + ".whatsapp.com/send";
        window.open(a + "?text=" + o, "_blank", "noopener")
    } else {
        var r = t.getAttribute("data-number")
            , d = t.getAttribute("data-pre_filled")
            , d = encodeURIComponent(d)
            , c = t.getAttribute("data-webandapi");
        if ("" == r && t.classList.contains("admin"))
            return void (t.innerHTML = "<p style='background-color: #ffffff; margin:0; border: 1px solid #fbfbfb; padding:11px; border-radius:4px; box-shadow: 5px 10px 8px #888888;'>No WhatsApp Number Found!<br><small style='color: red;'>Admin Notice:<br></small><small>Add WhatsApp number at pluign Settings<br>If already added, <strong>clear the Cache</strong> and try.<br>If still an issue, please contact plugin developers</small></p>");
        if ("" == r)
            return void (t.innerHTML = "<p>No WhatsApp Number Found!</p>");
        "webapi" == c ? (a = "yes" == is_mobile ? "https://api.whatsapp.com/send" : "https://web.whatsapp.com/send",
            window.open(a + "?phone=" + r + "&text=" + d, "_blank", "noopener")) : (a = "https://wa.me/",
                window.open(a + r + "?text=" + d, "_blank", "noopener"))
    }
}
function ht_ctc_analytics(t) {
    var e = t.getAttribute("data-return_type")
        , a = "";
    "chat" == e ? a = t.getAttribute("data-number") : "group" == e ? a = t.getAttribute("data-group_id") : "share" == e && (a = t.getAttribute("data-share_text")),
        ht_ctc_ga(e, a, t),
        "yes" == t.getAttribute("data-is_fb_pixel") && ht_ctc_fb_pixel(e, a),
        "yes" == t.getAttribute("data-is_fb_an_enable") && ht_ctc_fb_an(e, a)
}
function ht_ctc_ga(t, e, a) {
    var n = "Click to Chat for WhatsApp"
        , o = t + ": " + e
        , i = post_title + ", " + url;
    "yes" == a.getAttribute("data-is_ga_enable") && ("undefined" != typeof gtag ? gtag("event", o, {
        event_category: n,
        event_label: i
    }) : "undefined" != typeof ga && void 0 !== ga.getAll ? ga.getAll()[0].send("event", n, o, i) : "undefined" != typeof __gaTracker && __gaTracker("send", "event", n, o, i)),
        "undefined" != typeof dataLayer && dataLayer.push({
            event: "Click to Chat",
            event_category: n,
            event_label: i,
            event_action: o
        })
}
function ht_ctc_fb_pixel(t, e) {
    "undefined" != typeof fbq && fbq("trackCustom", "Click to Chat by HoliThemes", {
        Category: "Click to Chat for WhatsApp",
        return_type: t,
        ID: e,
        Title: post_title,
        URL: url
    })
}
function ht_ctc_fb_an(t, e) {
    var a = {
        Category: "Click to Chat for WhatsApp"
    };
    a.return_type = t,
        a.ID = e,
        a.Label = post_title + ", " + url,
        "undefined" != typeof FB && FB.AppEvents.logEvent("Click to Chat for WhatsApp", null, a)
}
afterdom_loaded();
