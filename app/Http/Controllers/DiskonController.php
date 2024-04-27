<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiskonRequest;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function __construct(protected Diskon $diskon){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diskons = $this->diskon->get();

        return view('diskon.index', [
            'diskons' => $diskons
        ]);
    }

    public function diskon($member, $total) {
        if ($member != 'Bukan member') {
            $diskon = $this->diskon->where('nominal','<=', $total)->orderBy('nominal','desc')->first();
            if ($diskon != null) {
                $potong = $total * ($diskon->persen/100);
                $totalAkhir = $total - $potong;
                $diskon = [
                    'persen' => $diskon->persen,
                    'totalAkhir' => $totalAkhir,
                ];
            }
            else {
                $persen = 0;
                $totalAkhir = $total;
                $diskon = [
                    'persen' => $persen,
                    'totalAkhir' => $totalAkhir,
                ];
            }
        } 
        else {
            $persen = 0;
            $totalAkhir = $total;
            $diskon = [
                'persen' => $persen,
                'totalAkhir' => $totalAkhir,
            ];
        }
        return $diskon;
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
    public function store(DiskonRequest $request)
    {
        $data = $request->validated();
        $diskon = $this->diskon;

        $diskon->nominal = $data['nominal'];
        $diskon->persen = $data['persen'];
        $diskon->save();
        
        return redirect('/diskon');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $diskon = $this->diskon->find($id);

        return view('diskon.ubah', [
            'diskon' => $diskon
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiskonRequest $request, $id)
    {
        $data = $request->validated();
        $diskon = $this->diskon->find($id);

        $diskon->nominal = $data['nominal'];
        $diskon->persen = $data['persen'];
        $diskon->update();
        
        return redirect('/diskon');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $diskon = $this->diskon->find($id);
        $diskon->delete();
        
        return redirect('/diskon');
    }
}
