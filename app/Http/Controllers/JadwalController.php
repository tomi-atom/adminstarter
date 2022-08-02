<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kursus;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peserta = User::select('users.id','name')
            ->leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id','3')
            ->orderBy('users.id', 'ASC')
            ->get();
        $instruktur = User::select('users.id','name')
            ->leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->where('model_has_roles.role_id','2')
            ->orderBy('users.id', 'ASC')
            ->get();
        return view('kursus.jadwal.index',compact('peserta','instruktur'));
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
            Jadwal::create($request->all());

            return response()->json(['success' => 'Data berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $kursus
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try
        {

            $row = Kursus::get();

            return DataTables::of($row)
                ->addIndexColumn()
                ->addColumn('peserta', function ($row) {
                    $peserta = User::select('name')
                        ->where('id',$row->id_peserta)
                        ->first();
                    return '<small>'.$peserta->name.'</small>';

                })

                ->addColumn('jemput', function ($row) {
                    if ($row->jemput == 1){
                        return '<span class="badge badge-primary">Ya</span> Biaya : <small>Rp.'.format_uang($row->biaya_jemput).'</small>';
                    }
                    else{
                        return '<small class="badge badge-danger">Tidak </small>';
                    }
                })
                ->addColumn('sim', function ($row) {
                    if ($row->sim == 1){
                        return '<small class="badge badge-success">Ya</small> Biaya : <small>Rp.'.format_uang($row->biaya_sim).'</small>';
                    }
                    else{
                        return '<small class="badge badge-danger">Tidak </small>';
                    }
                })
                ->addColumn('biaya', function ($row) {
                    return ' <small>Rp.'.format_uang($row->biaya).'</small>';

                })
                ->addColumn('pembayaran', function ($row) {
                    $pembayaran = Pembayaran::select('jumlah')
                        ->leftJoin('kursuses','pembayarans.id_kursus', 'kursuses.id')
                        ->where('id_kursus',$row->id)
                        ->get();
                    $data = '';
                    $no = 0;
                    // here we prepare the options
                    foreach ($pembayaran as $list) {
                        $no++;
                        $data .= '<small class="badge badge-success">Pembayaran '.$no.'</small><small>  Rp.'.format_uang($list->jumlah).  '</small><button id="' . $row->id . '" class="btn btn-primary btn-xs editbayar"><i class="fas fa-cash-register mr-2"></i></button><br>'
                        ;
                    }
                    $return =
                        '<td class="text-left">Total Biaya : Rp.'.format_uang($row->biaya_jemput + $row->biaya_sim+ $row->biaya ). '</td><br>
                                <td class="text-left">' .$data . '</td>
                           ';
                    return $return;
                })



                ->addColumn('action', function ($row) {
                    return '
                     <button id="' . $row->id . '" class="btn btn-success btn-sm bayar"><i class="fas fa-cash-register mr-2"></i></button>
                     <button id="' . $row->id . '" class="btn btn-warning btn-sm edit"><i class="fas fa-edit mr-2"></i></button>
                            <button id="' . $row->id . '" class="btn btn-danger btn-sm delete"><i class="fas fa-trash mr-2"></i></button>
                    ';
                })
                ->rawColumns(['peserta','instruktur','jemput','sim','biaya','pembayaran','jadwal', 'action'])

                ->make(true);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $kursus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {

            $data = Jadwal::where('id',$id)->first();
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
     * @param  \App\Models\Jadwal  $kursus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {

            $data = Jadwal::findOrFail($id);
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
     * @param  \App\Models\Jadwal  $kursus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $data =Jadwal::find($id);
            $data->delete();

            return response()->json(['success' => 'Data is successfully deleted'], 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
