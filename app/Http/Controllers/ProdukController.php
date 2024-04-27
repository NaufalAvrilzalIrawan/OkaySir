<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Models\LogStok;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    public function __construct(protected Produk $produk, protected LogStok $stok){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = $this->produk->get();

        return view('produk.index', [
            'produks' => $produk
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
    public function store(ProdukRequest $request)
    {
        $data = $request->validated();
        $produk = $this->produk;

        $produk->nama = $data['nama'];
        $produk->harga = $data['harga'];
        $produk->stok = $data['stok'];
        $produk->status = 'Aktif';
        $produk->save();

        return redirect('/produk');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = $this->produk->find($id);

        return view('produk.index', [
            'produk' => $produk
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = $this->produk->find($id);

        return view('produk.ubah', [
            'produk' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukRequest $request, $id)
    {
        $data = $request->validated();
        $produk = $this->produk->find($id);

        $produk->nama = $data['nama'];
        $produk->harga = $data['harga'];
        $produk->stok = $data['stok'];

        $produk->update();

        return redirect('/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = $this->produk->find($id);
        $produk->status = 'Nonaktif';
        $produk->update();

        return redirect('/produk');
    }
    
    public function aktif($id)
    {
        $produk = $this->produk->find($id);
        $produk->status = 'Aktif';
        $produk->update();

        return redirect('/produk');
    }

    public function stok() {
        $stoks = $this->stok->with('produk')->get();
        
        return view('produk.stok', [
            'stoks' => $stoks
        ]);
    }

    public function filter(Request $request) {
        $data = $request->only([
            'aksi'
        ]);
        if ($data['aksi'] == 'Semua'){
            $stoks = $this->stok->with('produk')->get();
        } else {
            $stoks = $this->stok->where('aksi', $data['aksi'])->with('produk')->get();
        }
        
        return view('produk.stok', [
            'stoks' => $stoks
        ]);
    }
}
