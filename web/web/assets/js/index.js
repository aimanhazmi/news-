var App = {
    effectEvent: function () {
        var indexSwiper = new Swiper('.swiper-container-index-banner', {
            navigation: {
                nextEl: '.swiper-button-next-ib',
                prevEl: '.swiper-button-prev-ib',
            },
        });

        var certifySwiper = new Swiper('.swiper-container-certify', {
            watchSlidesProgress: true,
            slidesPerView: 'auto',
            centeredSlides: true,
            loop: true,
            loopedSlides: 5,
            autoplay: true,
            pagination: {
                el: '.swiper-pagination-c',
                //clickable :true,
            },
            navigation: {
                nextEl: '.swiper-button-next-c ',
                prevEl: '.swiper-button-prev-c',
            },
            on: {
                progress: function (progress) {
                    for (i = 0; i < this.slides.length; i++) {
                        var slide = this.slides.eq(i);
                        var slideProgress = this.slides[i].progress;
                        modify = 1;
                        if (Math.abs(slideProgress) > 1) {
                            modify = (Math.abs(slideProgress) - 1) * 0.3 + 1;
                        }
                        translate = slideProgress * modify * 260 + 'px';
                        scale = 1 - Math.abs(slideProgress) / 5;
                        zIndex = 999 - Math.abs(Math.round(10 * slideProgress));
                        slide.transform('translateX(' + translate + ') scale(' + scale + ')');
                        slide.css('zIndex', zIndex);
                        slide.css('opacity', 1);
                        if (Math.abs(slideProgress) > 3) {
                            slide.css('opacity', 0);
                        }
                    }
                },
                setTransition: function (transition) {
                    for (var i = 0; i < this.slides.length; i++) {
                        var slide = this.slides.eq(i)
                        slide.transition(transition);
                    }

                }
            }
        });
    },
    initJQEvnet: function () {
        $('[data-pubtime]').each(function (index, obj) {
            $(obj).html($(obj).html() + "<span class='pubtime'>" + $(obj).data('pubtime') + "</span>")
        });

        $('[data-set-home]').click(function () {
            var obj = $(this)[0];
            var ishttps = 'https:' == document.location.protocol ? true : false;
            var url = window.location.host;
            if (ishttps) {
                url = 'https://' + url;
            } else {
                url = 'http://' + url;
            }
            try {
                obj.style.behavior = 'url(#default#homepage)';
                obj.setHomePage(url);
            } catch (e) {
                if (window.netscape) {
                    try {
                        netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                    } catch (e) {
                        alert("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'");
                    }
                } else {
                    alert("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【" + url + "】设置为首页。");
                }
            }
        });
        $('[data-add-favorite]').click(function () {
            var title = document.title;
            var url = location.href;
            try {
                window.external.addFavorite(url, title);
            }
            catch (e) {
                try {
                    window.sidebar.addPanel(title, url, "");
                }
                catch (e) {
                    alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
                }
            }
        });
        $('.search-btn').click(function () {
            var wd = $('input[name=wd]').val();
            if (wd) {
                window.location.href = '/search.html?wd=' + wd;
            }
        });



        $('.guestbook-submit').click(function () {
            var btn = $(this);
            if (btn.attr('submit') == '1') {
                return;
            }
            btn.attr('submit', 1);
            var params = $('#guest-book-form').serializeArray();
            $.post("",
                params,
                function (result) {
                    btn.attr('submit', 0);
                    if (result.code == 0) {
                        alert('提交成功！');
                        setTimeout(function () {
                            window.location.reload();
                        }, 900);
                    } else {
                        alert(result.message);
                    }
                }, "json");
        });
    },
    init: function () {
        this.effectEvent();
        this.initJQEvnet();
    },
};

App.init();



