
//Resource class with methods to restore and delete data in storage.

function Model(urls, token)
{
    this.token = token;

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

Model.prototype.delete = function(data, successcb, errorcb)
{
    this.tokenToData(data);
    data._method = 'delete';

    $.ajax({
        url: this.urls.deleteUrl + data.id,
        type: 'POST',
        data:data,
        success:Helpers.safeCallback(successcb),
        error:Helpers.safeCallback(errorcb)
    });
};

Model.prototype.restore = function(data, successcb, errorcb)
{
    this.tokenToData(data);

    $.ajax({
        url: this.urls.restoreUrl + data.id,
        type: 'POST',
        data:data,
        success:Helpers.safeCallback(successcb),
        error:Helpers.safeCallback(errorcb)
    });
};

Model.prototype.tokenToData = function(data)
{
    data._token = this.token;
};