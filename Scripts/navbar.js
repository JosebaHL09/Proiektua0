var clicked = false;

$(".navbar-toggler").click(function(){
    if(clicked){
        clicked = false
        $(".collapse").css("display","none")
    }else{
        clicked = true
        $(".collapse").css("display","block")
    }
   
});