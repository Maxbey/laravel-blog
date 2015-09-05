//Users Model extends Model

function UsersModel()
{
    this.urls = {
        allUrl: '/api/users',
        deleteUrl: '/api/users/delete',
        restoreUrl: '/api/users/restore'
    };
}

UsersModel.prototype = Object.create(Model.prototype);
UsersModel.prototype.constructor = UsersModel;