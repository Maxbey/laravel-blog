<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Set the middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->middleware('ajax', ['only' => ['destroy', 'restore']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::lists('group_name', 'id');

        return view('admin.users.create_user')->with(['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        User::create($request->all());

        return redirect('admin/users_control/')->with([
            'success-message' => 'User has been created'
        ]);
    }

    /**
     * Show delete confirmation
     *
     * @param $id
     * @return Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        return view('admin.delete_user')->with([
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        if($request->user()->id == $request['id'])
        {
            return response('You can`t delete yourself', 500);
        }

        $user = User::findOrFail($request['id']);

        $user->delete();

        return response('User (' . $user->login . ') has been deleted', 202);
    }

    /**
     * Restore user.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Request $request)
    {
        $user = User::onlyTrashed()->findOrFail($request['id']);
        $user->restore();

        return response('User (' . $user->login . ') has been restored', 202);
    }
}
