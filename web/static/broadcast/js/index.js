$(document).ready(function () {
    $(".indexbanner").indexBanner();
    var a = $(".product-types>li"),
        b = $(".product-list-box"),
        c = $(".product-list"),
        d = 0;
    a.each(function (e) {
        $(this).click(function () {
            a.removeClass("selected"), $(this).addClass("selected");
            var f = (Number(c.eq(d).attr("data-h")), Number(c.eq(e).attr("data-h"))),
                g = Math.ceil((d + 1) / 5),
                h = Math.ceil((e + 1) / 5);
            g == h ? (b.eq(g - 1).animate({
                height: f + 32 + "px"
            }, 600, "easeInOutQuart"), c.eq(d).animate({
                opacity: 0
            }, 600, "easeInOutQuart").css({
                zIndex: 0
            }), c.eq(e).animate({
                opacity: 1
            }, 600, "easeInOutQuart").css({
                zIndex: 1
            })) : (b.eq(g - 1).animate({
                opacity: 0,
                height: 0
            }, 200, "easeInOutQuart"), b.eq(h - 1).delay(200).animate({
                opacity: 1,
                height: f + 32 + "px"
            }, 400, "easeInOutQuart"), c.eq(d).animate({
                opacity: 0
            }, 200, "easeInOutQuart").css({
                zIndex: 0
            }), c.eq(e).animate({
                opacity: 1
            }, 200, "easeInOutQuart").css({
                zIndex: 1
            })), d = e
        })
    }), c.each(function () {
        $(this).attr({
            "data-h": $(this).height()
        })
    }), b.css({
        opacity: 0
    }), c.css({
        opacity: 0
    }).eq(d).css({
        opacity: 1,
        zIndex: 1
    }).parent().css({
        opacity: 1
    }).css({
        height: Number(c.eq(d).attr("data-h")) + 32 + "px"
    });
    var e = $(".solution-tabs>button"),
        f = $(".solution-contain");
    e.each(function (a) {
        $(this).click(function () {
            e.removeClass("selected"), $(this).addClass("selected"), f.addClass("dn"), f.eq(a).removeClass("dn")
        })
    });
    var g = $(".region-tabs>button"),
        h = $(".region-contain");
    g.each(function (a) {
        $(this).click(function () {
            g.removeClass("selected"), $(this).addClass("selected"), h.addClass("dn"), h.eq(a).removeClass("dn")
        })
    });
    var i = $(".learn-step"),
        j = $(".learn-contain"),
        k = $(".pre-step"),
        l = $(".next-step"),
        m = 0;
    i.each(function (a) {
        $(this).click(function () {
            switch (m = a, i.removeClass("selected"), $(this).addClass("selected"), $(".step-arrow").removeClass("learned"), $(".learn-step:lt(" + a + ")>.step-arrow").addClass("learned"), j.addClass("dn"), j.eq(a).removeClass("dn"), a) {
            case 0:
                k.addClass("dn"), l.removeClass("dn");
                break;
            case 4:
                k.removeClass("dn"), l.addClass("dn");
                break;
            default:
                k.removeClass("dn"), l.removeClass("dn")
            }
        })
    }), k.click(function () {
        i.eq(m - 1).click()
    }), l.click(function () {
        i.eq(m + 1).click()
    })
});