<?php

namespace App\Http\Controllers\Api;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::all();

        if (count($driver)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$driver
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
        $storeData['password'] = bcrypt($storeData['tgl_lahir']);
        $validate = Validator::make($storeData,[
            'nama'=>'required',
            'alamat'=>'required',
            'tgl_lahir'=>'required|date',
            'password'=>'required',
            'gender'=>'required',
            'email'=>'required|email',
            'foto'=>'image|file|max:1024|required',
            'sim'=>'image|file|max:1024|required',
            'napza'=>'image|file|max:1024|required',
            'jiwa'=>'image|file|max:1024|required',
            'jasmani'=>'image|file|max:1024|required',
            'skck'=>'image|file|max:1024|required',
            'status'=>'required',
            'id_role'=>'required',
        ]);
        $storeData['foto'] = $request->file('foto')->store('foto-driver');
        $storeData['sim'] = $request->file('sim')->store('foto-driver');
        $storeData['napza'] = $request->file('napza')->store('foto-driver');
        $storeData['jiwa'] = $request->file('jiwa')->store('foto-driver');
        $storeData['jasmani'] = $request->file('jasmani')->store('foto-driver');
        $storeData['skck'] = $request->file('skck')->store('foto-driver');
        if($validate->fails())
            return response([
                'message'=> $validate->errors()], 400);
        
        
        $driver = Driver::create($storeData);
        return response([
            'message'=>'Add Driver Success',
            'data'=> $driver
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_driver)
    {
        $driver = Driver::where('custom_id',$id_driver)->first();

        if(!is_null($driver)){
            return response([
                'message' => ' Retrieve Driver Success',
                'data'=> $driver
            ],200);
        }

        return response([
            'message'=>'Driver Not Found',
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
    public function update(Request $request, $id_driver)
    {
        $driver = Driver::where('custom_id', $id_driver)->first();
        if(is_null($driver)){
            return response([
                'message'=>'Driver Not Found',
                'data'=>null
            ],404);
        }
        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'nama'=>'required',
            'alamat'=>'required',
            'tgl_lahir'=>'required|date',
            'password'=>'required',
            'gender'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'bahasa'=>'required',
            'foto'=>'image|file|max:1024|required',
            'sim'=>'image|file|max:1024|required',
            'napza'=>'image|file|max:1024|required',
            'jiwa'=>'image|file|max:1024|required',
            'jasmani'=>'image|file|max:1024|required',
            'skck'=>'image|file|max:1024|required',
        ]);
        $updateData['foto'] = $request->file('foto')->store('foto-driver');
        $updateData['sim'] = $request->file('sim')->store('foto-driver');
        $updateData['napza'] = $request->file('napza')->store('foto-driver');
        $updateData['jiwa'] = $request->file('jiwa')->store('foto-driver');
        $updateData['jasmani'] = $request->file('jasmani')->store('foto-driver');
        $updateData['skck'] = $request->file('skck')->store('foto-driver');

        if($validate->fails()){
            return response([
                'message'=>$validate->errors()
            ],400);
        }

        $driver->nama = $updateData['nama'];
        $driver->alamat = $updateData['alamat'];
        $driver->tgl_lahir = $updateData['tgl_lahir'];
        $driver->gender = $updateData['gender'];
        $driver->email = $updateData['email'];
        $driver->password= bcrypt($updateData['password']);
        $driver->bahasa=$updateData['bahasa'];
        $driver->foto = $updateData['foto'];
        $driver->sim = $updateData['sim'];
        $driver->napza = $updateData['napza'];
        $driver->jiwa = $updateData['jiwa'];
        $driver->jasmani = $updateData['jasmani'];
        $driver->skck = $updateData['skck'];
    



        if($driver->save()){
            return response([
                'message'=>'Update Driver Success',
                'data'=>$driver
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
    public function destroy($id_driver)
    {
        $driver = Driver::where('custom_id',$id_driver)->first();

        if(is_null($driver)){
            return response([
                'message'=>'Driver Not Found',
                'data'=>null
            ],404);
        }
        if($driver->delete()){
            return response([
                'message'=>'Delete Driver Success',
                'data'=>$driver
            ],200);
        }

        return response([
            'message'=>'Delete Driver Failed',
            'data'=>null
        ],400);
    }
}
