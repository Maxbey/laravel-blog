
//Profile Page Controller

function ProfilePageController()
{
    var token = $('table').data('token'); //Grab the token for CSRF protect.
    var model = new CommentsModel(token);
    var table = new ControlTable('table tbody', '#comments-table-template');

    this.boot = function(){
        renderTable();
        bindEvents();
    };

    var renderTable = function(){

        model.authComments(function(data){
            table.composeTable(data);
        });
    };

    /*Bind the events to the links*/

    var bindEvents = function(){
        $(document).on('click', 'a', function(e){
            var link = this;

            if(link.className === 'delete-link'){
                e.preventDefault();

                var id = $(link).parent().parent().data('id');

                model.delete({id:id}, function(data){
                    table.clearTable();
                    renderTable();
                    UserInterface.showSuccessMessage(data);
                });
            }

        });
    };
}