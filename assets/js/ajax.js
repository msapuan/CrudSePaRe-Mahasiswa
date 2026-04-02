/**
 * AJAX Search Functionality
 */

$(document).ready(function() {
    $("#btn-search").click(function() {
        searchWithPagination(1, true);
    });
});

/**
 * Search with pagination support
 * @param {number} pageNumber - Page number to load
 * @param {boolean} isSearch - Whether this is a search operation
 */
function searchWithPagination(pageNumber, isSearch) {
    // Disable button during request
    $("#btn-search").html("SEARCHING...").attr("disabled", "disabled");
    
    $.ajax({
        url: 'search.php',
        type: 'POST',
        data: {
            keyword: $("#keyword").val(),
            page: pageNumber,
            search: isSearch
        },
        dataType: "json",
        beforeSend: function(e) {
            if (e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response) {
            // Re-enable button
            $("#btn-search").html("SEARCH").removeAttr("disabled");
            
            // Update view with search results
            $("#view").html(response.hasil);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert('Error: ' + xhr.responseText);
        }
    });
}
