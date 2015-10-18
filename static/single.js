jQuery(function($) {
	$(document).ready(function() {
		// Make header sticky
		$('.main-header').fixedsticky();

		$(".share-toggle-button").on('click', function() {
			$('.share').toggleClass('open');
		});

		$(".share-button.facebook").on('click', function() {
	        window.open("https://www.facebook.com/sharer/sharer.php?u=" + document.location.href, "newwindow", "width=720, height=500");
	    });

	    $(".share-button.google-plus").on('click',function() {
	        window.open("https://plus.google.com/share?url=" + document.location.href, "newwindow", "width=500, height=550, scrollbars=no");
	    });

	    $(".share-button.reddit").on('click', function() {
	        window.open("http://www.reddit.com/submit?url=" + document.location.href + "&title=" + document.querySelector("h1").textContent);
	    });

	    $(".share-button.twitter").on('click', function() {
	        window.open("https://twitter.com/intent/tweet?text=" + document.querySelector("h1").textContent + "&url=" + document.location.href + "&related=@SverigeScience", "newwindow", "width=485, height=300")
	    });
	});
	
	$(window).load(function() {
		$('.like').addClass('show');
	});
});

// Twitter
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');