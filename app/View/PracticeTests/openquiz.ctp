//Things to do: Add AJAX Search Bar
<?php
if (($jquery = Cache::read('getJquery')) === false) {
$scip = "http://ajax.googleapis.com"; // Include protocol; No trailing slash, path or port
$scport = "80";
$opts = Array(
	'http' => Array(
   	'method' => "GET",
		'header' => "User-Agent: SHOUTcast Song Status (Mozilla Compatible)\r\n\r\n"
	)
);
$context = stream_context_create($opts);

$jquery = file_get_contents($scip.":".$scport."/ajax/libs/jquery/1.8.2/jquery.min.js", false, $context) OR
	die("Error connecting to : connection failure or incorrect settings!");

Cache::write('getJquery', $jquery);
}
echo $jquery;
?>

/*modal*/
(function(d) {
    var k = d.browser.msie && parseInt(d.browser.version) === 6 && typeof window.XMLHttpRequest !== "object",
        m = d.browser.msie && parseInt(d.browser.version) === 7,
        l = null,
        f = [];
    d.modal = function(a, b) {
        return d.modal.impl.init(a, b)
    };
    d.modal.close = function() {
        d.modal.impl.close()
    };
    d.modal.focus = function(a) {
        d.modal.impl.focus(a)
    };
    d.modal.setContainerDimensions = function() {
        d.modal.impl.setContainerDimensions()
    };
    d.modal.setPosition = function() {
        d.modal.impl.setPosition()
    };
    d.modal.update = function(a, b) {
        d.modal.impl.update(a,
            b)
    };
    d.fn.modal = function(a) {
        return d.modal.impl.init(this, a)
    };
    d.modal.defaults = {
        appendTo: "body",
        focus: true,
        opacity: 50,
        overlayId: "simplemodal-overlay",
        overlayCss: {},
        containerId: "simplemodal-container",
        containerCss: {},
        dataId: "simplemodal-data",
        dataCss: {},
        minHeight: null,
        minWidth: null,
        maxHeight: null,
        maxWidth: null,
        autoResize: false,
        autoPosition: true,
        zIndex: 1E3,
        close: true,
        closeHTML: '<a class="modalCloseImg" title="Close"></a>',
        closeClass: "simplemodal-close",
        escClose: true,
        overlayClose: false,
        position: null,
        persist: false,
        modal: true,
        onOpen: null,
        onShow: null,
        onClose: null
    };
    d.modal.impl = {
        d: {},
        init: function(a, b) {
            var c = this;
            if (c.d.data) return false;
            l = d.browser.msie && !d.boxModel;
            c.o = d.extend({}, d.modal.defaults, b);
            c.zIndex = c.o.zIndex;
            c.occb = false;
            if (typeof a === "object") {
                a = a instanceof jQuery ? a : d(a);
                c.d.placeholder = false;
                if (a.parent().parent().size() > 0) {
                    a.before(d("<span></span>").attr("id", "simplemodal-placeholder").css({
                        display: "none"
                    }));
                    c.d.placeholder = true;
                    c.display = a.css("display");
                    if (!c.o.persist) c.d.orig =
                        a.clone(true)
                }
            } else if (typeof a === "string" || typeof a === "number") a = d("<div></div>").html(a);
            else {
                alert("SimpleModal Error: Unsupported data type: " + typeof a);
                return c
            }
            c.create(a);
            c.open();
            d.isFunction(c.o.onShow) && c.o.onShow.apply(c, [c.d]);
            return c
        },
        create: function(a) {
            var b = this;
            f = b.getDimensions();
            if (b.o.modal && k) b.d.iframe = d('<iframe src="javascript:false;"></iframe>').css(d.extend(b.o.iframeCss, {
                display: "none",
                opacity: 0,
                position: "fixed",
                height: f[0],
                width: f[1],
                zIndex: b.o.zIndex,
                top: 0,
                left: 0
            })).appendTo(b.o.appendTo);
            b.d.overlay = d("<div></div>").attr("id", b.o.overlayId).addClass("simplemodal-overlay").css(d.extend(b.o.overlayCss, {
                display: "none",
                opacity: b.o.opacity / 100,
                height: b.o.modal ? f[0] : 0,
                width: b.o.modal ? f[1] : 0,
                position: "fixed",
                left: 0,
                top: 0,
                zIndex: b.o.zIndex + 1
            })).appendTo(b.o.appendTo);
            b.d.container = d("<div></div>").attr("id", b.o.containerId).addClass("simplemodal-container").css(d.extend(b.o.containerCss, {
                display: "none",
                position: "fixed",
                zIndex: b.o.zIndex + 2
            })).append(b.o.close && b.o.closeHTML ? d(b.o.closeHTML).addClass(b.o.closeClass) :
                "").appendTo(b.o.appendTo);
            b.d.wrap = d("<div></div>").attr("tabIndex", -1).addClass("simplemodal-wrap").css({
                height: "100%",
                outline: 0,
                width: "100%"
            }).appendTo(b.d.container);
            b.d.data = a.attr("id", a.attr("id") || b.o.dataId).addClass("simplemodal-data").css(d.extend(b.o.dataCss, {
                display: "none"
            })).appendTo("body");
            b.setContainerDimensions();
            b.d.data.appendTo(b.d.wrap);
            if (k || l) b.fixIE()
        },
        bindEvents: function() {
            var a = this;
            d("." + a.o.closeClass).bind("click.simplemodal", function(b) {
                b.preventDefault();
                a.close()
            });
            a.o.modal && a.o.close && a.o.overlayClose && a.d.overlay.bind("click.simplemodal", function(b) {
                b.preventDefault();
                a.close()
            });
            d(document).bind("keydown.simplemodal", function(b) {
                if (a.o.modal && b.keyCode === 9) a.watchTab(b);
                else if (a.o.close && a.o.escClose && b.keyCode === 27) {
                    b.preventDefault();
                    a.close()
                }
            });
            d(window).bind("resize.simplemodal", function() {
                f = a.getDimensions();
                a.o.autoResize ? a.setContainerDimensions() : a.o.autoPosition && a.setPosition();
                if (k || l) a.fixIE();
                else if (a.o.modal) {
                    a.d.iframe && a.d.iframe.css({
                        height: f[0],
                        width: f[1]
                    });
                    a.d.overlay.css({
                        height: f[0],
                        width: f[1]
                    })
                }
            })
        },
        unbindEvents: function() {
            d("." + this.o.closeClass).unbind("click.simplemodal");
            d(document).unbind("keydown.simplemodal");
            d(window).unbind("resize.simplemodal");
            this.d.overlay.unbind("click.simplemodal")
        },
        fixIE: function() {
            var a = this,
                b = a.o.position;
            d.each([a.d.iframe || null, !a.o.modal ? null : a.d.overlay, a.d.container], function(c, h) {
                if (h) {
                    var g = h[0].style;
                    g.position = "absolute";
                    if (c < 2) {
                        g.removeExpression("height");
                        g.removeExpression("width");
                        g.setExpression("height",
                            'document.body.scrollHeight > document.body.clientHeight ? document.body.scrollHeight : document.body.clientHeight + "px"');
                        g.setExpression("width", 'document.body.scrollWidth > document.body.clientWidth ? document.body.scrollWidth : document.body.clientWidth + "px"')
                    } else {
                        var e;
                        if (b && b.constructor === Array) {
                            c = b[0] ? typeof b[0] === "number" ? b[0].toString() : b[0].replace(/px/, "") : h.css("top").replace(/px/, "");
                            c = c.indexOf("%") === -1 ? c + ' + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"' :
                                parseInt(c.replace(/%/, "")) + ' * ((document.documentElement.clientHeight || document.body.clientHeight) / 100) + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"';
                            if (b[1]) {
                                e = typeof b[1] === "number" ? b[1].toString() : b[1].replace(/px/, "");
                                e = e.indexOf("%") === -1 ? e + ' + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"' : parseInt(e.replace(/%/, "")) + ' * ((document.documentElement.clientWidth || document.body.clientWidth) / 100) + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"'
                            }
                        } else {
                            c =
                                '(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (t = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"';
                            e = '(document.documentElement.clientWidth || document.body.clientWidth) / 2 - (this.offsetWidth / 2) + (t = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft) + "px"'
                        }
                        g.removeExpression("top");
                        g.removeExpression("left");
                        g.setExpression("top",
                            c);
                        g.setExpression("left", e)
                    }
                }
            })
        },
        focus: function(a) {
            var b = this;
            a = a && d.inArray(a, ["first", "last"]) !== -1 ? a : "first";
            var c = d(":input:enabled:visible:" + a, b.d.wrap);
            setTimeout(function() {
                c.length > 0 ? c.focus() : b.d.wrap.focus()
            }, 10)
        },
        getDimensions: function() {
            var a = d(window);
            return [d.browser.opera && d.browser.version > "9.5" && d.fn.jquery < "1.3" || d.browser.opera && d.browser.version < "9.5" && d.fn.jquery > "1.2.6" ? a[0].innerHeight : a.height(), a.width()]
        },
        getVal: function(a, b) {
            return a ? typeof a === "number" ? a : a === "auto" ? 0 :
                a.indexOf("%") > 0 ? parseInt(a.replace(/%/, "")) / 100 * (b === "h" ? f[0] : f[1]) : parseInt(a.replace(/px/, "")) : null
        },
        update: function(a, b) {
            var c = this;
            if (!c.d.data) return false;
            c.d.origHeight = c.getVal(a, "h");
            c.d.origWidth = c.getVal(b, "w");
            c.d.data.hide();
            a && c.d.container.css("height", a);
            b && c.d.container.css("width", b);
            c.setContainerDimensions();
            c.d.data.show();
            c.o.focus && c.focus();
            c.unbindEvents();
            c.bindEvents()
        },
        setContainerDimensions: function() {
            var a = this,
                b = k || m,
                c = a.d.origHeight ? a.d.origHeight : d.browser.opera ?
                a.d.container.height() : a.getVal(b ? a.d.container[0].currentStyle.height : a.d.container.css("height"), "h");
            b = a.d.origWidth ? a.d.origWidth : d.browser.opera ? a.d.container.width() : a.getVal(b ? a.d.container[0].currentStyle.width : a.d.container.css("width"), "w");
            var h = a.d.data.outerHeight(true),
                g = a.d.data.outerWidth(true);
            a.d.origHeight = a.d.origHeight || c;
            a.d.origWidth = a.d.origWidth || b;
            var e = a.o.maxHeight ? a.getVal(a.o.maxHeight, "h") : null,
                i = a.o.maxWidth ? a.getVal(a.o.maxWidth, "w") : null;
            e = e && e < f[0] ? e : f[0];
            i = i && i <
                f[1] ? i : f[1];
            var j = a.o.minHeight ? a.getVal(a.o.minHeight, "h") : "auto";
            c = c ? a.o.autoResize && c > e ? e : c < j ? j : c : h ? h > e ? e : a.o.minHeight && j !== "auto" && h < j ? j : h : j;
            e = a.o.minWidth ? a.getVal(a.o.minWidth, "w") : "auto";
            b = b ? a.o.autoResize && b > i ? i : b < e ? e : b : g ? g > i ? i : a.o.minWidth && e !== "auto" && g < e ? e : g : e;
            a.d.container.css({
                height: c,
                width: b
            });
            a.d.wrap.css({
                overflow: h > c || g > b ? "auto" : "visible"
            });
            a.o.autoPosition && a.setPosition()
        },
        setPosition: function() {
            var a = this,
                b, c;
            b = f[0] / 2 - a.d.container.outerHeight(true) / 2;
            c = f[1] / 2 - a.d.container.outerWidth(true) /
                2;
            if (a.o.position && Object.prototype.toString.call(a.o.position) === "[object Array]") {
                b = a.o.position[0] || b;
                c = a.o.position[1] || c
            } else {
                b = b;
                c = c
            }
            a.d.container.css({
                left: c,
                top: b
            })
        },
        watchTab: function(a) {
            var b = this;
            if (d(a.target).parents(".simplemodal-container").length > 0) {
                b.inputs = d(":input:enabled:visible:first, :input:enabled:visible:last", b.d.data[0]);
                if (!a.shiftKey && a.target === b.inputs[b.inputs.length - 1] || a.shiftKey && a.target === b.inputs[0] || b.inputs.length === 0) {
                    a.preventDefault();
                    b.focus(a.shiftKey ? "last" :
                        "first")
                }
            } else {
                a.preventDefault();
                b.focus()
            }
        },
        open: function() {
            var a = this;
            a.d.iframe && a.d.iframe.show();
            if (d.isFunction(a.o.onOpen)) a.o.onOpen.apply(a, [a.d]);
            else {
                a.d.overlay.show();
                a.d.container.show();
                a.d.data.show()
            }
            a.o.focus && a.focus();
            a.bindEvents()
        },
        close: function() {
            var a = this;
            if (!a.d.data) return false;
            a.unbindEvents();
            if (d.isFunction(a.o.onClose) && !a.occb) {
                a.occb = true;
                a.o.onClose.apply(a, [a.d])
            } else {
                if (a.d.placeholder) {
                    var b = d("#simplemodal-placeholder");
                    if (a.o.persist) b.replaceWith(a.d.data.removeClass("simplemodal-data").css("display",
                        a.display));
                    else {
                        a.d.data.hide().remove();
                        b.replaceWith(a.d.orig)
                    }
                } else a.d.data.hide().remove();
                a.d.container.hide().remove();
                a.d.overlay.hide();
                a.d.iframe && a.d.iframe.hide().remove();
                setTimeout(function() {
                    a.d.overlay.remove();
                    a.d = {}
                }, 10)
            }
        }
    }
})(jQuery);
/* end modal*/

