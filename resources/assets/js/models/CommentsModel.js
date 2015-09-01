//Comment Model extends Model

function CommentsModel(token)
{
    this.token = token;

    this.urls = {
        authCommentsUrl: '/api/profile/comments',
        deleteUrl: '/api/comments/delete'
    };

    this.authComments = function(successcb, errorcb)
    {
        $.ajax({
            url: this.urls.authCommentsUrl,
            type: 'GET',
            success:Helpers.safeCallback(successcb),
            error:Helpers.safeCallback(errorcb)
        });
    };
};

CommentsModel.prototype = Object.create(Model.prototype);
CommentsModel.prototype.constructor = CommentsModel;