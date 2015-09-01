//User Interface class

function UserInterface(){}

UserInterface.showMessage = function(message, type){
    var data = {};
    data.message = message;

    if(type == 'success-message')
        data.success = true;

    else if(type == 'error-message')
        data.error = true;

    var template = Handlebars.compile($('#interface-message').html() );

    UserInterface.removeMessages();
    $('.interface-message-container').append( template(data));

};

UserInterface.showSuccessMessage = function(message){
    UserInterface.showMessage(message, 'success-message');
    $('.alert-success').delay(2000).fadeOut();
};

UserInterface.showErrorMessage = function(message){
    UserInterface.showMessage(message, 'error-message');
};

UserInterface.removeMessages = function(){
    var messages = $('.alert');

    if(messages.length > 4){
        $.each(messages, function(index, value){
            $(value).remove();
        });
    }
};