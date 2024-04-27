<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailRequest;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function __construct(protected DetailPenjualan $detail, protected Penjualan $penjualan, protected Produk $produk, protected DiskonController $diskonC) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = $this->detail->with('penjualan')->get();
        dd($detail);
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
    public function store(DetailRequest $request)
    {
        $data = $request->validated();
        $penjualan = $this->penjualan->find($data['penjualanID']);
        $detail = $this->detail;
        $diskonC = $this->diskonC;
        $produk = $this->produk->find($data['produkID']);
        
        $penjualan->namaMember = $data['namaMember'];
        $penjualan->update();
        
        $detail->penjualanID = $data['penjualanID'];
        $detail->produkID = $data['produkID'];
        $detail->jumlah = $data['jumlah'];
        $detail->subtotal = $data['subtotal'];
        
        $detail->save();

        $total = $this->detail->where('penjualanID', $data['penjualanID'])->sum('subtotal');
        $potong = $diskonC->diskon($data['namaMember'], $total);

        $response = [
            'detailID' => $detail->detailID,
            'produk' => $produk->nama,
            'jumlah' => $data['jumlah'],
            'subtotal' => $data['subtotal'],
            'total' => $total,
            'totalAkhir' => $potong['totalAkhir'],
            'persen' => $potong['persen'],
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailPenjualan $detailPenjualan)
    {
        //
    }

    // public function diskon($member, $total) {
    //     $totalAkhir = $total;
    //     if ($member != 'Bukan member') {
    //         if ($total >= 100000) {
    //             $totalAkhir = $total - ($total * 0.10);
    //         }
    //         elseif ($total >= 50000) {
    //             $totalAkhir = $total - ($total * 0.05);
    //         }
    //     }
    //     return $totalAkhir;
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailPenjualan $detailPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = $this->detail->find($id);
        $penjualan = $this->penjualan->find($detail->penjualanID);
        $member = $penjualan->namaMember;
        $detail->delete();
        
        $total = $this->detail->where('penjualanID', $penjualan->penjualanID)->sum('subtotal');
        $potong = $this->diskonC->diskon($member, $total);
        
        $response = [
            'total' => $total,
            'totalAkhir' => $potong['totalAkhir'],
            'persen' => $potong['persen'],
        ];
        // dd($totalAkhir . ' = ' . $total . ' = ' . $member);
        return response()->json($response);
    }
}
