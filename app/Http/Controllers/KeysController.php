<?php

namespace App\Http\Controllers;

use App\Repositories\KeysRepository\KeysRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class KeysController extends Controller
{
    private $keysRepository;

    /**
     * Set the middleware.
     * Set the repository.
     * @param KeysRepository $repository
     */
    public function __construct(KeysRepository $repository)
    {
        $this->keysRepository = $repository;

        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('ajax');
    }

    /**
     * Display a listing of the keys.
     *
     * @return Response
     */
    public function index()
    {
        //dd($this->keysRepository->all());
        return $this->keysRepository->all();
    }

    /**
     * Store a newly created key in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->keysRepository->create(str_random(8));

        return response('Invitation key has been created', 202);
    }

    /**
     * Remove the specified key from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }
}
