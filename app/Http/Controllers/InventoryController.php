<?php

namespace App\Http\Controllers;

use App\Models\DetailInventory;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::all();
        return view('inventory.index', compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $inventory = new Inventory();
        $inventory->name = $request->name;
        $inventory->department = $request->department;
        $inventory->user_id = Auth::user()->id;
        $inventory->save();
        $data = count($request->jumlah);
        // dd($data);
        if ($inventory->save()) {
            for ($i=0; $i < $data; $i++) { 
                DetailInventory::updateOrCreate([
                    'inventory_id' => $inventory->id,
                    'nama_alat' => $request->nama_alat[$i],
                    'jumlah' => $request->jumlah[$i]
                ]);
            }
        }
        return redirect(route('inventory.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('inventory.show'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = Inventory::find($id);
        $detailInventory = DetailInventory::where('inventory_id',$id)->get();
        // dd($inventory);
        return view('inventory.edit',compact('inventory', 'detailInventory')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        $inventory->name = $request->name;
        $inventory->department = $request->department;
        $inventory->user_id = Auth::user()->id;
        $inventory->save();
        $data = count($request->jumlah);
        for ($i = 0; $i < $data; $i++) {
            DetailInventory::updateOrCreate([
                'inventory_id' => $inventory->id,
                'nama_alat' => $request->nama_alat[$i],
                'jumlah' => $request->jumlah[$i]
            ]);
        }
        return redirect(route('inventory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventory::find($id)->delete();
        return redirect()->back();
    }
    public function destroy_detail(Request $request)
    {
        $id = $request->get('id');
        DetailInventory::find($id)->delete();
    }
}
