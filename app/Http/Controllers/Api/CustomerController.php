<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();

        if (count($customer)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$customer
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
        $storeData['verifikasi_data'] = false;
        $storeData['password'] = bcrypt($storeData['tgl_lahir_customer']) ;
        $storeData['KTP'] = $request->file('KTP')->store('ktp-customer');
        $storeData['SIM'] = $request->file('SIM')->store('sim-customer');
        $validate = Validator::make($storeData,[
            'nama_customer'=> 'required',
            'no_ktp'=> 'required',
            'password'=> 'required',
            'alamat_customer'=>'required',
            'tgl_lahir_customer'=>'required|date',
            'gender_customer'=>'required',
            'no_telp_customer'=>'required',
            'email'=>'required|email',
            'verifikasi_data'=>'required',
            'status'=>'required',
        ]);


        if($validate->fails())
            return response([
                'message'=> $validate->errors()], 400);
                

        $customer = Customer::create($storeData);
        return response([
            'message'=>'Add Customer Success',
            'data'=> $customer
        ],200);




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_customer)
    {
        $customer = Customer::where('custom_id',$id_customer)->first();

        if(!is_null($customer)){
            return response([
                'message' => ' Retrieve Customer Success',
                'data'=> $customer
            ],200);
        }

        return response([
            'message'=>'Customer Not Found',
            'data'=>null
        ],404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_customer)
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
    public function update(Request $request, $id_customer)
    {
        $customer = Customer::where('custom_id', $id_customer)->first();
        if(is_null($customer)){
            return response([
                'message'=>'Customer Not Found',
                'data'=>null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'nama_customer'=> 'required',
            'no_ktp'=> 'required',
            'password'=> 'required',
            'alamat_customer'=>'required',
            'tgl_lahir_customer'=>'required|date',
            'gender_customer'=>'required',
            'no_telp_customer'=>'required',
            'email'=>'required|email',
            'verifikasi_data'=>'required',
        ]);
        $updateData['password'] = bcrypt($updateData['password']) ;

        if($validate->fails()){
            return response([
                'message'=>$validate->errors()
            ],400);
        }

        $customer->nama_customer = $updateData['nama_customer'];
        $customer->no_ktp = $updateData['no_ktp'];
        $customer->password = $updateData['password'];
        $customer->alamat_customer=$updateData['alamat_customer'];
        $customer->tgl_lahir_customer = $updateData['tgl_lahir_customer'];
        $customer->gender_customer = $updateData['gender_customer'];
        $customer->no_telp_customer = $updateData['no_telp_customer'];
        $customer->email = $updateData['email'];
        $customer->verifikasi_data = $updateData['verifikasi_data'];

        if($customer->save()){
            return response([
                'message'=>'Update Customer Success',
                'data'=>$customer
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
    public function destroy($id_customer)
    {
        $customer = Customer::where('custom_id',$id_customer)->first();

        if(is_null($customer)){
            return response([
                'message'=>'Customer Not Found',
                'data'=>null
            ],404);
        }
        if($customer->delete()){
            return response([
                'message'=>'Delete Customer Success',
                'data'=>$customer
            ],200);
        }

        return response([
            'message'=>'Delete Customer Failed',
            'data'=>null
        ],400);
    }
}
