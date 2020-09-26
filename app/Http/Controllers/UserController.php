<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $query = User::query();

        if ($search = $request->get('q')) {
            $query = $query->where('name', 'LIKE', $search . '%');
        }

        $users = $query->paginate();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.UserController.store.success'),
                'data' => [
                    'user' => $user,
                ],
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.UserController.store.error'),
                'exception' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param int $id
     * @return UserResource
     */
    public function show(ShowRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $userResource = new UserResource($user);

        return $userResource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);

        DB::beginTransaction();
        try {
            tap($user)->update($data);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.UserController.update.success'),
                'data' => $user,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.UserController.update.error'),
                'exception' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            User::destroy($id);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.UserController.destroy.success'),
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseErrorServer([
                'message' => trans('response.UserController.destroy.error'),
                'exception' => $exception->getMessage(),
            ]);
        }
    }
}
