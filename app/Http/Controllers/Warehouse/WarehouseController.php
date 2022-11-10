<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Models\Warehouse\Warehouse;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    
    public function index()
    {
        $warehouse = Warehouse::all();

        return view('Admin.Warehouse.index', compact('warehouse'));
    }

    public function create()
    {
        
        return view('Admin.Warehouse.form');
    }

    public function store(Request $request)
    {

        // dd($request);

        $this->validate($request, [
            'code' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data = $request->all();

        // dd($data);

        Warehouse::create($data);

        return redirect()->route('warehouse.index')->with('message', 'Warehouse berhasil ditambahkan!');
    
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);
        // dd($category);

        return view('Admin.Warehouse.edit', compact('warehouse'));
    }

    public function update(Request $request, $id)
    {    
        $warehouse = Warehouse::find($id);

        $this->validate($request, [
            'code' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data = $request->all();

       $warehouse->update($data);

        return redirect()->route('warehouse.index')->with('message', 'Warehouse berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();

        return redirect()->route('warehouse.index')->with('message', 'Warehouse tersebut berhasil dihapus');
    }
}
