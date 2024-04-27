<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanRequest;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function __construct(protected Penjualan $penjualan, protected Member $member, protected Produk $produk, protected DiskonController $diskonC) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = $this->penjualan->with('user', 'detailPenjualan', 'detailPenjualan.produk')->get();

        return view('penjualan.index', [
            'penjualans' => $penjualan
        ]);
    }

    public function filter(Request $request)
    {
        $data = $request->only([
            'dari',
            'sampai'
        ]);
        $penjualan = $this->penjualan->whereBetween('tanggal', [$data['dari'], $data['sampai']])->with('user', 'detailPenjualan', 'detailPenjualan.produk')->get();

        return view('penjualan.index', [
            'penjualans' => $penjualan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proses = $this->penjualan->where('status', 'proses')->with('detailPenjualan', 'detailPenjualan.produk')->first();
        $member = $this->member->get();
        $produk = $this->produk->where('status', 'Aktif')->get();
        if ($proses != null) {
            $penjualan = $proses;
            $tanggal = $penjualan->tanggal;
            $total = $proses->detailPenjualan->where('penjualanID', $proses->penjualanID)->sum('subtotal');
            $potong = $this->diskonC->diskon($proses->namaMember, $total);
            // dd($total . ' = ' . $totalAkhir);

            return view('penjualan.transaksi', [
                'penjualan' => $penjualan,
                'members' => $member,
                'produks' => $produk,
                'tanggal' => $tanggal,
                'total' => $total,
                'totalAkhir' => $potong['totalAkhir'],
                'persen' => $potong['persen'],
            ]);
        } else{
            $penjualan = $this->penjualan;
            $waktu = now('Asia/Jakarta');
            $waktus = explode(' ', $waktu);
            $tanggal = $waktus[0];
    
            $penjualan->userID = Auth::id();
            $penjualan->tanggal = $tanggal;
            $penjualan->status = 'proses';
    
            $penjualan->save();
            
            return view('penjualan.transaksi', [
                'penjualan' => $penjualan,
                'members' => $member,
                'produks' => $produk,
                'tanggal' => $tanggal,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penjualan = $this->penjualan->with('user', 'detailPenjualan', 'detailPenjualan.produk')->find($id);

        return view('penjualan.struk', [
            'penjualan' => $penjualan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PenjualanRequest $request, $id)
    {
        $data = $request->validated();

        $penjualan = $this->penjualan->find($id);

        $penjualan->total = $data['total'];
        $penjualan->totalAkhir = $data['totalAkhir'];
        $penjualan->bayar = $data['bayar'];
        $penjualan->kembalian = $data['kembalian'];
        $penjualan->status = 'selesai';

        $penjualan->update();

        return redirect('/penjualan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = $this->penjualan->find($id);
        $penjualan->delete();

        return redirect('/penjualan');
    }
}
