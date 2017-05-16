/* globals $:false */
var width,
    height,
    clientMoved = false,
    posX, posY,
    index, isSafari;

function getRandomPosition(element, wmin, wmax) {
    element.each(function() {
        var w = $(this).data("width"),
            h = $(this).data("height"),
            offset = 10,
            ratio = w / h,
            new_W = rand(wmin, wmax).toFixed(),
            new_H = (new_W / ratio).toFixed();
        $(this).css({
            width: new_W + "px",
            height: new_H + "px"
        });
        offX = rand(offset, width - new_W - offset);
        offY = rand(offset, height - new_H - offset);
        TweenLite.set($(this), {
            transformOrigin: 'left top',
            top: offY,
            left: offX,
            y: '-10px'
        });
    });
}

function sizeSet() {
    width = $(window).width();
    height = $(window).height();
    //getRandomPosition($('#minitel .image_container .image'), 150, width / 4);
    // $('.mntl-title').css({
    //     top: height / 2-50,
    //     left: width / 2
    // });
}

// function forceRedraw(element) {
//     if (!element) {
//         return;
//     }
//     // element.data('sizes', 'auto');
//     element.attr('sizes', '');
//     element.removeClass('lazyautosizes lazyloaded').addClass('lazyload');
// }

function query(selector, el) {
    if (!el) {
        el = document;
    }
    return el.querySelector(selector);
}

function $$(selector, el, cb) {
    if (!el) {
        el = document;
    }
    var elts = el.querySelectorAll(selector);
    if (cb)[].forEach.call(elts, cb);
    return elts;
}
$(function() {
    var app = {
        init: function() {}
    };
    app.init();
});

