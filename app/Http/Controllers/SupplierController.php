<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * All of the current user's projects.
     */
    protected $role_id;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $this->role_id = Auth::user()->role_id;
        //     $this->user = auth()->user();
        //     $mrole = new Role;
        //     $data = $mrole->getRoleById($this->role_id);
        //     if ($data != "admin") {
        //         return redirect('dashboard');
        //     } else {
        //         return $next($request);
        //     }
        // });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::latest()->paginate(9);
        
        return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'descriptions' => 'required',
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'descriptions' => $request->descriptions,
        ]);

        return redirect()->route('supplier.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        $data = Supplier::find($supplier->id);
        
        return view('supplier.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $data = Supplier::find($supplier->id);

        return view('supplier.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $newData = Supplier::find($supplier->id);
        $newData->name = $request->name;
        $newData->phone = $request->phone;
        $newData->descriptions = $request->descriptions;
        $newData->save();

        return redirect()->route('supplier.index')
            ->with('success', 'Pegawai updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        Supplier::find($supplier->id)->delete();

        return redirect()->route('supplier.index')
            ->with('success', 'Pegawai deleted successfully');
    }
}
