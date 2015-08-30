//Helpers class

function Helpers(){}

Helpers.safeCallback = function(callback){

    if(callback)
        return callback;

    return function(){};
};