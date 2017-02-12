$('document').ready(function(){
$( function() {
		$("#crop").draggable({
			containment: ".photo"
		});
	});
	$( function() {
		$("#crop").resizable({containment:'.photo'})
	});

	function renderImage(file) {

 		var reader = new FileReader();

 		reader.onload = function(event) {
 			the_url = event.target.result
 			$('.img').attr({
 				src: the_url
 			});
 		}

 		reader.readAsDataURL(file);
	}

$(".file").change(function() {
   renderImage(this.files[0])
});

$("form[name='upload']").submit(function(e) {
        var formData = new FormData($(this)[0]);
        var wImg = $('.img').width();
        var w = $('#crop').width();
        var t = $('#crop').css("top");
        var l = $('#crop').css("left");
        var h = $('#crop').height();
        $.ajax({
            url: 'form/load.php?widthIm=' + wImg + '&width=' + w + '&top=' + t + '&left=' + l + '&height=' + h,
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                alert(msg);
            },
            error: function(msg) {
                alert('Ошибка!');
            },
            cache: false,
            contentType: false,
            processData: false
        });
        e.preventDefault();
    });
});