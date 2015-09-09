function ControlTable(tableSelector, templateSelector)
{
    this.table = $(tableSelector);
    this.template = $(templateSelector);

    this.composeTable = function(data)
    {
        if(this.template.length){
            var template = Handlebars.compile( $(this.template).html() );
            $(tableSelector).append( template(data));
        }
    };

    this.registerTemplateHelper = function(helper){
        Handlebars.registerHelper(helper.name, helper.callback);
    };

    this.clearTable = function(){
        var rows = this.table.children('tr');

        [].shift.call(rows);

        $.each(rows, function(index, value){
            $(value).remove();
        });
    }
}