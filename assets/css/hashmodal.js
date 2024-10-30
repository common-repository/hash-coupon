jQuery(document).ready(function() {

    jQuery(".hashmodalCancle").click(function(){
         jQuery(".hashmodalContainer").fadeOut();
         jQuery(".hashmodal").fadeOut();
    });

    jQuery('body').on('click', '#hashmodalbtn', function() {
         jQuery(".hashmodalContainer").show();
         jQuery(".hashmodal").show();
    });

});