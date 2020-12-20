<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo AssetsURL() ?>plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo AssetsURL() ?>plugins/popper/popper.min.js"></script>
<script type="text/javascript" src="<?php echo AssetsURL() ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Example Add Plugins -->
<!-- 
<script type="text/javascript" src="<?php echo AssetsURL() ?>plugins/OwlCarousel/owl.carousel.min.js"></script>
<script>
$('.owl-carousel').owlCarousel({
  items:1,
  loop:true,
  margin:10,
  dots:false,
  lazyLoad:true,
  autoplay:true,
  autoplayTimeout:5000,
  autoplayHoverPause:true
});
</script>

<script type="text/javascript" src="<?php echo AssetsURL() ?>plugins/DataTables/datatables.min.js"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>

<script type="text/javascript" src="<?php echo AssetsURL() ?>plugins/summernote/summernote.min.js"></script>
<script>
$('.textarea').summernote({
    height: 200,
    tabsize: 4,
    callbacks: {
        onImageUpload: function(image) {
            uploadImage(image[0]);
        },
        onMediaDelete : function(target) {
            deleteImage(target[0].src);
        },
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    },
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'hr']],
        ['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
    ],
    fontNames: ['Helvetica', 'Verdana'],
    fontNamesIgnoreCheck: ['Helvetica', 'Verdana']
});
function uploadImage(image) {
    var data = new FormData();
    data.append("summernote_image", image);
    $.ajax({
        url: "action/summernote_upload",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function(url) {
            var image = $('<img>').attr('src', url);
            $('.textarea').summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}
function deleteImage(src) {
    $.ajax({
        data: {src : src},
        type: "POST",
        url: "action/summernote_delete",
        cache: false,
        success: function(response) {
            console.log(response);
        }
    });
}
</script>
-->

<script type="text/javascript" src="<?php echo AssetsURL() ?>js/custom.js"></script>
</body>
</html>