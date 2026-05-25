<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Exception;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:list-user')->only('index');
        $this->middleware('can:create-user')->only(['create', 'store']);
        $this->middleware('can:edit-user')->only(['edit', 'update']);
        $this->middleware('can:delete-user')->only('destroy');
    }

    public function index(Request $request)
    {
        $roles = Role::select("id", "name")->get();

        $users = User::query()
            ->where('email', '!=', 'mahfujurr221@gmail.com')
            ->when($request->user_id, fn($q) => $q->where('id', $request->user_id))
            ->when($request->name, function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('fname', 'like', '%' . $request->name . '%')
                        ->orWhere('lname', 'like', '%' . $request->name . '%');
                });
            })
            ->when($request->phone, fn($q) => $q->where('phone', 'like', '%' . $request->phone . '%'))
            ->when($request->role, function ($q) use ($request) {
                $q->whereHas('roles', fn($sub) => $sub->where('name', $request->role));
            })
            ->latest('id')
            ->paginate(20)
            ->withQueryString(); // Keeps filters active during pagination

        return view('backend.pages.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('backend.pages.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|max:191',
            'lname' => 'required|max:191',
            'email' => 'required|max:191|email|unique:users,email',
            'phone' => 'required|max:15|unique:users,phone',
            'role' => 'required',
            'password' => 'required|min:4|confirmed', // Looks for password_confirmation automatically
        ]);

        try {
            DB::beginTransaction();

            // Explicitly define data to avoid "Field doesn't have default value" errors
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);

            $user->syncRoles($request->role);

            DB::commit();
            toast('User Created Successfully!', 'success');
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollBack();
            // This will help you see exactly what failed during development
            toast('Error: ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    public function edit(User $user)
    {
        $roles = Role::select('id', 'name')->get();
        return view('backend.pages.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'role' => 'required',
            'password' => 'nullable|min:4|confirmed',
        ]);

        try {
            DB::beginTransaction();

            $user->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($request->filled('password')) {
                $user->update(['password' => bcrypt($request->password)]);
            }

            $user->syncRoles($request->role);

            DB::commit();
            toast('User Updated Successfully!', 'success');
            return redirect()->route('users.index');
        } catch (Exception $e) {
            DB::rollBack();
            toast('Update failed: ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    public function destroy(User $user)
    {
        if ($user->is_default) {
            toast('Default user cannot be deleted!', 'warning');
            return back();
        }

        $user->delete();
        toast('User Deleted Successfully!', 'success');
        return redirect()->route('users.index');
    }
}
