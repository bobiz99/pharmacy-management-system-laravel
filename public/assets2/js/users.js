$(document).ready(function () {
    fetchData();

    $('#search').on('input', function() {
        fetchData();
    });

    $('select[name="role_id"]').change(function() {
        fetchData();
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        fetchData(url);
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

    rebindFormSubmissions();

    function fetchData(url = '/dashboard/users') {
        $.ajax({
            url: url,
            method: 'GET',
            data: $('#searchForm').serialize(),
            success: function(response) {
                $('#usersContent').html(response.tableHtml);
                $('#paginationContainer').html(response.paginationHtml);
                rebindFormSubmissions();
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
