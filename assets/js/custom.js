$(document).ready(function(){
    // Input Text alphabet + number
    $('.both').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
    });

    // Input Text alphabet
    $('.alphabet').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z ]/g, '');
    });

    // Input Text alphabet
    $('.alphabet-nospace').on('input', function() {
        this.value = this.value.replace(/[^a-zA-Z]/g, '');
    });

    // Input Text number
    $('.number').on('input', function() {
        this.value = this.value.replace(/[^0-9 ]/g, '');
    });

    // Input Text url
    $('.url').on('input', function() {
        this.value = this.value.replace(/(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/g, '');
    });

    // confirming on alert
    $(".confirm").click( function () {
        return confirm( 'Are you sure? ' );
    });
});

// Bootstrap 4
// Custom File Upload
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

// ajax
$("#notice").hide();
$("#ajax_action, .ajax_action").submit(function(event){

    $(':input[type="submit"]').prop('disabled', true);

    event.preventDefault();
    var post_url = $(this).attr("action"); // Get the form action URL
    var request_method = $(this).attr("method"); // Get form GET/POST method
    var form_data = new FormData(this);
  
    $.ajax({
        url : post_url,
        type: request_method,
        data : form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json', 
        success: function(results){
            
            var status = results.status;
            var text = results.text;
            var url = results.url;
    
            if (status == 'success'){
                $('html, body').animate({ scrollTop: 0 }, 'slow');
                $("#notice").removeClass("alert-danger");
                $("#notice").removeClass("alert-warning");
                $("#notice").addClass("alert-success");
                $("#notice-text").text(text);
                $("#notice").fadeIn();

                $(':input[type="submit"]').prop('disabled', false);
                
            } else {
                $('html, body').animate({ scrollTop: 0 }, 'slow');
                $("#notice").removeClass("alert-danger");
                $("#notice").removeClass("alert-success");
                $("#notice").addClass("alert-warning");
                $("#notice-text").text(text);
                $("#notice").fadeIn();

                $(':input[type="submit"]').prop('disabled', false);
            
            }
                
            setTimeout(function(){
                $("#notice").fadeOut();
                if (url != ''){
                    window.location.href = url;
                }
            }, 3000);
        },
        error: function (xhr, status, error){
            $('html, body').animate({ scrollTop: 0 }, 'slow');
            $("#notice").removeClass("alert-success");
            $("#notice").removeClass("alert-warning");
            $("#notice").addClass("alert-danger");
            $("#notice-text").text("Somethink Error, Please Try Again Later.");
            $("#notice").fadeIn();

            $(':input[type="submit"]').prop('disabled', false);
        }
    });
});