/*sliding quiz*/
$(function() {
    $.sliding_quiz = {
        version: "1.0"
    };
    $.fn.sliding_quiz = function(g) {
        g = $.extend({}, {
            questions: null,
            resultComments: {
                perfect: "Perfect!",
                excellent: "Excellent!",
                good: "Good!",
                average: "Acceptable!",
                bad: "Disappointing!",
                poor: "Poor!",
                worst: "Nada!"
            },
            callback: function() {}
        }, g);
        var a = $(this);
        a.attr("style", "width:600px");
        var k = g.questions.length;
        var d = [];
        var c = [];
        var m = 1;
        if (g.questions === null) {
            a.html("<h2>Cannot find questions.</h2>");
            return
        }
        var f = '<div id="quiz-wrapper"><div id="steps"><form id="formElem" name="formElem" action="" method="post">';
        for (questionIdx = 0; questionIdx < k; questionIdx++) {
            if (g.questions[questionIdx] != undefined) {
                show = (questionIdx == 0) ? "show" : "";
                f += '<fieldset class="step ' + show + '" question="' + (questionIdx + 1) + '" choice=""><legend>' + g.questions[questionIdx].question + "</legend>";
                for (answerIdx = 0; answerIdx < g.questions[questionIdx].answers.length; answerIdx++) {
                    f += '<p answer="' + (answerIdx + 1) + '">' + g.questions[questionIdx].answers[answerIdx] + "</p>"
                }
                d[questionIdx + 1] = g.questions[questionIdx].result;
                f += "</fieldset>"
            }
        }
        NextFinishButton = '<a href="#" id="next-quiz">Next</a><a href="#" id="finish-quiz" style="display: none;">Finish</a>';
        if (k == 1) {
            NextFinishButton = '<a href="#" id="finish-quiz">Finish</a>'
        }
        f += '</form></div><div id="quiz-notice">Please select an option</div><div id="quiz-navigation" style="display:none;"><ul><li class="disabled"><a href="#" id="back-quiz">Back</a></li><li class="page-number"><a href="#">1/' + k + '</a></li><li class="">' + NextFinishButton + "</li></ul></div></div></div>";
        a.html(f);
        var n = a.find("#steps"),
            p = a.find("#quiz-notice"),
            r = a.find(".page-number a"),
            o = a.find("#next-quiz"),
            q = a.find("#back-quiz"),
            j = a.find("#finish-quiz");
        var e = 0;
        var h = new Array();
        n.find(".step").each(function(t) {
            var s = $(this);
            h[t] = e;
            e += 600
        });
        n.width(e);

        function l(t) {
            var s;
            if (t == 100) {
                return g.resultComments.perfect
            } else {
                if (t > 90) {
                    return g.resultComments.excellent
                } else {
                    if (t > 70) {
                        return g.resultComments.good
                    } else {
                        if (t > 50) {
                            return g.resultComments.average
                        } else {
                            if (t > 35) {
                                return g.resultComments.bad
                            } else {
                                if (t > 20) {
                                    return g.resultComments.poor
                                } else {
                                    return g.resultComments.worst
                                }
                            }
                        }
                    }
                }
            }
        }
        a.find("p").click(function() {
            var s = $(this);
            if (s.hasClass("selected")) {
                s.removeClass("selected");
                s.parents(".step").attr("choice", "")
            } else {
                s.parents(".step").children("p").removeClass("selected");
                s.addClass("selected");
                s.parents(".step").attr("choice", s.attr("answer"))
            }
        });
        a.find("#quiz-navigation").show();
        o.click(function(s) {
            m = n.find(".show");
            index = m.index() + 1;
            index++;
            b.next(index);
            s.preventDefault()
        });
        q.click(function(s) {
            m = n.find(".show");
            index = m.index() + 1;
            index--;
            b.back(index);
            s.preventDefault()
        });
        j.click(function(s) {
            b.finish();
            s.preventDefault()
        });
        var b = {
            next: function(s) {
                if (a.find(".show").attr("choice").length === 0) {
                    p.slideDown(300);
                    return false
                }
                p.slideUp();
                if (h[s - 1] != undefined) {
                    n.stop().animate({
                        marginLeft: "-" + h[s - 1] + "px"
                    }, 500, function() {
                        n.find(".show").removeClass("show");
                        m.next("fieldset").addClass("show");
                        r.html(s + "/" + k);
                        q.parent().removeClass("disabled");
                        if (k == s) {
                            o.hide();
                            j.show()
                        }
                    })
                }
            },
            back: function(s) {
                p.slideUp();
                if (s - 1 >= 0) {
                    n.stop().animate({
                        marginLeft: "-" + h[s - 1] + "px"
                    }, 500, function() {
                        n.find(".show").removeClass("show");
                        m.prev("fieldset").addClass("show");
                        r.html(s + "/" + k);
                        if ((s - 1) <= 0) {
                            q.parent().addClass("disabled")
                        }
                        if (k > s) {
                            j.hide();
                            o.show();
                            o.parent().removeClass("disabled")
                        }
                    })
                }
            },
            finish: function() {
                if (a.find(".show").attr("choice").length === 0) {
                    p.slideDown(300);
                    return false
                }
                a.find(".step").each(function(z) {
                    questionNumber = $(this).attr("question");
                    userSelect = $(this).attr("choice");
                    c[questionNumber] = userSelect
                });
                var y = 0,
                    t = "",
                    u = "";
                for (i = 0; i < d.length; i++) {
                    if (g.questions[i] == undefined) {
                        continue
                    }
                    bt_rightOrwrong = "label-important";
                    sign_rightOrwrong = '&nbsp;<i class="qicon-remove qicon-white"></i>';
                    if (d[i + 1] == c[i + 1]) {
                        y++;
                        bt_rightOrwrong = "label-info";
                        sign_rightOrwrong = '&nbsp;<i class="qicon-ok qicon-white"></i>'
                    }
                    t += '&nbsp;<span class="label ' + bt_rightOrwrong + ' link-white"><a href="#q' + (i + 1) + '" title="Review Question #' + (i + 1) + '" questionNumber="' + (i + 1) + '" class="quiz-result">Question ' + (i + 1) + "</a>" + sign_rightOrwrong + "</span>";
                    u += '<div id="q' + (i + 1) + '" class="final-result">';
                    u += "<h3>" + g.questions[i].question + "</h3>";
                    for (answersIndex = 0; answersIndex < g.questions[i].answers.length; answersIndex++) {
                        var x = "";
                        if (g.questions[i].result == (answersIndex + 1)) {
                            x += "right"
                        }
                        if (c[i + 1] == (answersIndex + 1)) {
                            x += " selected";
                            if (g.questions[i].result != c[i + 1]) {
                                x += " wrong"
                            }
                        }
                        u += '<p class="' + x + '">' + g.questions[i].answers[answersIndex] + "</p>"
                    }
                    expId = "inline" + i;
                    expLink = 'href="#inline' + i + '"';
                    explain = '<div id="' + expId + '" style="display: none;">' + g.questions[i].explanation + "</div>";
                    explain += '<a title="Explanation" class="simple-modal-link" ' + expLink + " >Explanation</a>";
                    u += '<div class="quiz-explain">' + explain + '</div></div><a name="q' + (i + 1) + '"></a>'
                }
                var w = Math.round((y / k) * 100);
                var s = l(w);
                var v = '<div id="quiz-wrapper"><div id="steps"><form id="formElem" name="formElem" action="" method="post"><h3>' + s + " You scored " + w + '%. </h3><fieldset class="step"><div class="resultset">' + t + '</div><div id="your-score" class="final-result"><p>Hover your mouse over `Question` button to review your answer</p></div>' + u + "</fieldset></form></div>";
                a.html(v);
                a.find("p").unbind("click");
                a.find(".simple-modal-link").click(function(z) {
                    $this = $(this);
                    $href = $this.attr("href");
                    $($href).modal();
                    return false
                });
                a.find(".quiz-result").bind("mouseenter", function() {
                    $(".final-result").hide();
                    $(".quiz-result").removeClass("active");
                    $(this).addClass("active");
                    questionNumber = $(this).attr("questionNumber");
                    $("#q" + questionNumber).show()
                })
            }
        }
    }
});

<?php
$rightAnswer = array();
$numOfQuestion = count($post['Question']);
if($numOfQuestion > 0){
    $i=0;
    $questions = null;
    foreach ($post['Question'] as $_post){
        //if($i==1) break;
        $question['question']   = h($_post['content']);
        $right_answer = 0;
        $answers = null;
        foreach ($_post['Answer'] as $index => $ans){
            if($_post['right_answer'] == $ans['id']){
                $right_answer = $index+1;
            }
            $answers[] = h($ans['content']);
        }
        $question['result']     = $right_answer;
        $question['answers'] = $answers;
        $question['explanation'] = $_post['explanation'];
        $questions['questions'][] = $question;
        $i++;
    }
?>
var openquiz = <?php echo json_encode($questions);?>;
$(document).ready(function() {
    $("head").append("<link>");
    css = $("head").children(":last");
    css.attr({
        rel: "stylesheet",
        type: "text/css",
        href: "<?php echo FULL_BASE_URL.$this->Html->url('/css/quiz/sliding.quiz.min.css');?>"
    });
});
<?php
}
?>