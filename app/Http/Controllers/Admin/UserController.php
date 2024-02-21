<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Traits\PhotoTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use PhotoTrait;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->latest()->get();
            return DataTables::of($users)
                ->addColumn('action', function ($users) {
                    return '
                            <button type="button" data-id="' . $users->id . '" class="btn btn-pill btn-info-light editBtn"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-pill btn-danger-light" data-toggle="modal" data-target="#delete_modal"
                                    data-id="' . $users->id . '" data-title="' . $users->name . '">
                                    <i class="fas fa-trash"></i>
                            </button>
                       ';
                })
                ->editColumn('image', function ($admins) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $admins->image) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin.users.index');
        }
    }

    public function create()
    {
        return view('admin.users.parts.create');
    }

    public function store(StoreUserRequest $request)
    {
        $inputs = $request->all();
        $this->uploadImage($request, $inputs);
        if (User::query()->create($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }

    private function uploadImage($request, &$inputs)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/admins', 'public');
            $inputs['image'] = $imagePath;
        } else {
            unset($inputs['image']);
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.parts.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        // Retrieve validated data from the request
        $inputs = $request->validated();

        // Find the user by ID or throw an exception if not found
        $user = User::findOrFail($id);

        // Upload the image if provided in the request
        $this->uploadImage($request, $inputs);

        try {
            // Update the user with the validated data
            $user->update($inputs);

            // Return a JSON response indicating success
            return response()->json(['status' => 200, 'message' => 'User updated successfully']);
        } catch (\Exception $e) {
            // If an exception occurs during the update process, return an error response
            return response()->json(['status' => 500, 'message' => 'Failed to update user', 'error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully', 'status' => 200], 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting user: ' . $e->getMessage());

            return response()->json(['message' => $e->getMessage(), 'status' => 500], 500);
        }
    }

}
