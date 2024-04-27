<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    public function __construct(protected User $user){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = $this->user->where('role', 2)->get();
        return view('user.index', [
            'users' => $user
        ]);
    }

    public function login(LogRequest $request) {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            if (auth()->user()->status == 'Nonaktif') {
                Auth::logout();
                return redirect()->back()->with('error', 'Akun nonaktif');
            }else {
                Auth::user();
                return redirect('dashboard');
            }
        }
        else {
            return redirect()->back()->with('error', 'Email atau password salah');
        }
    }

    public function logout() {
            Auth::logout();

            return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = $this->user;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = 2;
        $user->password = Hash::make($data['password']);
        $user->status = 'Aktif';
        $user->save();

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        return view('user.index', [
            'user' => $user
        ]);
    }

    public function profil()
    {
        $id = Auth::id();
        $user = $this->user->find($id);

        return view('user.profil', [
            'user' => $user
        ]);
    }

    public function ubah(UserUpdateRequest $request)
    {
        $data = $request->validated();
        $id = Auth::id();
        $user = $this->user->find($id);
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($data['password'] != null) {
            $user->password = Hash::make($data['password']);
        }
        $user->update();

        return redirect('/user');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('user.ubah', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $user = $this->user->find($id);
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($data['password'] != null) {
            $user->password = Hash::make($data['password']);
        }
        $user->update();

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        $user->status = 'Nonaktif';

        $user->update();

        return redirect('/user');
    }
    
    public function aktif($id)
    {
        $user = $this->user->find($id);
        $user->status = 'Aktif';

        $user->update();

        return redirect('/user');
    }
}
