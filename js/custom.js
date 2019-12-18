$(window).load(function(){
    
	// defalt show testimonial tab
	$('.testimonial-tab .testimonial-con').fadeOut();
	$('.testimonial-tab #testimonial-tab3').fadeIn();
    $('.testimonials-tab-content #testimonial-tab3').addClass('active');
    });

    // show testimonial tab
	$('.testimonials-tab-list ul li a').click(function() {
		$('.testimonials-tab-list ul li').removeClass('active');
        $('.testimonials-tab-content .testimonial-con').removeClass('active');
		$('.testimonials-tab-content .testimonial-con').fadeOut('fast');
		$(this).parent().addClass('active');
		$('.testimonial-tab #testimonial-'+$(this).attr('data-tab')).fadeIn(1000).addClass('active');
	});