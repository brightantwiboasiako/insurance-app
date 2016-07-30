/**
 * Created by Bright on 4/30/2016.
 */


/**
 * Gets the base of the application
 * @returns {string}
 */
function baseUrl() {
    return cleanUrl($('meta[name=app-root]').attr('content'));
}

function cleanUrl(url){
    return url.replace(/\/$/, "");
}

function combineToUrl(){

    if(arguments.length == 1) return arguments[0];

    var combined = arguments[0];

    for(var i = 1, length = arguments.length; i < length; i++){
        combined += '/' + arguments[i];
    }

    return cleanUrl(combined);

}

function buildUrlFromBase(){

    if(arguments.length == 0) return baseUrl();

    var combined = arguments[0];

    for(var i = 1, length = arguments.length; i < length; i++){
        combined += '/' + arguments[i];
    }

    return cleanUrl(baseUrl() + '/' + combined);
}

function spinner(size){

    if(size === undefined){
        return '<i class="fa fa-spinner fa-spin"></i>';
    }else{
        return '<i class="fa fa-spinner fa-spin fa-'+size+'x"></i>';
    }

}


function setProcess(element, html){
    if(html === undefined) html = '<i class="fa fa-spinner fa-spin"></i>';
    $(element).attr('disabled', true);
    handleProcess(element, html);
}

function cancelProcess(element, html){
    $(element).attr('disabled', false);
    handleProcess(element, html);
}


function handleProcess(element, html){
    var dimens = {
        height: $(element).outerHeight(),
        width: $(element).outerWidth()
    };
    $(element).html(html);
    $(element).outerWidth(dimens.width);
    $(element).outerHeight(dimens.height);
}

function bindErrors(errors, parentElement){
    if(errors !== undefined){
        errors = prepareErrors(errors);
        showPrompt(errors, parentElement);
    }

}

function showPrompt(errors, parentElement){
    errors.forEach(function(errorSet){
        var target = $(parentElement).find('[name='+ errorSet.key +']');
        target.validationEngine('showPrompt', errorSet.value[0], 'error');
        target.on('focusout', function(){ // @TODO properly hide prompt on focus out!
             //target.validationEngine('hidePrompt');
        });
    });
}

function prepareErrors(errors){
    return  $.map(errors, function(value, index){
        return [{
            'key': index,
            'value': value
        }]
    });
}


function setActiveLink(className){
    $('li').removeClass('active');
    $('.'+className).addClass('active');
}


function finderNoResult(empty){
    if(empty){
        $('.finder-empty-results').show();
    }else{
        $('.finder-empty-results').hide();
    }
}


function bindValidator(formContainer, submitBtnText, callback){
    if(submitBtnText === null){
        submitBtnText = 'Submit';
    }

    formContainer.validationEngine('attach', {
        onValidationComplete: function(form, status){
            if(status === true){
                // validation passed
                return callback(form, status);
            }else{
                cancelProcess(formContainer.find('.btn-submit'), submitBtnText);
            }
        }
        // onSuccess: function(){
        //     callback();
        //     cancelProcess(formContainer.find('.btn-submit'), submitBtnText);
        // },
        // onFailure: function(){
        //     console.log('failed');
        // }
    });
}


function post(url, data, onSuccess, onFailure){
    var options = {
        type: 'post',
        url: url,
        data: data,
        dataType: 'json',
        encode: true
    };

    ajax(options, onSuccess, onFailure);
}


function ajax(options, onSuccess, onFailure){

    if(options.dataType === undefined) options.dataType = 'json';
    if(options.encode === undefined) options.encode = true;

    $.ajax(options).done(function(data){
        onSuccess(data);
    }).fail(function(response){
        response.body = response.responseText;
        response.data = response.body;
        onFailure(response);
    });
}


function alert(message, type, onOk){

    var icon = '<i class="fa fa-check-circle fa-fw fa-lg"></i>';

    if(type === undefined || type === 'success'){
        type = 'success';
        title = icon + ' SUCCESS';
    }else if(type === 'danger'){
        icon = '<i class="fa fa-times-circle fa-fw fa-lg"></i>';
        title = icon + ' DANGER';
    }else if(type === 'warning'){
        icon = '<i class="fa fa-warning fa-fw fa-lg"></i>';
        title = icon + ' WARNING';
    }else{
        icon = '<i class="fa fa-info-circle fa-fw fa-lg"></i>';
        title = icon + ' INFORMATION';
    }


    alertify.alert()
        .setting({
            'label':'OK',
            'message': message ,
            'onok': onOk,
            'closable': false,
            'title': title,
            'transition':'zoom'
        }).show();

    var types = ["danger", "warning", "info", "success"];
    var index = types.indexOf(type);

    if(index > -1){
        types.slice(index, 1);
    }

    types.forEach(function(t){
        $('.ajs-header').removeClass('ajs-'+t);
    });

    $('.ajs-header').addClass('ajs-'+type);

}

function confirm(message, onOk, onCancel, onClose){
    alertify.confirm("<i class='fa fa-exclamation-circle'></i> CONFIRMATION", message, function(){
        onOk();
    },function(){
        onCancel();
    })
    .setting({
        'closable': false,
        'transition':'zoom',
        'onclose': onClose
    }).show();

    $('.ajs-header').addClass('ajs-warning');
}