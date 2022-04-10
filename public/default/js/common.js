function sendAjaxRequest(url, formData, headers = {}, callback) {
    headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url : url,
        method : "POST",
        data : formData,
        headers: headers,
        dataType : "JSON",
        processData : false,
        contentType : false,
        success : function(res) {
            callback(false, res);
        },
        error: function(res) {
            callback(res, null)
        }
    });
}