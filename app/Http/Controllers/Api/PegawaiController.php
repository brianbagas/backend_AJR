<?php

namespace App\Http\Controllers\Api;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\File;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = Pegawai::all();

        if (count($pegawai)>0){
            return response([
                'message'=>'Retrieve All Success',
                'data'=>$pegawai
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
        $storeData['password'] = bcrypt($storeData['tgl_lahir']) ;
        $validate = Validator::make($storeData,[
            'nama'=>'required',
            'alamat'=>'required',
            'tgl_lahir'=>'required|date',
            'password'=>'required',
            'gender'=>'required',
            'email'=>'required|email',
            'foto'=>'image|file|max:1024|required',
            'status'=>'required',
            'id_role'=>'required',
        ]);
        $storeData['foto'] = $request->file('foto')->store('foto-pegawai');
        if($validate->fails())
            return response([
                'message'=> $validate->errors()], 400);
        
        
        $pegawai = Pegawai::create($storeData);
        return response([
            'message'=>'Add Pegawai Success',
            'data'=> $pegawai
        ],200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_pegawai)
    {
        $pegawai = Pegawai::where('custom_id',$id_pegawai)->first();

        if(!is_null($pegawai)){
            return response([
                'message' => ' Retrieve Pegawai Success',
                'data'=> $pegawai
            ],200);
        }

        return response([
            'message'=>'Pegawai Not Found',
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
    public function update(Request $request, $id_pegawai)
    {
        $pegawai = Pegawai::where('custom_id', $id_pegawai)->first();
        if(is_null($pegawai)){
            return response([
                'message'=>'Customer Not Found',
                'data'=>null
            ],404);
        }
        $updateData = $request->all();
        // $image = $request->file('foto');
        // $imageString = "";
        // parse_str($image,$imageString);
        // $updateData['foto'] = $imageString;
        // if($image != null)
        // {
        //     return response([
        //         'message' => 'Foto tidak terdeteksi',
        //         'data'=>null,
        //     ],333);
        // }else{
        //     return response([
        //         'message' => 'LAlalaal',
        //         'data'=>null,
        //     ],404);

        // }

        
        $validate = Validator::make($updateData,[
            'nama'=>'required',
            'alamat'=>'required',
            'tgl_lahir'=>'required|date',
            'password'=>'required',
            'gender'=>'required',
            'email'=>'required|email',
            'foto'=>'image|file|required',
            'id_role'=>'required',
        ]);
        $updateData['foto']= $request->file('foto')->store('foto-pegawai');
        if($validate->fails()){
            return response([
                'message'=>$validate->errors()
            ],400);
        }

        $pegawai->nama = $updateData['nama'];
        $pegawai->alamat = $updateData['alamat'];
        $pegawai->tgl_lahir = $updateData['tgl_lahir'];
        $pegawai->gender = $updateData['gender'];
        $pegawai->email = $updateData['email'];
        $pegawai->password = bcrypt($updateData['password']) ;
        $pegawai->foto = $updateData['foto'];
        $pegawai->id_role = $updateData['id_role'];
        


        if($pegawai->save()){
            return response([
                'message'=>'Update Customer Success',
                'data'=>$pegawai
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
    public function destroy($id_pegawai)
    {
        $pegawai = Pegawai::where('custom_id',$id_pegawai)->first();

        if(is_null($pegawai)){
            return response([
                'message'=>'Pegawai Not Found',
                'data'=>null
            ],404);
        }
        if($pegawai->delete()){
            return response([
                'message'=>'Delete Pegawai Success',
                'data'=>$pegawai
            ],200);
        }

        return response([
            'message'=>'Delete Customer Failed',
            'data'=>null
        ],400);
    }
    /**
 * Display the specified resource.
 *
 * @param \App\Post $post
 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
 * @throws \Illuminate\Auth\Access\AuthorizationException
 */
// public function image(Pegawai $post)
// {
//     return response()->file(
//         Storage::disk('local')->path($post->img_path)
//     );
// }


}
