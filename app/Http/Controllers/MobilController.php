<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kursus.mobil.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            Mobil::create($request->all());

            return response()->json(['success' => 'Data berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try
        {

            $row = Mobil::get();

            return DataTables::of($row)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return ' <button id="' . $row->id . '" class="btn btn-warning btn-sm edit"><i class="fas fa-edit mr-2"></i></button>
                            <button id="' . $row->id . '" class="btn btn-danger btn-sm delete"><i class="fas fa-trash mr-2"></i></button>
                    ';
                })
                ->rawColumns([ 'action'])

                ->make(true);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {

            $data = Mobil::where('id',$id)->first();
            if($data){
                return response()->json(['success' => 'successfull retrieve data', 'data' => $data->toJson()], 200);
            }


        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {

            $data = Mobil::findOrFail($id);
            $data->no_plat = $request->no_plat;
            $data->merk_mobil = $request->merk_mobil;
            $data->jenis_mobil = $request->jenis_mobil;
            $data->update();

            return response()->json(['success' => 'Data is successfully updated'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mobil $mobil)
    {
        try
        {
            Mobil::destroy($mobil->id);

            return response()->json(['success' => 'Data is successfully deleted'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
