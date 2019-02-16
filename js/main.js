$(document).ready(function(){
	$(".img_wrapper img").each(function(){
       $(this).css("display","none");
       var img = $(this).attr("src");
       console.log(img);
       $(this).parent().css({"background":"url("+img.replace('\\','/')+")","background-size":"cover","background-position":"center"});
  });
});