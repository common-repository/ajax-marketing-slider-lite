jQuery(document).ready(function($) {

    var support = { animations: Modernizr.cssanimations },

        animEndEventNames = { 'WebkitAnimation': 'webkitAnimationEnd', 'OAnimation': 'oAnimationEnd', 'msAnimation': 'MSAnimationEnd', 'animation': 'animationend' },

        animEndEventName = animEndEventNames[Modernizr.prefixed('animation')],

        effectSel = document.getElementById('fxselect'),

        component = document.getElementById('soasl_ultimate_container'),

        items = component.querySelector('ul.itemwrap').children,

        current = 0,

        itemsCount = items.length,

        navNext = component.querySelector('#soaslNext'),

        navPrev = component.querySelector('#soaslPrev'),

        isAnimating = false;

    function init() {
        navNext.addEventListener('click', function(ev) {
            ev.preventDefault();

            navigate('next');
        });

        navPrev.addEventListener('click', function(ev) {
            ev.preventDefault();

            navigate('prev');
        });
    }
    //Auto Slide Start
    if (soaslAutoSlide == 'true') {
        window.setInterval(function() {
            navigate('next');
        }, soaslAutoSlideInterval);
    }

    function hideNav() { nav.style.display = 'none'; }



    function showNav() { nav.style.display = 'block'; }



    function initial_posts_load() {

        $('#soasl_ultimate_container').height(usrSpecifiedHeight);

        jQuery.ajax({
            url: soasl_ajax.ajaxUrl,
            type: 'POST',
            data: { action: 'load_post_ids', soaslid: soaslID, security: soasl_ajax.ajax_nonce },
            success: function(data) {
                localStorage['returned_postIds'] = JSON.stringify(eval(data));
                get_next_post(slideLocator);
            }
        });

    }

    initial_posts_load();

    var index = 0;

    var previousIndex = function(index, length) {

        if (index <= 0) {

            return length - 1;
        } else {

            return index - 1;
        }
    };

    var nextIndex = function(index, length) {

        return ((index + 1) % length)
    };



    get_next_post = function(ref, type) {
        $('#soasl_reviews_' + ref).hide();
        var items = "";
        var allPostIds = $.parseJSON(localStorage['returned_postIds']);
        if (type == 0) { index = 0; } else { index = nextIndex(index, allPostIds.length); }
        $.ajax({
            url: soasl_ajax.ajaxUrl,
            type: 'POST',
            dataType: 'json',
            data: { action: 'soasl_get_post_content', id: allPostIds[index], soaslid: soaslID, security: soasl_ajax.ajax_nonce },

            success: function(msg) {

                $('.soaslheaderbg .soasl_post_url_' + ref).text(msg.title);

                $('#soasl_post_content_' + ref).text(msg.content);

                $('.soasl_post_url_' + ref).attr({ href: msg.post_url });

                $('#soasl_buttons_container_' + ref).show();

                $('#soasl_main_img_' + ref).html('');

                $('#soasl_main_img_' + ref).html('<img src="' + msg.thumb + '" alt="" title="" class="SoaslMainFeatured" id="soasl_main_img_' + ref + '" />');

                items += allPostIds[index];

                localStorage['currently_viewing_item'] = items;
            }

        });

    }

    function hideButtonsContainer(ref) {

        if (ref == 1) {
            $('#soasl_buttons_container_2').hide();

            $('#soasl_buttons_container_3').hide();
        } else if (ref == 2) {
            $('#soasl_buttons_container_1').hide();

            $('#soasl_buttons_container_3').hide();
        } else {
            $('#soasl_buttons_container_1').hide();

            $('#soasl_buttons_container_2').hide();
        }
    }

    function get_prev_post(ref) {

        var items = "";

        var allPostIds = $.parseJSON(localStorage['returned_postIds']);

        index = previousIndex(index, allPostIds.length);

        $.ajax({

            url: soasl_ajax.ajaxUrl,

            type: 'POST',

            dataType: 'json',

            data: { action: 'soasl_get_post_content', id: allPostIds[index], soaslid: soaslID, security: soasl_ajax.ajax_nonce },

            success: function(msg) {

                $('.soaslheaderbg .soasl_post_url_' + ref).text(msg.title);

                $('#soasl_post_content_' + ref).text(msg.content);

                $('.soasl_post_url_' + ref).attr({ href: msg.post_url });

                setTimeout(function() { $('#soasl_main_img_' + ref).html('<img src="' + msg.thumb + '" alt="" title="" class="SoaslMainFeatured" id="soasl_main_img_' + ref + '" />'); }, 100);

                items += allPostIds[index];

                localStorage['currently_viewing_item'] = items;

            }

        });

    }



    var slideNo = 0;

    var slideLocator = 1;



    function navigate(dir) {

        if (isAnimating) return false;

        isAnimating = true;

        slideNo++;

        var cntAnims = 0;

        var currentItem = items[current];

        if (dir === 'next') {

            if (slideLocator == 3) {

                slideLocator = 1;

            } else {

                slideLocator = slideLocator + 1;

            }

            get_next_post(slideLocator);

            current = current < itemsCount - 1 ? current + 1 : 0;

        } else if (dir === 'prev') {

            if (slideLocator == 1) {

                slideLocator = 3;

            } else {

                slideLocator = slideLocator - 1;

            }

            get_prev_post(slideLocator);

            current = current > 0 ? current - 1 : itemsCount - 1;

        }

        var nextItem = items[current];

        var onEndAnimationCurrentItem = function() {

            this.removeEventListener(animEndEventName, onEndAnimationCurrentItem);

            classie.removeClass(this, 'current');

            classie.removeClass(this, dir === 'next' ? 'navOutNext' : 'navOutPrev');

            ++cntAnims;

            if (cntAnims === 2) { isAnimating = false; }

        }

        var onEndAnimationNextItem = function() {

            this.removeEventListener(animEndEventName, onEndAnimationNextItem);

            classie.addClass(this, 'current');

            classie.removeClass(this, dir === 'next' ? 'navInNext' : 'navInPrev');

            ++cntAnims;

            if (cntAnims === 2) { isAnimating = false; }

        }

        if (support.animations) {
            currentItem.addEventListener(animEndEventName, onEndAnimationCurrentItem);

            nextItem.addEventListener(animEndEventName, onEndAnimationNextItem);
        } else {
            onEndAnimationCurrentItem();
            onEndAnimationNextItem();
        }
        // setTimeout(function() {
            // $(document).ajaxComplete(function(event, xhr, settings) {
            classie.addClass(currentItem, dir === 'next' ? 'navOutNext' : 'navOutPrev');
            classie.addClass(nextItem, dir === 'next' ? 'navInNext' : 'navInPrev');
            // });
        // }, 700);
    }
    init();
});
