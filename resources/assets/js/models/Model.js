
//Resource class with methods to restore and delete data in storage.

function Model(urls)
{

    this.urls = {
        allUrl: urls.allUrl,
        deleteUrl: urls.deleteUrl,
        restoreUrl: urls.restoreUrl
    };
}

Model.prototype.all = function(successcb, errorcb)
{
    $.ajax({
        url: this.urls.allUrl,
        type: 'GET',
        success:Helpers.safeCallback(successcb),
        error:Helpers.safeCallback(errorcb)
    });
};

Model.prototype.create = function(data, successcb, errorcb){
    $.ajax({
        url: this.urls.createUrl,
        type: 'POST',
        data: data,
        success:Helpers.safeCallback(successcb),
        error:Helpers.safeCallback(errorcb)
    });
};

Model.prototype.delete = function(data, successcb, errorcb)
{
    data._method = 'delete';

    $.ajax({
        url: this.urls.deleteUrl,
        type: 'POST',
        data:data,
        success:Helpers.safeCallback(successcb),
        error:Helpers.safeCallback(errorcb)
    });
};

Model.prototype.restore = function(data, successcb, errorcb)
{

    $.ajax({
        url: this.urls.restoreUrl,
        type: 'POST',
        data:data,
        success:Helpers.safeCallback(successcb),
        error:Helpers.safeCallback(errorcb)
    });
};