function rand(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function arrayRand(myArray) {
    var rand = myArray[Math.floor(Math.random() * myArray.length)];
    return rand;
}
// Thumbnails display / hide functions
var displayImage = function(image) {
    image.classList.add('displayed');
};
var openProject = function(project) {
    var img = project.find('.project_image'),
        totalimg = img.length,
        j = 0;
    if (project.hasClass('opened')) {
        serialDisplayImage = function(image) {
            return function() {
                displayImage(image);
            };
        };
        while (j < totalimg) {
            window.setTimeout(serialDisplayImage(img[j]), 80 * j);
            j++;
        }
    } else {
        img.removeClass('displayed');
    }
};

function init() {
    isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
    $(window).load(function() {
        $(".loader").fadeOut("fast");
        hasher.init();
    });
    $(window).scroll(function(event) {
      if ($(window).scrollTop() > 100) {
        clientMoved = true;
      }
    });
    setTimeout(function(){
      if (!clientMoved) {
        $('nav.mainmenu').addClass('is-visible');
      }
    },8000);
    $(window).mousemove(function(event) {
        posX = event.pageX;
        posY = event.pageY;
        if (posY < 100) {
            $('nav.mainmenu').addClass('is-visible');
        } else if (!$('body').hasClass('inWork')) {
            $('nav.mainmenu').removeClass('is-visible');
        }
        $('.thumbnail_hover').css({
            'top': posY + 'px',
            'left': posX + 'px'
        });
    });
    $(window).resize(function(event) {
        sizeSet();
    });
    $(document).ready(function($) {
        sizeSet();
        $('#mce-error-response, #mce-success-response').bind("DOMSubtreeModified", function() {
            $('ul.subscribe .mc-field-group, ul.subscribe .title').hide();
        });
        $('.credits h1').click(function(event) {
            $('.credits .content').slideToggle();
        });
        if (!$('body').hasClass('no-touchevents')) {
            $('.skill').click(function(event) {
                var $filter = $(this).data('filter');
                $('.category[data-filter="' + $filter + '"]').prev().click();
            });
            $('.skill').hover(function() {
                var cat = $(this).data('filter');
                var image = arrayRand(landing_images[cat]);
                // pos = arrayRand(['top', 'center', 'bottom']),
                // w = 50,
                // right = rand(0, 50);
                // $backImage = $('<div class="backImage" style="background-image: url(' + image + '); background-position: ' + pos + '; right:' + right + '%; width:' + w + '%"></div>').appendTo('.visualBack');
                $backImage = $('<img class="backImage" src="' + image[0] + '" data-width="' + image[1] + '" data-height="' + image[2] + '">').appendTo('.visualBack');
                getRandomPosition($backImage, width / 4, width / 3);
                //var image = arrayRand(landing_images),
                //pos = arrayRand(['top','center','bottom']),
                //w = rand(30, 50),
                //X = Math.round((posX / width) * 100);
                // if (posX <= 50) {
                //     $backImage = $('<div class="backImage" style="background-image: url(' + image + '); left:' + X + '%; width:' + w + '%"></div>').appendTo('.visualBack');
                // } else {
                //     $backImage = $('<div class="backImage" style="background-image: url(' + image + '); right:' + X + '%; width:' + w + '%"></div>').appendTo('.visualBack');
                // }
                TweenLite.fromTo($backImage, 0.3, {
                    y: "-10px",
                    opacity: 0
                }, {
                    y: "0px",
                    opacity: 1
                });
            }, function() {
                $backImage.addClass('animated fadeOut').delay(10000).queue(function() {
                    $(this).remove();
                });
                TweenLite.fromTo($backImage, 0.3, {
                    //scale: 1,
                    zIndex: 0
                }, {
                    //scale: 0.9,
                    zIndex: -1
                });
            });
        }
    });
    $(document).ready(function($) {
        $projects = $(".project");
        $(".project_image").click(function(event) {
            //var thumb = $(this).find('.thumb');
            // if ($(this).hasClass('closed')) {
            //     thumb.attr("src", thumb.attr('data-src-hd'));
            //     $(this).toggleClass('opened closed');
            // } else {
            //     thumb.attr("src", thumb.attr('data-src-low'));
            //     $(this).toggleClass('opened closed');
            // }
            $(this).toggleClass('opened closed');
            // if (isSafari) {
            //     forceRedraw($(this).find('img'));
            // }
        });
        // Selector
        $(".category, ul.nav_categories .after").click(function(event) {
            if ($(this).is('li')) {
                var $selected = $(this);
            } else {
                var $selected = $(".category.enabled");
            }
            var divs = $selected.parent().children('li');
            $(".category").removeClass("enabled");
            $activeCat = divs.eq((divs.index($selected) + 1) % divs.length).addClass("enabled");
            $projects.removeClass('opened disabled');
            $(".projects").removeClass('image_mode');
            $selector = $activeCat.attr('data-filter');
            if ($selector != "everything") {
                if ($selector == "visuals") {
                    $(".projects").addClass('image_mode');
                } else {
                    $(".project:not(." + $selector + ")").addClass('disabled');
                }
            }
        });
        $("ul.nav_categories .before").click(function(event) {
            var $selected = $(".category.enabled");
            var divs = $selected.parent().children('li');
            $(".category").removeClass("enabled");
            $activeCat = divs.eq((divs.index($selected) - 1) % divs.length).addClass("enabled");
            $projects.removeClass('opened disabled');
            $(".projects").removeClass('image_mode');
            $selector = $activeCat.attr('data-filter');
            if ($selector != "everything") {
                if ($selector == "visuals") {
                    $(".projects").addClass('image_mode');
                } else {
                    $(".project:not(." + $selector + ")").addClass('disabled');
                }
            }
        });
        $(".categories .all, section.about button.arrow").click(function(event) {
            $projects.removeClass('opened disabled');
            $(".category").removeClass('enabled');
            $(".category").first().addClass('enabled');
            $projects.removeClass('disabled');
            $(".projects").removeClass('image_mode');
        });
    });
    jQuery(document).ready(function($) {
        $.jStorage.flush();
        $('.project .portfolio_select').click(function(event) {
            var project = $(this).closest('.project');
            var uid = project.data('title');
            var value = $.jStorage.get(uid);
            if (value) {
                project.removeClass('pdf_select');
                $.jStorage.deleteKey(uid);
            } else {
                project.addClass('pdf_select');
                $.jStorage.set(uid, 'selected');
            }
            index = $.jStorage.index();
            console.log(index); // ["key1","key2","key3"]
            if (index.length == 0) {
                $('section.work').removeClass('portfolioActive');
            } else {
                $('section.work').addClass('portfolioActive');
            }
        });
        $('.pdf_download').click(function(event) {
            console.log(index);
            window.open('pdf?projects=' + JSON.stringify(index), '_blank');
        });
    });
    jQuery(document).ready(function($) {
        $("#collab_form").on('submit', function(e) {
            e.preventDefault(); // prevent native submit
            $(this).ajaxSubmit({
                target: '#result',
                success: function() {
                    $("section.collab").addClass('submitted');
                }
            });
        });
    });
    // HASH
    jQuery(document).ready(function($) {
        var hash;

        function handleChanges(newHash, oldHash) {
            console.log(newHash);
            hash = hasher.getHashAsArray();
            var element = $('*[data-target="' + newHash + '"]');
            if (hash[0] == "page") {
                if (hash[1] == "landing") {
                    if (oldHash == null) {
                        $.scrollTo($("#" + hash[1]), 0, {
                            offset: 1
                        });
                    }
                }
                if (hash[1] == "work" && oldHash == null || hash[1] == "work" && hash[2] == null) {
                    if (oldHash == null) {
                        $.scrollTo($("#" + hash[1]), 0, {
                            offset: 1
                        });
                    }
                    if (hash[2] != null) {
                        element.closest('.project:not(".disabled")').toggleClass('opened');
                        openProject(element.closest('.project:not(".disabled")'));
                    }
                }
                if (hash[1] == "collab") {
                    if (oldHash == null) {
                        $.scrollTo($("#" + hash[1]), 0, {
                            offset: 1
                        });
                    }
                }
                if (hash[1] == "contact") {
                    if (oldHash == null) {
                        $.scrollTo($("#" + hash[1]), 0, {
                            offset: 1
                        });
                    }
                }
                if (hash[1] == "3615") {
                    startMinitel();
                }
            }
        }
        hasher.changed.add(handleChanges);
        hasher.initialized.add(handleChanges);
        hasher.prependHash = '!/';
        $('[data-target="page/collab/form"]').hover(function(e) {
            $el = $(this);
            e.preventDefault();
            hasher.setHash($(this).data('target'));
        });
        $('[data-target]').bind('click', function(e) {
            $el = $(this);
            e.preventDefault();
            if ($el.closest('.project').hasClass('disabled')) {
                $projects.removeClass('opened disabled');
                $(".category").removeClass('enabled');
                $(".category").first().addClass('enabled');
                $projects.removeClass('disabled');
                $(".projects").removeClass('image_mode');
            } else {
                hasher.setHash($(this).data('target'));
            }
            if ($el.is('li')) {
                $.scrollTo($("#" + hash[1]), 1000, {
                    offset: 1
                });
            }
            if ($el.is('.logo')) {
                $.scrollTo(0, 1000, {
                    offset: 1
                });
            }
            if ($el.is('.project_title')) {
                //Close others projects on click
                //$projects.removeClass('opened');
                //openProject($projects);
                $el.closest('.project:not(".disabled")').toggleClass('opened');
                openProject($el.closest('.project:not(".disabled")'));
            }
        });
    });
    //SCROLL MAGIC
    jQuery(document).ready(function($) {
        // $('.container').snapscroll({
        //     scrollSpeed: 800,
        //     topPadding: 300
        // });
        var controller = new ScrollMagic.Controller({
            globalSceneOptions: {
                reverse: true
            }
        });
        $('#about').on('click', function(event) {
            clientMoved = true;
            event.preventDefault();
            $.scrollTo($("#work"), 1000, {
                offset: 1
            });
        });
        // setTimeout(function() {
        //     if (!clientMoved) {
        //         clientMoved = true;
        //         $('body, html').animate({
        //             scrollTop: height / 2 + 1
        //         }, 1000);
        //     }
        // }, 1000);
        // new ScrollMagic.Scene({
        //     triggerElement: "#landing",
        //     triggerHook: 0
        // }).setClassToggle("body", "inLanding").on('start', function() {
        //     //hasher.setHash('page/landing');
        // }).addTo(controller);
        var tweenProjects = TweenMax.staggerFromTo(".projects .project", 0.1, {
            y: "-10px",
            opacity: 0
        }, {
            y: "0px",
            opacity: 1
        }, 0.06);
        new ScrollMagic.Scene({
            triggerElement: "#work",
            triggerHook: 0.9
        }).setClassToggle("nav.mainmenu", "is-visible").setTween("section.about button.arrow", 0.3, {
            opacity: 0
        }).addTo(controller);
        new ScrollMagic.Scene({
            triggerElement: "#about",
            triggerHook: 0.6
        }).setClassToggle("body", "inAbout").on('enter', function() {
            //hasher.setHash('page/about');
        }).addTo(controller);
        new ScrollMagic.Scene({
            triggerElement: "#work",
            triggerHook: 0.6
        }).setClassToggle("body", "inWork").on('enter', function() {
            //hasher.setHash('page/work');
        }).addTo(controller);
        new ScrollMagic.Scene({
            triggerElement: "#work",
            triggerHook: 0.6
        }).setTween(tweenProjects).addTo(controller);
        new ScrollMagic.Scene({
            triggerElement: "#collab",
            triggerHook: 0.6
        }).setClassToggle("body", "inCollab").on('enter', function() {
            //hasher.setHash('page/collab');
        }).addTo(controller);
        new ScrollMagic.Scene({
            triggerElement: "#collab",
            triggerHook: 0.4,
            duration: height / 2.5
        }).setTween("#collab form", {
            opacity: 1
        }).addTo(controller);
        new ScrollMagic.Scene({
            triggerElement: "#contact",
            triggerHook: 0.6
        }).setClassToggle("body", "inContact").on('enter', function() {
            //hasher.setHash('page/contact');
        }).addTo(controller);
        // new ScrollMagic.Scene({
        //     triggerElement: "document",
        //     duration: height / 2
        // })
        // .setPin("section.landing .logo").setTween("section.landing .intro p", { opacity: 1})
        // .addTo(controller);
    });
    //MINITEL
    var colors = ['#e2f2f9', '#f1eae2', '#dbe5e4', '#fae8e0', '#f1dfdf', '#e6ecf3', '#e1e1e1'];
    var dialup = new Audio('assets/3615/dial.mp3');
    var sliding = ['top', 'bottom', 'left', 'right'];
    var zIndex = 0;

    function startMinitel() {
        hasher.setHash('page/3615');
        loadImages();
        loadImages();
        dialup.play();
        // setTimeout(function() {
        //     ambient.play();
        // }, 3500);
        zIndex = 0;
        TweenLite.to($minitel, 4, {
            height: "100%",
            ease: SteppedEase.config(20),
            onStart: function() {
                TweenLite.set($minitel, {
                    'autoAlpha': 1
                });
            }
        });
    }

    function exitMinitel() {
        // ambient.pause();
        // ambient.currentTime = 0;
        hasher.setHash('page');
        TweenLite.to($minitel, 2, {
            height: "0%",
            ease: SteppedEase.config(10),
            onComplete: function() {
                TweenLite.set($minitel, {
                    'autoAlpha': 0
                });
            }
        });
    }

    function loadImages() {
        $minitel_container.find(".image").slice(0, -6).addClass('trash');
        $.ajax({
            url: "3615/get_images.php",
            dataType: "html",
            success: function(data) {
                $("#minitel .image_container").append(data);
                sizeSet();
                var images = $minitel_container.find('.image.new').removeClass('new');
                getRandomPosition(images, 150, width / 4);
                images.resizable({
                    handles: "n,s,e,w",
                    constrainTo: "parent",
                    autoHide: !0,
                    aspectRatio: !0,
                    minHeight: 100,
                    minWidth: 100,
                    maxHeight: 800,
                    maxWidth: 800
                });
                images.pep({
                    useCSSTranslation: !1,
                    initiate: function() {
                        zIndex++;
                        this.$el.css({
                            zIndex: zIndex
                        })
                    },
                    start: function(b, a) {
                        $(b.target).hasClass("ui-resizable") && a.options.stop()
                    },
                    stop: function() {
                        this.$el.append("");
                    }
                });
                $back = $('<div class="background appear ' + arrayRand(sliding) + '"></div>').css('background', arrayRand(colors)).appendTo($minitel_background);
                $trash = $('#minitel .image_container .trash');
                TweenLite.to(images, 1, {
                    opacity: "1",
                    y: '10px'
                });
                TweenLite.to($trash, 1, {
                    opacity: "0",
                    y: '-10px',
                    onComplete: function() {
                        $trash.remove();
                    }
                });
            }
        });
    }
    jQuery(document).ready(function($) {
        $minitel = $('section#minitel');
        $minitel_container = $("#minitel .image_container");
        $minitel_background = $("#minitel .back");
        marqueeInit({
            uniqueid: 'mntl-crawler',
            style: {
                'position': 'fixed',
                'padding': '10px',
                'top': '-15px',
                'height': '40px',
                'width': '100%'
            },
            inc: 2,
            'mouse': false
        });
        var mntlOpen = $('.mntl-crawler');
        mntlOpen.click(function(event) {
            startMinitel();
        });
        $('.mntl-title, .mntl-suite').click(function(event) {
            loadImages();
        });
        $('.mntl-logo, .mntl-retour').click(function(event) {
            exitMinitel();
        });
    });
}
init();