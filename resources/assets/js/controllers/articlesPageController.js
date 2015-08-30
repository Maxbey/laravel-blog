
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

            bindEvents();
        });
    };

    /*Bind the events to the links*/

    var bindEvents = function(){
        $(document).off("click", ".delete-link");
        $(document).on("click", ".delete-link", function(event){
            event.preventDefault();
            var id = $(this).parent().parent().data('id');
            model.delete({id:id}, function(){
                table.clearTable();
                renderTable();
            });
        });

        $(document).off("click", ".restore-link");
        $(document).on("click", ".restore-link", function(event){
            event.preventDefault();

            var id = $(this).parent().parent().data('id');
            model.restore({id:id}, function(){
                table.clearTable();
                renderTable();
            });
        });
    };
}