/**
 * Created by JS on 2017/6/20 0020.
 */
var fix_nav = document.getElementById("fix_nav");
var jorelanbo = document.getElementById("Jorelanbo");
var fix_jorelanbo = document.getElementById("fix_Jorelanbo");
window.onscroll = function () {
    var t = document.documentElement.scrollTop || document.body.scrollTop;
    var j_top = jorelanbo.getBoundingClientRect().top;
    if (t > 100) {
        fix_nav.style.zIndex = 3;
    } else {
        fix_nav.style.zIndex = 1;
    }

    if (j_top <= 90 ) {
        var j_right = jorelanbo.getBoundingClientRect().right;
        jorelanbo.style.visibility = "hidden";
        fix_jorelanbo.style.top = "90px";
        fix_jorelanbo.style.right = j_right;
        fix_jorelanbo.style.visibility = "visible";
    } else {
        fix_jorelanbo.style.visibility = "hidden";
        jorelanbo.style.visibility = "visible";
    }
};

function check() {
    if (document.search_form.search_key.value === '') {
        return false;
    }
}