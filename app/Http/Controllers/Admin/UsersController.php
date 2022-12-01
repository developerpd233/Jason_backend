<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\Location;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            // ,'locations'
            $query = User::with(['roles'])->whereHas(
                'roles', function($role){
                    $role->where('title', 'User');
                }
            )->select(sprintf('%s.*', (new User())->table));
            
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            // $table->editColumn('locations', function ($row) {
            //     $labels = [];
            //     foreach ($row->locations as $location) {
            //         $labels[] = sprintf('<a href="locations/'.$location->id.'"><span class="label label-info label-many">%s</span></a>', $location->location);
            //     }

            //     return implode(' ', $labels);
            // });
            $table->editColumn('identity', function ($row) {
                return $row->identity ? User::IDENTITY_SELECT[$row->identity] : '';
            });
            $table->editColumn('interest', function ($row) {
                return $row->interest ? User::INTEREST_SELECT[$row->interest] : '';
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? User::AGE_SELECT[$row->age] : '';
            });
            $table->editColumn('relationPreference', function ($row) {
                return $row->relationPreference ? User::RELATION_PREFERENCE_SELECT[$row->relationPreference] : '';
            });
            $table->editColumn('favDrink', function ($row) {
                return $row->favDrink ? $row->favDrink : '';
            });
            $table->editColumn('favSong', function ($row) {
                return $row->favSong ? $row->favSong : '';
            });
            $table->editColumn('hobbies', function ($row) {
                return $row->hobbies ? $row->hobbies : '';
            });
            $table->editColumn('petPeeve', function ($row) {
                return $row->petPeeve ? $row->petPeeve : '';
            });
            $table->editColumn('user_status', function ($row) {
                if($row->user_status=='activated'){$lab="success";}elseif($row->user_status=='deactivated'){$lab="warning";}else{$lab="danger";}
                return $row->user_status ? sprintf('<span class="label label-'.$lab.' label-many">%s</span>', User::USER_STATUS_SELECT[$row->user_status]) : '';
            });
            // ,'locations'
            $table->rawColumns(['actions', 'placeholder', 'roles','user_status']);

            return $table->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::where('title','User')->pluck('title', 'id');
        
        // $locations = Location::pluck('location', 'id');
        
        // ,'locations'

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        // $user->locations()->sync($request->input('locations', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::where('title','User')->pluck('title', 'id');
        
        // $locations = Location::pluck('location', 'id');

        $user->load('roles');
        
        // ,'locations'

        return view('admin.users.edit', compact('roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        // $user->locations()->sync($request->input('locations', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles');
        
        // , 'locations'

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
