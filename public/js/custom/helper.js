/**
 * Created by Bright on 4/30/2016.
 */


/**
 * Gets the base of the application
 * @returns {string}
 */
function baseUrl() {
    return $('meta[name=app-root]').attr('content').replace(/\/$/, "");
}

function spinner(size){

    if(size === undefined){
        return '<i class="fa fa-spinner fa-spin"></i>';
    }else{
        return '<i class="fa fa-spinner fa-spin fa-'+size+'x"></i>';
    }

}


function setProcess(element, html){
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
    errors = prepareErrors(errors);

    errors.forEach(function(errorSet){
       $(parentElement).find('[name='+ errorSet.key +']').validationEngine('showPrompt', errorSet.value[0], 'error');
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
    formContainer.validationEngine('attach', {

        onValidationComplete: function(form, status){

            if(status){
                // validation passed
                callback(form);

            }else{
                cancelProcess(formContainer.find('.btn-submit'), submitBtnText);
            }
        }

    });
}


function ajax(options, onSuccess, onFailure){
    $.ajax(options).done(function(data){
        onSuccess(data);
    }).fail(function(response){
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