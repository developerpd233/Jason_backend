<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Picture;

class UsersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['roles'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function uploadImage(Request $request){
    
        $request->validate([
            'file' => 'required|image'
        ]);
        
        $user= Auth()->user();
        $current_userID = $user->id;
        

        $file = $request->file(('file'));
        $extension = $file->getClientOriginalExtension();
        $random = Str::random(20);
        $fileName = $random.'.'.$extension;
        $path = public_path().'\profile_pics';
        $upload = $file->move($path, $fileName);
        $user_image_save = '/profile_pics/'.$fileName;
        
        $picture = Picture::create([
            'imageUrl' => $user_image_save,
            'userId' => $current_userID
        ]);

        $res = [
            'status' => 'success',
            'msg' => 'Image uploaded',
            'image' => $picture
        ];
        
        return response($res, 200);
    }

    
}
