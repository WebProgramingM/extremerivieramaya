AOS.init({
	disable: 'mobile'
});

// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
  $('.navbar-toggler').on('click', function() {
        // $('#menuanim').toggleClass('open').stop();
        $('#menuanim').each(function(i) { 
            var elm=$(this);
            setTimeout(function() { 
                elm.toggleClass('open');
            }, i * 250); 
        }); 
        $('nav').each(function(i) { 
            var elm=$(this);
            setTimeout(function() { 
                elm.toggleClass('full');
            }, i * 250); 
        });
    });
$('.nav-link').on('click', function() {
            $('nav').each(function(i) { 
            var elm=$(this);
            setTimeout(function() { 
                elm.removeClass("full");;
            }, i * 250); 
        });
        $('.navbar-collapse').each(function(i) { 
            var elm=$(this);
            setTimeout(function() { 
                elm.removeClass("show");;
            }, i * 250); 
        });
        $('#menuanim').each(function(i) { 
            var elm=$(this);
            setTimeout(function() { 
                elm.removeClass("open");
            }, i * 250); 
        }); 
    });