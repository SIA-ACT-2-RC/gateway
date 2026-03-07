<?php

namespace App\Http\Controllers;
//use App\Models\User;
use App\Services\User2Service;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class User2Controller extends Controller
{
use ApiResponser;

/**
 * @var User2Service
 */
public $user2Service;

/**
 * @return void
 */

public function __construct(User2Service $user2Service)
{
    $this->user2Service = $user2Service;
}

public function index()
{
    return $this->successResponse($this->user2Service->obtainUsers2(), Response::HTTP_OK, 'site2');
}

public function add(Request $request)
{
    return $this->successResponse($this->user2Service->createUser2($request->all()), Response::HTTP_CREATED, 'site2');
}

public function show($id)
{
    return $this->successResponse($this->user2Service->obtainUser2($id), Response::HTTP_OK, 'site2');
}

public function update(Request $request, $id)
{
    return $this->successResponse($this->user2Service->editUser2($request->all(), $id), Response::HTTP_OK, 'site2');
}

public function delete($id)
{
    return $this->successResponse($this->user2Service->deleteUser2($id), Response::HTTP_OK, 'site2');
}
}