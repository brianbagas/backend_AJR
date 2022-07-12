<?php

namespace App\Http\Controllers\Api;

use App\Models\Promo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $promo = Promo::all();

        if (count($promo)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$promo
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
        $storeData['status'] = True;
        $validate = Validator::make($storeData,[
            'kode_promo'=>'required',
            'jenis_promo'=>'required',
            'keterangan'=>'required',
            'diskon'=>'required',
            'status'=>'required',

        ]);

        if($validate->fails())
            return response([
                'message'=> $validate->errors()], 400);

        $promo = Promo::create($storeData);
        return response([
            'message'=>'Add Promo Success',
            'data'=> $promo
        ],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_promo)
    {
        $promo = Promo::find($id_promo);

        if(!is_null($promo)){
            return response([
                'message' => ' Retrieve Promo Success',
                'data'=> $promo
            ],200);
        }

        return response([
            'message'=>'Promo Not Found',
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
    public function update(Request $request, $id_promo)
    {
        $promo = Promo::find($id_promo);
        if(is_null($promo)){
            return response([
                'message'=>'Promo Not Found',
                'data'=>null
            ],404);
        }
        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'kode_promo'=>'required',
            'jenis_promo'=>'required',
            'keterangan'=> 'required',
            'diskon'=>'required',
            //'status'=>'required',
        ]);

        if($validate->fails()){
            return response([
                'message'=>$validate->errors()
            ],400);
        }
        $promo->kode_promo = $updateData['kode_promo'];
        $promo->jenis_promo= $updateData['jenis_promo'];
        $promo->keterangan= $updateData['keterangan'];
        $promo->diskon = $updateData['diskon'];
        //$promo->status = $updateData['status'];


 
        if($promo->save()){
            return response([
                'message'=>'Update Promo Success',
                'data'=>$promo
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
    public function destroy($id_promo)
    {
        $promo = Promo::find($id_promo);

        if(is_null($promo)){
            return response([
                'message'=>'Customer Not Found',
                'data'=>null
            ],404);
        }
        if($promo->delete()){
            return response([
                'message'=>'Delete Customer Success',
                'data'=>$promo
            ],200);
        }

        return response([
            'message'=>'Delete Customer Failed',
            'data'=>null
        ],400);
    }
}
