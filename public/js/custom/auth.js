/**
 * Created by Bright on 4/30/2016.
 */

// Sends registration request to server

/**
 * Registration Request
 */
(function(){

    $('form[name=login-form]').validationEngine('attach', {
        onValidationComplete: function(form, status){
            if(status){
                // validation passed
                var loginData = {
                    username: form.find('[name=username]').val().trim(),
                    password: form.find('[name=password]').val()
                };
                var processElement = $('form[name=login-form]').find('.btn-submit');
                setProcess(processElement, '<i class="fa fa-spin fa-spinner"></i>');
                sendLoginRequest(loginData, processElement);

            }
        }

    });

})();


function sendLoginRequest(data, processElement){

    var options = {
        type: 'post',
        url: baseUrl() + '/login',
        data: data,
        dataType: 'json',
        encode: true
    };

    $.ajax(options)
        .done(function(response){

            if(response.success === false){
                console.log(response.errors);
                bindErrors(response.errors, $('form[name=login-form]'));
                cancelProcess(processElement, 'Sign In');
            }else{
                window.location = baseUrl();
            }

        })
        .fail(function(err){
            $('.ajax-error').html(err.responseText);
            cancelProcess(processElement, 'Sign In');
        });

}


function sendRegistrationRequest(data, processElement){
    var options = {
        type: 'post',
        url: baseUrl()+'/auth/register',
        data: data,
        dataType: 'json',
        encode: 'true'
    };

    $.ajax(options)
        .done(function(response){
            if(response.success === false){
                bindErrors(response.errors, $('form[name=register-form]'));
                cancelProcess(processElement, 'Register');
            }else{
                // Registration successful
                window.location = baseUrl() + '/auth/register/next'
            }
        })
        .fail(function(err){
            $('.ajax-error').html(err.responseText);
            cancelProcess(processElement, 'Register');
        });

}