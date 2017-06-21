/**
 * Created by JS on 2017/6/21 0021.
 */
$(function () {
    $(".user_box").hover(function () {
        $(this).find("ul").show("fast");
    },function () {
        $(this).find("ul").hide("fast");
    });

    $("a.menu_button").click(function () {
        var this_list = $(this).parent().find("ul.sub");
        var the_other_lists = $(this).parent().siblings().find("ul.sub");
        if (this_list.css("display") === "none") {
            the_other_lists.hide();
            this_list.show("fast", "swing");
        } else {
            this_list.hide("fast", "swing");
        }
    });
});