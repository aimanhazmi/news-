<?php
/**
 * Created by aiman
 * User: whts
 * Date: 2025-05-06
 * Time: 17:28
 */
?>

<script>
    (function(w, d, t, u, n, i, s, a) {
        w[n] = w[n] || {
            q: [
                ['set', 'aid', i]
            ],
            set: function() { this.q.push(['set'].concat(Array.prototype.slice.apply(arguments))) },
            send: function() { this.q.push(['send'].concat(Array.prototype.slice.apply(arguments))) }
        };

        s = d.createElement(t);
        a = d.getElementsByTagName(t)[0];
        s.async = true;
        s.crossorigin = true;
        s.src = u;
        a.parentNode.insertBefore(s, a)
    })(window, document, 'script', ('https:' == document.location.protocol ? 'https://' : 'http://') + '//das-rpt.ucloud.cn/das.js?v=' + Math.random(), 'das', 'iywtleaa');
</script>

<!-- seo站隐藏外链 -->
<!-- 调研外链类型临时版本 -->
<style>
    .survey-modal {
        margin: 0;
        padding: 0;
        position: fixed;
        top: 58px;
        right: -434px;
        border-radius: 4px;
        background-color: #ffffff;
        box-shadow: 0px 8px 10px 0px rgba(47, 75, 180, 0.3);
        z-index: 100;
        opacity: 0;
        transition: all .25s ease-in-out;
        overflow: hidden;
    }

    .survey-modal.show {
        right: 20px;
        opacity: 1;
    }

    .survey-link {
        position: relative;
        width: 434px;
        height: 152px;
    }

    .survey-link .icon__cross {
        position: absolute;
        top: 16px;
        right: 16px;
        color: #6b798e;
        opacity: 0.8;
        cursor: pointer;
    }

    .survey-link .icon__cross:hover {
        opacity: 1;
    }
</style>
<div class="survey-modal">
    <div class="survey-link">
        <a href target="_blank">
            <img width="434" src>
        </a>
        <span class="icon__cross icon--sm u-fr" title="关闭"></span>
    </div>
</div>
<script type="text/javascript" src="/static/broadcast/js/fingerprint2.min.js"></script>
<script>
    $(document).ready(function() {
        var ApiUrl, Domain;
        var UserId = '';
        var SurveyUserId = '';
        var SurveyId = 0;
        var hostname = window.location.hostname;
        if (hostname.indexOf('.ucloudadmin.com') > -1) {
            ApiUrl = '//api.pre.ucloudadmin.com';
            Domain = '.pre.ucloudadmin.com';
        } else {
            ApiUrl = '//api.ucloud.cn';
            Domain = '.ucloud.cn';
        }

        function setCookie(cname, cvalue) {
            var d = new Date();
            d.setTime(d.getTime() + (30 * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;samesite=none;domain=" + Domain;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function query(datas, successCallback, errorCallback) {
            function transformRequest(data) {
                let ret = ''
                for (let it in data) {
                    ret && (ret += '&')
                    ret += encodeURIComponent(it) + '=' + encodeURIComponent(data[it])
                }
                return ret
            }
            $.ajax({
                type: "POST",
                url: ApiUrl,
                data: transformRequest(datas),
                cache: false,
                xhrFields: {
                    withCredentials: true
                },
                crossDomain: true,
                success: function(data) {
                    successCallback && successCallback(data);
                },
                error: function(e) {
                    errorCallback && errorCallback(e);
                }
            })
        }

        function getResearchQuery() {
            var datas = {
                'Action': 'GetUOWResearch',
                'PlatformType': 'www'
            }
            if (UserId) {
                datas.UserId = UserId
            }

            function success(data) {
                if (data.RetCode == 0 && data.Data.Id) {
                    var surveyData = data.Data;
                    SurveyId = surveyData.Id;
                    var state = getCookie('Survey_State_' + SurveyId)
                    if (!state || state == '3' || state == '4') {
                        var surveyData = data.Data;

                        $('.survey-modal').find('a').attr({ 'href': surveyData.LinkUrl });
                        $('.survey-modal').find('img').attr({ 'src': surveyData.ImgUrl });
                        setTimeout(() => {
                            $('.survey-modal').addClass('show');
                            showResearch()
                        }, surveyData.ReadTime * 1000);
                    }
                }
            }
            query(datas, success)
        }


        function addRecordQuery(type) {
            var datas = {
                'Action': 'AddUOWRecord',
                'PlatformType': 'www',
                'Origin': window.location.href,
                'ResearchId': SurveyId,
                'Type': type
            }
            datas.UserId = UserId || SurveyUserId;

            function success(data) {
                if (data.RetCode == 0) {
                    setCookie('Survey_State_' + SurveyId, type)
                }
            }
            query(datas, success)
        }


        function showResearch() {
            addRecordQuery(3)
        }

        function closeResearch() {
            addRecordQuery(1)
        }

        function submitResearch() {
            addRecordQuery(0)
        }


        $('.icon__cross').click(function() {
            closeResearch()
            $('.survey-modal').removeClass('show');
        });

        $('.survey-link a').click(function() {
            submitResearch()
            $('.survey-modal').removeClass('show');
        });

        if (window.location.pathname != '/' && window.location.pathname != '/site/pro-notice/console.html') {
            UserId = getCookie('U_USER_ID')
            SurveyUserId = getCookie('Survey_User_ID')
            if (UserId || SurveyUserId) {
                getResearchQuery()
            } else {
                if (Fingerprint2) {
                    Fingerprint2.getV18(function(result, components) {
                        setCookie('Survey_User_ID', result);
                        SurveyUserId = result;
                        getResearchQuery()
                    })
                }
            }
        }
    });
</script>
<!-- 调研外链类型临时版本 -->
