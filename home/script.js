
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

var vl=0;

// ***************************************************************
// Code jquery                                                  //
// ***************************************************************
$(document).ready(function(){
    var size=$("body").css("width");
    size=parseInt(size);
  
  
    $(".search-icon").click(function(){
        
       var existe=$("#mysearch").css("display");
      
       if(existe=="none")
       {
        $("#mysearch").css("display","block");
       }
       else{
        $("#mysearch").css("display","none");
       }

      
    });






    


      // button open form login
    $(".user-wrapper .user").click(function(){
      
        $(".modal-login").css("display","block");
        if(isLogin==true)
        {
          alert("yes");

        }
        else{
          alert("no");
        }

      });


       // button open form login
      $(".cancel").click(function(){
        $(".modal-login").css("display","none");
      });





    

      $(".close").click(function(){
        $("#mymodal").css("display","none");
      });


      // Buttons de Quantite
      
      var temp=1;
      var x=0;
      var variable=[];
      var plus=[];
      var moin=[];
      var add=[];
      var title=[];
      var price=[];
      var quantite=[];
      var img=[];
      while(x<name)
      {
        variable[x]=("#quantite"+temp).toString();
        plus[x]=(".btn-plus"+temp).toString();
        moin[x]=(".btn-minus"+temp).toString();
        add[x]=("#addCart"+temp).toString();
        title[x]=(".title"+temp).toString();
        price[x]=(".price"+temp).toString();
        quantite[x]=("#quantite"+temp).toString();
        img[x]=(".img"+temp).toString();
        temp++;
        x++;
       }
     

    
       
     $("input[type=button]").click(function(){
      var atr=$(this).attr("class");
      var at=$(this).attr("id");
      at="#"+at;
      atr="."+atr;
      var i=0;
      while(i<name)
      {
        
        var valeur=$(variable[i]).val();
        valeur=parseInt(valeur);
        if(atr==plus[i])
        {
          
          
            valeur++;
            $(variable[i]).val(valeur);
          
        }
        else if(atr==moin[i])
        {
          if(valeur>0)
            {
              valeur--;
            }
            $(variable[i]).val(valeur);
        }
        if(at==add[i])
        {
          
          vl++;
          var titl=$(title[i]).text();
          createCookie("gfg",vl,"10");
          createCookie("hi",titl,"10");
          
        }
        
    
        
        i++;
      }
      
    });
    


    
    
    $("input[type=submit]").click(function(){
      
      var at=$(this).attr("id");
      at="#"+at;
      
      var i=0;
      while(i<name)
      {
        
        
        if(at==add[i])
        {
          
          vl++;
          var imgP=$(img[i]).attr("src");
          var titleP=$(title[i]).text();
          var quantiteP=$(quantite[i]).val();
          var priceP=$(price[i]).text();
          

          priceP=(parseInt(quantiteP)*parseFloat(priceP))+"$";
          createCookie("imgP",imgP,"10");
          createCookie("titleP",titleP,"10");
          createCookie("quantiteP",quantiteP,"10");
          createCookie("priceP",priceP,"10");

          
        }
          
        i++;
      }
      
    });
    
    
    
    $("span.close2").click(function(){
      
      $(".modal-login").css("display","none");
    });



    $(window).click(function(event){
        
      if(event.target.className=="modal-login")
      {
        
          $(".modal-login").css("display","none");
          
      }
      if(event.target.className=="mysearch")
      {
        $(".mysearch").css("display","none");
      }
  });
  $(window).resize(function(){
    $(".mysearch").css("display","none");
  });



    if(window.history.replaceState){
      window.history.replaceState(null,null,window.location.href);
    }
});


