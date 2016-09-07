// Empty JS for your own code to be here



function PopupCenter(url, title, w, h) {  
    // Fixes dual-screen position                         Most browsers      Firefox  
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;  
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;  
              
    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;  
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;  
              
    var left = ((width / 2) - (w / 2)) + dualScreenLeft;  
    var top = ((height / 2) - (h / 2)) + dualScreenTop;  
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);  
  
    // Puts focus on the newWindow  
    if (window.focus) {  
        newWindow.focus();  
    }  
}


 $("#nav ul li a[href^='#']").on('click', function(e) {

       // prevent default anchor click behavior
       e.preventDefault();

       // animate
       $('html, body').animate({
           scrollTop: $(this.hash).offset().top
         }, 1000, function(){
   
           // when done, add hash to url
           // (default click behaviour)
           window.location.hash = this.hash;
         });

    });



$(document).ready(function() {
	$('.fancybox').fancybox();
	$('.fancybox-thumbs').fancybox({
		padding: 0,openEffect  : 'elastic',
		openSpeed  : 150,
		closeEffect : 'elastic',
		closeSpeed  : 150,
		closeBtn  : true,
		arrows    : true,
		nextClick : true,
		helpers : {thumbs : {width  : 50,height : 50}},
		afterLoad : function() {
			this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');}});});