$(document).ready(function() {
	// hide message
	$("#remove_message").click(function() {
    	$(this).hide();
    });

    // attendance validation
    $('form').submit(function() {
    	var roll = true;
    	$(':radio').each(function() {
    		name = $(this).attr('name');
    		if (roll && !$(':radio[name="' + name + '"]:checked').length) {
    			//alert(name + " Roll Missing.");
    			$('.alert').show();
    			roll = false;
    		}
    	});
    	return roll;
    });


	
});