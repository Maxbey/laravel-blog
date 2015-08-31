
//Articles Page Controller.

function ArticlesPageController()
{
    var token = $('table').data('token'); //Grab the token for CSRF protect.
    var model = new ArticlesModel(token);
    var table = new ControlTable('table tbody', '#article-row-template');

    //Handlebars helper function.
    var rowStyleTemplateHelper = {
        name:'rowStyle',
        callback:function(){
            if(this.deleted)
                return 'danger';

            if(this.inQueue)
                return 'warning';

            return '';
        }
    };

    this.boot = function(){
        renderTable();
        bindEvents();
    };

    //
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
                var title = $(link).parent().parent().data('title');
                var message = '';

                if(link.className === 'delete-link'){
                    model.delete({id:id}, function(){
                        table.clearTable();
                        renderTable();
                        UserInterface.showSuccessMessage('Article (' + title + ') has been deleted');
                    });
                }

                if(link.className === 'restore-link'){
                    model.restore({id:id}, function(){
                        table.clearTable();
                        renderTable();
                        UserInterface.showSuccessMessage('Article (' + title + ') has been restored');
                    });
                }

            }

        });
    };
}