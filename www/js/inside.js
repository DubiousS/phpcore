$('document').ready(function(){
$( function() {
		$("#crop").draggable({
			containment: ".photo"
		});
	});
	$( function() {
		$("#crop").resizable({containment:'.photo'})
	});
	$(".but").on('click', function(event) {
		var w = $('#crop').width();
		var t = $('#crop').css("top");
		var l = $('#crop').css("left");
		var h = $('#crop').height();
		alert('width - ' + w + 'height - ' + h + 'left - ' + l + 'top - ' + t  );
		alert(k);
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
        var w = $('#crop').width();
        var t = $('#crop').css("top");
        var l = $('#crop').css("left");
        var h = $('#crop').height();
        $.ajax({
            url: 'form/load.php',
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