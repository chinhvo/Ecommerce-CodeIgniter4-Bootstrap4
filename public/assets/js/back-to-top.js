$(function () {
    var $scrollup = $('.scrollup');

    function getScrollInfo(source) {
        var windowTop = $(window).scrollTop() || 0;
        var docTop = document.documentElement ? document.documentElement.scrollTop : 0;
        var bodyTop = document.body ? document.body.scrollTop : 0;

        var scrollTop = Math.max(windowTop, docTop, bodyTop);
        var detectedScroller = 'none';

        if (bodyTop > 0 && bodyTop >= windowTop && bodyTop >= docTop) {
            detectedScroller = 'body';
        } else if (windowTop > 300 || docTop > 300) {
            detectedScroller = 'window/document';
        }

        return scrollTop;
    }

    function handleScroll(source) {
        var scrollTop = getScrollInfo(source);
        var docHeight = $(document).height();
        var winHeight = window.innerHeight;

        // Show scroll up button if scrolled more than 100px
        if (scrollTop > 100) {
            $scrollup.addClass('show');
            console.log('Button shown');
        } else {
            $scrollup.removeClass('show');
            console.log('Button hidden');
        }
    }

    // Simple direct scroll event listener
    window.onscroll = function() {
        handleScroll('window.onscroll');
    };

    // Also try addEventListener as backup
    window.addEventListener('scroll', function() {
        handleScroll('window.addEventListener');
        handleScroll('window.addEventListener');
    });

    // jQuery binding on window as additional fallback
    $(window).on('scroll', function () {
        handleScroll('window.jquery');
    });

    // Listen for body scroll as well (some layouts scroll body instead of window)
    $('body').on('scroll', function () {
        handleScroll('body.jquery');
    });

    if (document.body && document.body.addEventListener) {
        document.body.addEventListener('scroll', function () {
            handleScroll('body.native');
        }, { passive: true });
    }

    handleScroll('init');
    
    $scrollup.click(function () {
        $("html, body").animate({ scrollTop: 0 }, 400);
        return false;
    });

});
