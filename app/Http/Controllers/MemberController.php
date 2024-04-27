<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct(protected Member $member){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = $this->member->get();
        return view('member.index', [
            'members' => $member
        ]);
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
    public function store(MemberRequest $request)
    {
        $data = $request->validated();
        $member = $this->member;

        $member->nama = $data['nama'];
        $member->alamat = $data['alamat'];
        $member->nomorTelepon = $data['nomorTelepon'];
        $member->save();

        return redirect('/member');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = $this->member->find($id);

        return view('member.index', [
            'member' => $member
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = $this->member->find($id);

        return view('member.ubah', [
            'member' => $member
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, $id)
    {
        $data = $request->validated();
        $member = $this->member->find($id);

        $member->nama = $data['nama'];
        $member->alamat = $data['alamat'];
        $member->nomorTelepon = $data['nomorTelepon'];
        $member->update();

        return redirect('/member');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = $this->member->find($id);
        $member->delete();

        return redirect('/member');
    }
}
