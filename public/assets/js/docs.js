$('.test-response-form').on('submit', function(event){
    event.preventDefault();

    var target      = $(this).data('target');
    var parameters  = $(this).serializeArray();
    var url         = $(this).attr('action');
    var method      = $(this).attr('method');

    var unique_id   = $(this).data('unique_id');

    if(method == 'GET') {
        // Inject form values as url parameters.
        $.each(parameters, function(key, value){
            url = url.replace("{" + value.name + "}", value.value);
        });
    }

    $.ajax({
            'method': method,
            'url': url,
            'data': parameters
        }).done(
        function(data) {
            $("#" + target + " .api-response-area-content").html( syntaxHighlight( JSON.stringify(data , undefined, 4) ) );
        }
    );

    // Update the test link with the new params.
    var test_link = "<a href='" + url + "' target='_blank'>" + url + "</a>";
    $('#test-url-' + unique_id).html(test_link);

    // Display the GET result in the docs.
    $("#" + target).show();
});

$('.hide-results').on('click', function(event){
    event.preventDefault();

    var target      = $(this).data('target');
    $("#" + target).hide();
});

$('.top-menu--dev-info--toggle-dev-info').on('click', function(event){
    event.preventDefault();

    $('.dev-info').toggle();
});

function syntaxHighlight(json) {
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'number';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'key';
            } else {
                cls = 'string';
            }
        } else if (/true|false/.test(match)) {
            cls = 'boolean';
        } else if (/null/.test(match)) {
            cls = 'null';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

