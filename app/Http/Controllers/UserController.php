<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateReqeust;
use App\Http\Requests\UserUpdateReqeust;
use App\Models\User;
use DB;
use Exception;

class UserController extends Controller
{
    public function store(UserCreateReqeust $request)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        try {
            $user = User::create($payload->toArray());
            DB::commit();

            return $this->success('new user is created successfully', $user);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function index()
    {
        try {
            $users = User::sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            return $this->success('user list is retrived successfully', $users);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            return $this->success('user detail is retrived successfully', $user);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function update(UserUpdateReqeust $request, $id)
    {
        $payload = collect($request->validated());

        try {
            DB::beginTransaction();

            $user = User::findOrFail($id);
            $user->update($payload->toArray());
            DB::commit();

            return $this->success('user is updated successfully', $user);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();

            return $this->noContent('user is deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }
}
