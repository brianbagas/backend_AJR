<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();

        if (count($transaksi)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$transaksi
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function showByIdCus($id){
        $transaksi = Transaksi::where('id_customer',$id)->get();

        if (count($transaksi)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$transaksi
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->all();
        $storeData['denda'] = 0;
        $storeData['verifikasi_pembayaran'] = "false";
        $storeData['verifikasi_dokumen'] = "false";
        $storeData['metode_pembayaran'] = "Transfer";
        $storeData['tgl_transaksi'] = date('Y-m-d');
        $storeData['rating'] = 0;
        if(!is_null($storeData['id_driver']) ){
            $storeData['jenis_transaksi']="mobil+driver";
        }else{
            $storeData['jenis_transaksi']="Mobil";
        }
        $validate = Validator::make($storeData,[
            'tgl_mulai'=>'required|date',
            'tgl_selesai'=>'required|date',
            'biaya'=>'required',
            'denda'=>'required',
            'metode_pembayaran'=>'required',
            'bukti_pembayaran'=>'required|image',
            'verifikasi_pembayaran'=>'required',
            'id_customer'=>'required',
            'id_aset'=>'required',
        ]);

        $storeData['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran');

        if($validate->fails())
            return response([
                'message'=> $validate->errors()], 400);
        
    
        $transaksi = Transaksi::create($storeData);
        return response([
            'message'=>'Add Transaksi Success',
            'data'=> $transaksi
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::where('custom_id',$id)->first();

        if(!is_null($transaksi)){
            return response([
                'message' => ' Retrieve Transaksi Success',
                'data'=> $transaksi
            ],200);
        }

        return response([
            'message'=>'Transaksi Not Found',
            'data'=>null
        ],404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::where('custom_id', $id)->first();
        if(is_null($transaksi)){
            return response([
                'message'=>'Transaksi Not Found',
                'data'=>null
            ],404);
        }
        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'tgl_mulai'=>'required',
            'tgl_selesai'=>'required',
            'biaya'=>'required',
            'denda'=>'required',
            'rating'=>'required',
            'metode_pembayaran'=>'required',
            //'bukti_pembayaran'=>'required',
            'verifikasi_pembayaran'=>'required',
            'id_customer'=>'required',
            'id_aset'=>'required',
        ]);
        if($validate->fails()){
            return response([
                'message'=>$validate->errors()
            ],400);
        }

        $transaksi->tgl_mulai = $updateData['tgl_mulai'];
        $transaksi->tgl_selesai = $updateData['tgl_selesai'];
        $transaksi->tgl_pengembalian = $updateData['tgl_pengembalian'];
        $transaksi->biaya = $updateData['biaya'];
        $transaksi->denda = $updateData['denda'];
        $transaksi->rating = $updateData['rating'];
        //$transaksi->bukti_pembayaran = $updateData['metode_pembayaran'];
        $transaksi->verifikasi_pembayaran= $updateData['verifikasi_pembayaran'];
        $transaksi->id_customer = $updateData['id_customer'];
        $transaksi->id_aset = $updateData['id_aset'];
        $transaksi->id_pegawai = $updateData['id_pegawai'];
        
        if($transaksi->save()){
            return response([
                'message'=>'Update Transaksi Success',
                'data'=>$transaksi
            ],200);
        }

        return response([
            'message'=> 'Update Data Failed',
            'data'=>null
        ],400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::where('custom_id',$id)->first();

        if(is_null($transaksi)){
            return response([
                'message'=>'transaksi Not Found',
                'data'=>null
            ],404);
        }
        if($transaksi->delete()){
            return response([
                'message'=>'Delete transaksi Success',
                'data'=>$transaksi
            ],200);
        }

        return response([
            'message'=>'Delete transaksi Failed',
            'data'=>null
        ],400);
    }

    public function showLaporanmobil($month,$year){
        if(is_null(Transaksi::all())) {
            return response([
                'message' => 'Empty',
                'data' => null
            ], 400);
        }

        $transaksi = DB::table('transaksi')
        ->join('aset','transaksi.id_aset','=','aset.id')
        ->select('transaksi.id_aset','aset.tipe','aset.nama_mobil',DB::raw('COUNT(aset.id) as jumlah , SUM(transaksi.biaya) as Pendapatan'))
        ->whereMonth('transaksi.tgl_transaksi',$month)
        ->whereYear('transaksi.tgl_transaksi',$year)
        ->groupBy('transaksi.id_aset','aset.tipe','aset.nama_mobil')
        ->get();

        
        if (count($transaksi)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$transaksi
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);

    }

    public function showLaporanCus($month,$year) {
        if(is_null(Transaksi::all())) {
            return response([
                'message' => 'Empty',
                'data' => null
            ], 400);
        }

        $transaksi = DB::table('transaksi')
        ->join('aset','transaksi.id_aset','=','aset.id')
        ->join('customer','customer.custom_id','=','transaksi.id_customer')
        ->select('customer.nama_customer','aset.nama_mobil','transaksi.jenis_transaksi',DB::raw('COUNT(transaksi.id_customer) as jumlah_transaksi , SUM(transaksi.biaya) as Pendapatan'))
        ->whereMonth('transaksi.tgl_transaksi',$month)
        ->whereYear('transaksi.tgl_transaksi',$year)
        ->groupBy('customer.nama_customer','aset.nama_mobil','transaksi.jenis_transaksi')
        ->get();
        if (count($transaksi)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$transaksi
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);

    }

    public function showLaporanDriv($month,$year){
        if(is_null(Transaksi::all())) {
            return response([
                'message' => 'Empty',
                'data' => null
            ], 400);
        }

        $transaksi = DB::table('transaksi')
        ->join('driver','transaksi.id_driver','=','driver.custom_id')
        ->select('transaksi.id_driver','driver.nama',DB::raw('COUNT(transaksi.id_driver) as jumlah_transaksi'))
        ->whereMonth('transaksi.tgl_transaksi',$month)
        ->whereYear('transaksi.tgl_transaksi',$year)
        ->groupBy('transaksi.id_driver','driver.nama')
        ->get();
        if (count($transaksi)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$transaksi
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);
    }
    public function showLaporanPerforma($month,$year){
        if(is_null(Transaksi::all())) {
            return response([
                'message' => 'Empty',
                'data' => null
            ], 400);
        }

        $transaksi = DB::table('transaksi')
        ->join('driver','transaksi.id_driver','=','driver.custom_id')
        ->select('transaksi.id_driver','driver.nama',DB::raw('COUNT(transaksi.id_driver) as jumlah_transaksi , AVG(transaksi.rating) as rerata'))
        ->whereMonth('transaksi.tgl_transaksi',$month)
        ->whereYear('transaksi.tgl_transaksi',$year)
        ->groupBy('transaksi.id_driver','driver.nama')
        ->get();
        if (count($transaksi)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$transaksi
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);
    }

    public function showLaporanCusTerbanyak($month,$year) {
        if(is_null(Transaksi::all())) {
            return response([
                'message' => 'Empty',
                'data' => null
            ], 400);
        }

        $transaksi = DB::table('transaksi')
        ->join('customer','customer.custom_id','=','transaksi.id_customer')
        ->select('customer.nama_customer',DB::raw('COUNT(transaksi.id_customer) as jumlah_transaksi'))
        ->whereMonth('transaksi.tgl_transaksi',$month)
        ->whereYear('transaksi.tgl_transaksi',$year)
        ->groupBy('customer.nama_customer')
        ->orderByRaw('jumlah_transaksi DESC')
        ->limit(5)
        ->get();
        if (count($transaksi)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$transaksi
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);

    }
}
