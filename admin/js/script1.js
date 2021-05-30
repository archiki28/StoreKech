$(document).ready(function(){
    $(".icon").click(function(){
        
        $(".mod").css("display","block");
    });
    $(".close").click(function(){
        $(".mod").css("display","none");
    });
    
    $(window).click(function(event){
        
        if(event.target.className=="mod")
        {
            $(".mod").css("display","none");
            $(".mod").css("display","none");
        }
        
    });
});