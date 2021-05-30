// Fonction to create the cookie
function createCookie(name,value,days){
    var expires;
    if(days){
      var date =new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      expires="; expires="+date.toGMTString();
  
    }
    else{
      expires="";
    }
    document.cookie=escape(name)+"="+escape(value)+expires+";path=/";
  }

$(document).ready(function(){
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
        }
    // Show the form add product
    $(".addProducts").click(function(){
        $(".modal-login").css("display","block");
    });


   

    // Hide the form add product on click button cancel
    $(".cancel").click(function(){
        $(".modal-login").css("display","none");
        $(".modal-update").css("display","none");
    });
    

    // Hide the form add product on click out the form 
    $(window).click(function(event){
        
        if(event.target.className=="form-popup")
        {
            
            $(".modal-login").css("display","none");
            $(".modal-update").css("display","none");
            
        }
        
    });

    // Send id to php by cookie 
    $(".delete").click(function(){
        var idD=$(this).attr("id");
        createCookie("idDelete",idD,1);
       
    });

    // Send id to php by cookie 
    $(".updateform").click(function(){
        var idU=$(this).attr("id");
        createCookie("idUpdate",idU,1);
       
       
    });
    

    
    
   
});