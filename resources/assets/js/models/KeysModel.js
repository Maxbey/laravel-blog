//Keys Model extends Model

function KeysModel()
{
    this.urls = {
        allUrl: '/api/keys/',
        createUrl:'/api/keys/create/',
        deleteUrl: '/api/keys/delete/'
    };
};

KeysModel.prototype = Object.create(Model.prototype);
KeysModel.prototype.constructor = KeysModel;