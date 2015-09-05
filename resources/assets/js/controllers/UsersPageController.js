
//Users Page Controller

function UsersPageController()
{
    var model = new UsersModel();
    var table = new ControlTable('table tbody', '#users-table-template');

    //Handlebars helper function.
    var rowStyleTemplateHelper = {
        name:'rowStyle',
        callback:function(){
            if(this.deleted)
                return 'danger';

            return '';
        }
    };

    this.boot = function(){
        renderTable();
        bindEvents();
    };

    var renderTable = function(){

        model.all(function(data){

            table.registerTemplateHelper(rowStyleTemplateHelper);
            table.composeTable(data);
        });
    };

    /*Bind the events to the links*/

    var bindEvents = function(){
        $(document).on('click', 'a', function(e){
            var link = this;

            if(link.className === 'delete-link' || link.className === 'restore-link'){
                e.preventDefault();

                var id = $(link).parent().parent().data('id');

                if(link.className === 'delete-link'){
                    model.delete({id:id}, function(data){
                        table.clearTable();
                        renderTable();
                        UserInterface.showSuccessMessage(data);
                    }, function(data){
                        UserInterface.showErrorMessage(data.responseText);
                    });
                }

                if(link.className === 'restore-link'){
                    model.restore({id:id}, function(data){
                        table.clearTable();
                        renderTable();
                        UserInterface.showSuccessMessage(data);
                    });
                }

            }

        });
    };
}