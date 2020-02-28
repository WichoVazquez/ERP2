
$(document).on("ready",efectos);

function efectos()
{
    /*$("#ando").click(function(){
    	  alert("HOLA");
    	  return false;
    	});*/ 
    	 
 /*menu de servicios pagina de portafolio*/           
   $('#menu > li > a').click(function(){
    if ($(this).attr('class') != 'active'){
      $('#menu li ul').slideUp();
      $(this).next().slideToggle();
      $('#menu li a').removeClass('active');
      $(this).addClass('active');
    }
  });
  
 
/*Efectos para el portafolio de servicios*/

$("#volver").click(function(){
	
  $("#develobox,#designbox, #multimediabox, #planesbox, #marketingbox,#mycodigosbox,#mydesignbox,#pusersbox").slideUp('slow',function(){
  	
  	         $("#portafoliobox").show('slow');
  	  });
});


$("#desarrollo").click(function(){
	
  $("#portafoliobox,#designbox, #multimediabox, #planesbox, #marketingbox,#mycodigosbox,#mydesignbox,#pusersbox").slideUp('slow',function(){
  	
  	         $("#develobox").show('slow');
  	  });
});

$("#diseno").click(function(){
	
	$("#portafoliobox,#develobox,#multimediabox, #planesbox, #marketingbox,#mycodigosbox,#mydesignbox,#pusersbox").slideUp('slow',function(){
  	
  	         $("#designbox").show('slow');
  	  });
});

$("#marketing").click(function(){
	
	$("#portafoliobox,#develobox,#designbox,#multimediabox,#planesbox,#mycodigosbox,#mydesignbox,#pusersbox ").slideUp('slow',function(){
  	
  	         $("#marketingbox").show('slow');
  	  });
});

$("#multimedia").click(function(){
	
	$("#portafoliobox,#develobox,#designbox,#marketingbox,#planesbox,#mycodigosbox,#mydesignbox,#pusersbox ").slideUp('slow',function(){
  	
  	         $("#multimediabox").show('slow');
  	  });
});

$("#planes").click(function(){
	
	$("#portafoliobox,#develobox,#designbox,#marketingbox,#multimediabox, #mycodigosbox,#mydesignbox,#pusersbox").slideUp('slow',function(){
  	
  	         $("#planesbox").show('slow');
  	  });
});

$("#ncodigos").click(function(){
	
	$("#portafoliobox,#develobox,#designbox,#marketingbox,#multimediabox,#planesbox,#mydesignbox,#pusersbox").slideUp('slow',function(){
  	
  	         $("#mycodigosbox").show('slow');
  	  });
}); 

$("#ndisenos").click(function(){
	
	$("#portafoliobox,#develobox,#designbox,#marketingbox,#multimediabox,#planesbox,#mycodigosbox,#pusersbox").slideUp('slow',function(){
  	
  	         $("#mydesignbox").show('slow');
  	  });
}); 

$("#pusuarios").click(function(){
	
	$("#portafoliobox,#develobox,#designbox,#marketingbox,#multimediabox,#planesbox,#mycodigosbox,#mydesignbox").slideUp('slow',function(){
  	
  	         $("#pusersbox").show('slow');
  	  });
});      	       	
   
   
 $('#gallery .light').lightBox();
   

   
   	
}

function probar()
{
        alert("HOLA");
    	  return false;
}

