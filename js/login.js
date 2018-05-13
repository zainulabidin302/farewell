$(document).ready(function() {

    $('#login-btn').click(function() {
        console.log('activate')
        
        $('#login-box').fadeIn(500);
        console.log('hello')
      })
      $('#login-cancel').click(function() {
        $('#login-box').fadeOut(500);
      })
    
      $('#login-activate').click(function() {
        $('.alert-activate').hide();
        $('.alert-error').hide();
        $('.alert-loading').show();

        

        $.get(API_URL + '?api_req=activate_email&email=' + $("#login-input").val() + "@umt.edu.pk", function(data) {
            var d = JSON.parse(data);
            if (d.done == 'ok')
            {
                console.log('done')
                $('.alert-activate').show(500);
                $('.alert-loading').hide(500);
            }
            if (d.error) {
                $('.alert-error').show(500);
                $('.alert-loading').hide(500);
            }
            setTimeout(function() {
                $('.alert-activate').hide(500);
                $('.alert-loading').hide(500);
                $('.alert-error').hide(500);
                
            }, 3000);
    
        }).fail(function() {
            setTimeout(function() {
                $('.alert-activate').hide(500);
                $('.alert-loading').hide(500);
                $('.alert-error').hide(500);
                
            }, 3000);
      
        });









      }) 
 })
