$(document).ready(function() {
$('#courseSearch').on('input', function() {
    var query = $(this).val();

    if (query !== '') {
        $.ajax({
            method: 'POST',
            url: 'live_search.php', // Create a new PHP file for handling the live search
            data: { query: query },
            success: function(response) {
                $('#searchResults').html(response);
            }
        });
    } else {
        $('#searchResults').html('');
    }
});
});
