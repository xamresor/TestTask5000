$(document).ready(function () {
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return !results ? null : results[1];
    };

    $.ajax({
        type: "POST",
        url: "ajax/controller.php",
        data: {method: 'getApplicationsDataList'},
        dataType: "json",
        success: populateTable
    });

    function populateTable(response) {
        jQuery.each(response, function (i, data) {

            var row = $("<tr>").attr({
                    application_id: data.id,
                }),
                text = '<td>';

            $(text).attr({
                name: "id"
            }).text(data.id).appendTo(row);

            $(text).attr({
                name: "email"
            }).text(data.email).appendTo(row);

            $(text).attr({
                name: "amount"
            }).text(data.amount).appendTo(row);

            $(text).attr({
                name: "partnerId"
            }).text(data.partnerId).appendTo(row);

            $(text).attr({
                name: "partnerName"
            }).text(data.partnerName).appendTo(row);

            $(text).attr({
                name: "partnerSendAt"
            }).text(data.partnerSendAt).appendTo(row);

            $(text).attr({
                name: "offerStatus",
                application_id: data.id,
            }).text(data.offerStatus)
                .appendTo(row);

            var inputDisabled = data.offerStatus !== 'asked';
            $('<input>').attr({
                type: "button",
                name: "grantBtn",
                value: "Grant offer",
                application_id: data.id,
                disabled: inputDisabled,
            }).appendTo(row);

            $("#registeredTable").append(row);
        });

        $('input[name ="grantBtn"]').click(function (event) {
            makeOffer(this.getAttribute('application_id'));
        });
    }

    function makeOffer(application_id) {
        $.ajax({
            type: "POST",
            url: "ajax/controller.php",
            data: {
                method: 'makeOffer',
                application_id: application_id,
            },
            dataType: "json",
            success: function(response) {
                $('input[application_id='+application_id+']')
                    .attr({disabled: false});
                $('td[application_id='+application_id+']')
                    .text('offered');
            },
            error: function(response) {
                $("#errorPlaceholder").text(response.responseText);
            }
        });
    }

    $('#returnBtn').click(function (event) {
        document.location.href = "/?page=register";
    });

});
