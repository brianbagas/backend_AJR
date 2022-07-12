<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class PemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemilik = Pemilik::all();

        if (count($pemilik)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$pemilik
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
        $storeData = $request->all();
        $storeData['waktu_kontrak'] = 5;
        $storeData['mulai_kontrak'] = '2020-12-01';
        $storeData['selesai_kontrak'] = '2023-01-12';

        $validate =Validator::make($storeData,[
            'nama'=>'required',
            'no_ktp'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
        ]);
        if($validate->fails())
        return response([
            'message'=> $validate->errors()], 400);
    


    $pemilik = Pemilik::create($storeData);
    return response([
        'message'=>'Add Mitra  Success',
        'data'=> $pemilik
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
        $pemilik = Pemilik::find($id);

        if(!is_null($pemilik)){
            return response([
                'message' => ' Retrieve Mitra Success',
                'data'=> $pemilik
            ],200);
        }

        return response([
            'message'=>'Mitra Not Found',
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
        $pemilik = Pemilik::find($id);
        if(is_null($pemilik)){
            return response([
                'message'=>'Mitra Not Found',
                'data'=>null
            ],404);
        }
        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'nama'=>'required',
            'no_ktp'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
        ]);

        if($validate->fails()){
            return response([
                'message'=>$validate->errors()
            ],400);
        }

        $pemilik->nama = $updateData['nama'];
        $pemilik->no_ktp = $updateData['no_ktp'];
        $pemilik->alamat = $updateData['alamat'];
        $pemilik->no_telp = $updateData['no_telp'];

        if($pemilik->save()){
            return response([
                'message'=>'Update Mitra Success',
                'data'=>$pemilik
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
        $pemilik = Pemilik::find($id);

        if(is_null($pemilik)){
            return response([
                'message'=>'Aset Not Found',
                'data'=>null
            ],404);
        }
        if($pemilik->delete()){
            return response([
                'message'=>'Delete Mitra Success',
                'data'=>$pemilik
            ],200);
        }

        return response([
            'message'=>'Delete Mitra Failed',
            'data'=>null
        ],400);
    }
}
