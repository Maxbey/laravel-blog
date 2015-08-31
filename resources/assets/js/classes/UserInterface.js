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

    UserInterface.removeMessage();
    $('.interface-message-container').append( template(data));

};

UserInterface.showSuccessMessage = function(message){
    UserInterface.showMessage(message, 'success-message');
    $('.alert').delay(2000).fadeOut();
};

UserInterface.showErrorMessage = function(message){
    UserInterface.showMessage(message, 'error-message');
};

UserInterface.removeMessage = function(){
    var message = $('.alert');

    if(message.length)
        message.remove();
};