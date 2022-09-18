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

function convertDateToReadable(date) {
    var splitDate = date.split(" ");
    if(splitDate.length > 1) {
        return splitDate[0].split("-").reverse().join(".") + " " + splitDate[1];
    } else {
        return date.split("-").reverse().join(".");
    }
}

function convertTimeToReadable(time) {
    var splitTime = time.split(":");
    return splitTime[0] + ":" + splitTime[1];
}