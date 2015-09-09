//Keys Page Controller

function KeysPageController() {
    var model = new KeysModel();
    var table = new ControlTable('table tbody', '#keys-table-template');

    this.boot = function () {
        renderTable();
        bindEvents();
    };

    var renderTable = function () {
        model.all(function (data) {
            table.composeTable(data);
        });
    };

    /*Bind the events to the links*/

    var bindEvents = function () {
        $(document).on('click', 'a', function (e) {
            var link = this;

            if (link.className === 'delete-link') {
                e.preventDefault();

                var id = $(link).parent().parent().data('id');

                model.delete({id: id}, function (data) {
                    table.clearTable();
                    renderTable();
                    UserInterface.showSuccessMessage(data);
                });
            }

            if (link.className === 'create-link') {
                e.preventDefault();

                model.create({}, function (response){
                    table.clearTable();
                    renderTable();
                    UserInterface.showSuccessMessage(response);
                })
            }

        });
    };
}