// JavaScript Document

    $(document).ready(function(){
	$("#controls li a").click(function(){
        /*Performed when a control is clicked */
	    shuffle();
	    var rel = $(this).attr("rel");
	    if ( $("#" + rel).hasClass("current") ){
	        return false;
	    }
        /* Bug Fix, thanks Dave -> added .stop(true,true) 
            to stop any ongoing animation */
	    $("#" + rel).stop(true,true).show();
	    $(".current").fadeOut(2000).removeClass("current");
	    $("#" + rel).addClass("current");
	    $(".active").removeClass("active");
	    $(this).parents("li").addClass("active");
	    set_new_interval(5000);
	    return false;
	});
	/* 
	* Optional Pause on Hover Feature 
	* Comment out to use it
	* Thanks, Andrew 
	*/
	/*$('.banner').hover(function() {
			clearInterval(slide);
		}, function () {
			slide = setInterval( "banner_switch()", 7000 );
	});*/
    });
    function banner_switch(){
        /*This function is called on to switch the banners out when the time limit is reached */
        shuffle();
        var next = $('.banner.current').next('.banner').length ? 
            $('.banner.current').next('.banner') : $('#banners .banner:first');
        $(next).show();
		if($('.banner').length != 1)
		{
        	$(".current").fadeOut(2000).removeClass("current");
		}
        $(next).addClass("current");
        var next_link = $(".active").next("li").length ? $('.active').next('li') : $('#controls li:first');
        $(".active").removeClass("active");
        $(next_link).addClass('active');
    }
    $(function() {
        /*Initial timer setting */
        slide = setInterval("banner_switch()", 4000);
    });
    function set_new_interval(interval){
        /*Simply clears out the old timer interval and restarts it */
        clearInterval(slide);
        slide = setInterval("banner_switch()", interval);
    }
    function shuffle(){
        /*This function takes every .banner and changes the z-index to 1, hides them,
            then takes the ".current" banner and brings it above and shows it */
        $(".banner").css("z-index", 1).hide();
        $(".current").css("z-index", 2).show();
    }