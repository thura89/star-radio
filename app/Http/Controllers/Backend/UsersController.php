<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CreateUser;
use App\Http\Requests\UpdateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->user_type == 1) {
            if ($request->ajax()) {
                $data = User::query()->latest();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('name', function ($each) {
                        return Str::limit($each->name, 45, '...');
                    })
                    ->editColumn('email', function ($each) {
                        return Str::limit($each->email, 45, '...');
                    })
                    ->editColumn('phone', function ($each) {
                        return Str::limit($each->phone, 45, '...');
                    })
                    ->editColumn('profile_photo', function ($each) {
                        return '<div class="avatar avatar-lg avatar-4by3">
                                            <img src="' . $each->profile_img_path() . '" alt="" class="avatar-img rounded-circle">    
                                        </div>';
                    })
                    ->editColumn('user_type', function ($each) {
                        return $each->user_type ? config('const.user_type')[$each->user_type] : '-';
                    })
                    ->editColumn('user_agent', function ($each) {
                        if ($each->user_agent) {
                            $agent = new Agent();
                            $agent->setUserAgent($each->user_agent);
                            $device = $agent->device();
                            $platform = $agent->platform();
                            $browser = $agent->browser();

                            return '<span class="badge badge-primary">' . $device . '</span></br>' .
                                '<span class="badge badge-success">' . $platform . '</span></br>' .
                                '<span class="badge badge-info">' . $browser . '</span>' .
                                '<span class="badge badge-primary">' . $each->ip . '</span>';
                        }
                        return '-';
                    })

                    ->editColumn('login_at', function ($each) {
                        return $each->login_at ? Carbon::parse($each->login_at)->diffForHumans() : '-';
                    })
                    ->editColumn('updated_at', function ($each) {
                        return Carbon::parse($each->created_at)->format('d-m-y H:i:s');
                    })
                    ->addColumn('action', function ($each) {

                        $info = '<a href="' . route('admin.users.show', $each->id) . '" type="button" class="btn btn-info btn-rounded">
                                                <i class="material-icons">fullscreen</i>
                                        </a>';
                        $edit = '<a href="' . route('admin.users.edit', $each->id) . '" type="button" class="btn btn-light btn-rounded">
                                                <i class="material-icons">edit</i>
                                        </a>';
                        if (Auth::id() == $each->id) {
                            $delete = '';
                        } else {
                            $delete = '<a href="#" type="button" class="btn btn-danger btn-rounded delete" data-id="' . $each->id . '">
                                                <i class="material-icons">close</i>
                                            </a>';
                        }

                        $collect = $info . $edit . $delete;
                        $action = '<div class="button-list">' . $collect . '</div>';
                        return $action;
                    })
                    ->rawColumns(['action', 'profile_photo', 'user_agent'])
                    ->make(true);
            }
            return view('backend.users.index');
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->user_type == 1) {
            return view('backend.users.create');
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUser $request)
    {
        if (auth()->user()->user_type == 1) {
            $profile_photo = null;
            if ($request->hasFile('profile_photo')) {
                $files = $request->file('profile_photo');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $profile_photo = 'profile_' . Str::random(5) . "-" . date('his') . "-" . Str::random(3) . "." . $extension;
                    Storage::disk('public')->put('users/profile/' . $profile_photo, file_get_contents($file));
                }
            }
            $cover_photo = null;
            if ($request->hasFile('cover_photo')) {
                $files = $request->file('cover_photo');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $cover_photo = 'cover_' . Str::random(5) . "-" . date('his') . "-" . Str::random(3) . "." . $extension;
                    Storage::disk('public')->put('users/cover/' . $cover_photo, file_get_contents($file));
                }
            }
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->description = $request->description;
            $data->profile_photo = $profile_photo;
            $data->cover_photo = $cover_photo;
            $data->user_type = $request->user_type;
            $data->password = Hash::make('starfm@changeme');
            $data->save();

            return redirect()->route('admin.users.index')->with('create', 'Created Successfully');
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (auth()->user()->user_type == 1) {
            return view('backend.users.edit', compact('user'));
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->user_type == 1) {
            return view('backend.users.edit', compact('user'));
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        if (auth()->user()->user_type == 1) {
            $data = User::findOrFail($id);
            $profile_photo = $data->profile_photo;
            if ($request->hasFile('profile_photo')) {
                Storage::disk('public')->delete('/users/profile/' . $profile_photo);
                $files = $request->file('profile_photo');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $profile_photo = 'profile_' . Str::random(5) . "-" . date('his') . "-" . Str::random(3) . "." . $extension;
                    Storage::disk('public')->put('/users/profile/' . $profile_photo, file_get_contents($file));
                }
            }
            $cover_photo = $data->cover_photo;
            if ($request->hasFile('cover_photo')) {
                Storage::disk('public')->delete('/users/cover/' . $cover_photo);
                $files = $request->file('cover_photo');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $cover_photo = Str::random(5) . "-" . date('his') . "-" . Str::random(3) . "." . $extension;
                    Storage::disk('public')->put('/users/cover/' . $cover_photo, file_get_contents($file));
                }
            }
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->description = $request->description;
            $data->profile_photo = $profile_photo;
            $data->cover_photo = $cover_photo;
            $data->user_type = $request->user_type;
            $data->update();

            return redirect()->route('admin.users.index')->with('update', 'Successfully Updated');
        }
        abort(403, 'Unauthorized action.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function reset($id)
    {
        if (auth()->user()->user_type == 1) {
            $data = User::findOrFail($id);
            $data->password = Hash::make('starfm@changeme');
            $data->update();
        }
        abort(403, 'Unauthorized action.');
    }

    public function change_password()
    {
        return view('backend.users.change_password');
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);
        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('old_password'), $auth->password)) {
            return back()->with('error_password', "Current Password is Invalid");
        }

        // Current password and new password same
        if (strcmp($request->get('old_password'), $request->new_password) == 0) {
            return redirect()->back()->with("error_password", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success_password', "Password Changed Successfully");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->user_type == 1) {
            $data = User::findOrFail($id);
            Storage::disk('public')->delete('users/profile/' . $data->profile_image);
            Storage::disk('public')->delete('users/cover/' . $data->cover_image);
            $data->delete();
        }
        abort(403, 'Unauthorized action.');
    }
}
