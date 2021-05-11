var protocol = window.location.protocol;
var host = window.location.hostname;

$('#loginform').submit(function(e){
    // e.preventDefault();
    var username = $('#username').val();
    var password = $('#password').val();
    var captcha  = $('#captcha').val();
    if (username != '' && password != '' && captcha != '') {
        $.ajax({
            type : "POST",
            url  : protocol+"//"+host+"/aset_ti_second/Auth/cek_login",
            dataType : "json",
            data : $(this).serialize(),
            success: function(data){
                // console.log(data);

                if(data.success){
                    window.location = data.link;
                } else {
                    // $("#alert_login").fadeIn("slow").delay(1000).slideUp('slow');
                    toastr.error(data.alert, 'Login Gagal!', {positionClass: 'toast-top-right', containerId: 'toast-top-right'});
                    $('#img_captcha').html(data.img_captcha);
                }
            }
        });

        return false;
    }

});