$('document').ready(function(){
    $( function() {
        $("#crop").draggable({
           containment: ".photo"
        });
        $("#crop").resizable({
            containment:'.photo',
            aspectRatio: true,
            handles: "all",
            minHeight: "100",
            minWidth: "100"
        });
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
                $('.form').trigger('reset');
            },
            cache: false,
            contentType: false,
            processData: false
        });
        e.preventDefault();
    });
$("form[name='registration']").submit(function(e) {
        var formData = $("form[name='registration']").serialize();
        $.ajax({
            url: 'form/registration.php',
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                if(msg != "good") {
                    $('.captcha').attr({
                        src: '../resource/script/captcha.php'
                    });
                    $(".cap").val('');
                    alert(msg);
                } else {
                    $("form[name='registration']").trigger('reset');
                }
            },
            cache: false
        });
        e.preventDefault();
    });

$("form[name='login']").submit(function(e) {
        var formData = $("form[name='login']").serialize();
        $.ajax({
            url: 'form/login.php',
            type: "POST",
            data: formData,
            async: false,
            success: function (msg) {
                if(msg != "good") {
                    $('.captcha').attr({
                        src: '../resource/script/captcha.php'
                    });
                    $(".cap").val('');
                    alert(msg);
                } else {
                    $("form[name='login']").trigger('reset');

                }
            },
            cache: false
        });
        e.preventDefault();
    });
});