$(document).ready(function() {
    // Handle form submission
    $("#req").submit(function() {
        
        // Forward request to php
        $.ajax({
            url: 'request.php',
            type: 'POST',
            data: $("#req").serialize(),
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', make_base_auth('x', $("input[name=token]").val()));
            },
            complete: function(xhr) {
                $("#responseStatus").html(xhr.status)
                $("#responseData").html(xhr.responseText);
            }
        });
        
        return false;
    });
});