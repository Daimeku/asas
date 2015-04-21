var main = function() {
    
    //ASAS heading animation
   $("#nav-brand").hover(function (event){

        $("#full-brand").toggleClass("brand-display-animate");
          event.preventDefault();
   }); 
    
    //Error Checking  
    $("#txtUsername").focusout( function(event) {       
        var username = $("#txtUsername");      
        
        //txtUsername checks
        if(username.val().length < 4)
           username.removeClass("no-error").addClass("error");
        else
          username.removeClass("error").addClass("no-error");
     });
    
    $("#txtPassword").focusout( function(event) { 
        
        var password = $("#txtPassword");
      
        //txtPassword checks       
        if(password.val().length === 0)
           password.removeClass("no-error").addClass("error");
        else
           password.removeClass("error").addClass("no-error");                       
    });
    
}; //End main function  


$(document).ready(main);
 