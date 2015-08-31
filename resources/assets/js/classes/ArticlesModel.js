//ArticlesModel extends Model

function ArticlesModel(token)
{
    this.token = token;

    this.urls = {
        allUrl: '/api/articles',
        deleteUrl: '/api/articles/delete',
        restoreUrl: '/api/articles/restore'
    };
};

ArticlesModel.prototype = Object.create(Model.prototype);
ArticlesModel.prototype.constructor = ArticlesModel;