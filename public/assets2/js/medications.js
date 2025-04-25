$(document).ready(function () {
    fetchData(); // Initial fetch

    $('#search').on('input', function() {
        fetchData();
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        fetchData($(this).attr('href'));
    });

    function rebindFormSubmissions() {
        $('form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');

            $.ajax({
                url: url,
                method: method,
                data: form.serialize(),
                success: function(response) {
                    if(response.success) {
                        displayMessage('success', response.message);
                    } else {
                        displayMessage('error', response.message);
                    }
                    fetchData(); // reload data
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    displayMessage('error', 'Error - ' + errorMessage);
                }
            });
        });
    }

    rebindFormSubmissions(); // Call this function on initial load

    function fetchData(url = '/dashboard/medications') {
        $.ajax({
            url: url,
            method: 'GET',
            data: $('#searchForm').serialize(),
            success: function(response) {
                $('#medicationsContent').html(response.tableHtml);
                $('#paginationContainer').html(response.paginationHtml);
                rebindFormSubmissions(); // Rebind the forms each time the content is replaced
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function displayMessage(type, message) {
        var messageBox = $('#messageBox');
        if (type === 'success') {
            messageBox.html(`<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i> ${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
        } else {
            messageBox.html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-1"></i> ${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`);
        }
        messageBox.show();
    }
});
