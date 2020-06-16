$(document).ready(function() {
    $('#submitBtn').click(function (event) {
        $.ajax({
            type: "POST",
            url: "ajax/register.php",
            data: {
                method: 'register',
                email: $("#email").val(),
                amount: $("#amount").val(),
            },
            dataType: "json",
            success: function() {
                document.location.href = "/?page=registeredTable";
            },
            error: function(response) {
                $("#errorPlaceholder").text(response.responseText);
            }
        });
    });

    $('#showRegisterTableBtn').click(function (event) {
        document.location.href = "/?page=registeredTable";
    });
})