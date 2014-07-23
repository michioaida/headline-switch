jQuery(document).ready(function($){
    //When one of the images are clicked it will hide any divs that contains different option posts
    $(".headline-radio").css('cursor', 'pointer').click(function() {
        //Hide any open option posts and remove border of selected images.
        $(".headline-settings").hide();
        $(".headline-radio").css("border", "none");
        
        //Show the options and add border on selected image
        $("#" + $(this).attr("id") + "-settings").show(); 
        $("#" + $(this).attr("id")).css("border", "4px solid red");     
    });
});
