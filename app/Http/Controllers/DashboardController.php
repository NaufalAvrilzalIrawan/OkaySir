<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct(protected Produk $produk, protected Penjualan $penjualan,protected Member $member){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {      
        $produk = $this->produk->count();
        $penjualan = $this->penjualan->count();
        $member = $this->member->count();

        return view('dashboard', [
            'produk' => $produk,
            'penjualan' => $penjualan,
            'member' => $member
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

}   