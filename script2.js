$(document).ready(function () {
    $("#uploadForm").submit(function (e) {
        e.preventDefault()

        $("#loader-icon").show();

        $(this).ajaxSubmit ({
            target: "#targetLayer",
            beforeSubmit: function (){
                $(".progress-bar").width("0%")
            },
            uploadProgress: function (event, progress, total, percentComplete){
                $(".progress-bar").width(percentComplete + "%")
                $(".progress-bar").html('<div id="progress-status">' + percentComplete + '%</div>')
            },
            success: function () {
                $("#loader-icon").hide()
            }
        })
        return false
    })
})