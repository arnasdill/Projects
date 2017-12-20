//scroll animation
history.replaceState({}, '', window.location.href.substring(0, window.location.href.indexOf('#')));

$(document).ready(function () {
    $("a").on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 100, function () {
                window.location.hash = hash;
                history.pushState("", document.title, window.location.pathname);
            });
        }
    });

    $('.read-more').click(function () {
        if ($('.about-us').hasClass('active')) {
        }
        else {
            $('a').removeClass('active');
            $(this).addClass('active');
        }
    });

    //set active on navbar
    $('li a').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('active')) {
        }
        else {
            $('a').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('.navbar-brand').click(function (e) {
        e.preventDefault();
        $('li a').removeClass('active');
    });

    $(document).on("scroll", onScroll);
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('ul.nav li a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('ul.nav li a').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}