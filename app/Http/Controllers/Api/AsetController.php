<?php

namespace App\Http\Controllers\Api;

use App\Models\Aset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aset = Aset::all();

        if (count($aset)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$aset
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
        $aset = Aset::where('status','tersedia')->first();

        if (count($aset)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$aset
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);
    }
    public function showByStatus()
    {
        $aset = Aset::where('status','tersedia')->get();

        if (!is_null($aset)){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$aset
            ],200);
          
        }

        return response([
            'message'=>'Empty',
            'data'=>null
        ],400);
    }

    public function showByIdBrosur($id){
        $aset = Aset::where('id_brosur',$id)->get();

        if (count($aset)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$aset
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
        $storeData['status']="Tersedia";
        $storeData['id_pemilik']=NULL;
        $storeData['id_brosur']=1;
        $validate = Validator::make($storeData,[
            'nama_mobil'=>'required',
            'plat_nomor'=>'required',
            'stnk'=>'required',
            'kategory'=>'required',
            'kapasitas'=>'required',
            'tipe'=>'required',
            'transmisi'=>'required',
            'bahanBakar'=>'required',
            'warna'=>'required',
            'status'=>'required',
            'harga'=>'required',
            'id_brosur'=>'required',

        ]);

        if($validate->fails())
            return response([
                'message'=> $validate->errors()], 400);
        
    

        $aset = Aset::create($storeData);
        return response([
            'message'=>'Add Mobil Success',
            'data'=> $aset
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_aset)
    {
        $aset = Aset::find($id_aset);

        if(!is_null($aset)){
            return response([
                'message' => ' Retrieve Mobil Success',
                'data'=> $aset
            ],200);
        }

        return response([
            'message'=>'Mobil Not Found',
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
    public function update(Request $request, $id_aset)
    {
        $aset = Aset::find($id_aset);
        if(is_null($aset)){
            return response([
                'message'=>'Aset Not Found',
                'data'=>null
            ],404);
        }
        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'nama_mobil'=>'required',
            'plat_nomor'=>'required',
            'stnk'=>'required',
            'kategory'=>'required',
            'kapasitas'=>'required',
            'tipe'=>'required',
            'transmisi'=>'required',
            'bahanBakar'=>'required',
            'warna'=>'required',
            //'status'=>'required',
            'harga'=>'required',
            //'id_pemilik'=>'required',
            //'id_brosur'=>'required',
        ]);

        if($validate->fails()){
            return response([
                'message'=>$validate->errors()
            ],400);
        }

        $aset->nama_mobil = $updateData['nama_mobil'];
        $aset->plat_nomor = $updateData['plat_nomor'];
        $aset->stnk = $updateData['stnk'];
        $aset->kategory = $updateData['kategory'];
        $aset->kapasitas = $updateData['kapasitas'];
        $aset->tipe= $updateData['tipe'];
        $aset->transmisi = $updateData['transmisi'];
        $aset->warna = $updateData['warna'];
       // $aset->status = $updateData['status'];
        $aset->harga = $updateData['harga'];
        //$aset->id_pemilik = $updateData['id_pemilik'];
        $aset->id_brosur = $updateData['id_brosur'];



        if($aset->save()){
            return response([
                'message'=>'Update Mobil Success',
                'data'=>$aset
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
    public function destroy($id_aset)
    {
        $aset = Aset::find($id_aset);

        if(is_null($aset)){
            return response([
                'message'=>'Aset Not Found',
                'data'=>null
            ],404);
        }
        if($aset->delete()){
            return response([
                'message'=>'Delete Aset Success',
                'data'=>$aset
            ],200);
        }

        return response([
            'message'=>'Delete Aset Failed',
            'data'=>null
        ],400);
    }
}
