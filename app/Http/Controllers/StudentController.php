<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //mengambil data dari input search
        $search = $request->search;
        //memanggil libraries baseapi methodnya index dengan mengirim parameter 1 berupa path data dari Api nya, parameter2 data untuk mengisi search_nama Apinya
        //new BaseApi untuk memanggil libraries dari baseapinya dan NEW nya untuk 
        // cara kedua manggil class
        //search_nama ngirim request ke baseapi
        $data = (new BaseApi)->index('/api/students', ['search_nama'=>$search]);
        // ambil respon jsonnya
        $students = $data->json();
        // dd($students);
        //kirim hasil pengambilan data blade index
        //'data' dari ApiFormatter
        //'students' sesuai dengan index
        return view('index')->with(['students' => $students['data']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nis_siswa' => $request->nis_siswa,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];
        $proses =(new BaseApi)->store('/api/students/tambah/data', $data);
        if ($proses->failed()){
            $errors = $proses->json('data');
            // dd($proses);
            return redirect()->back()->with(['errors'=> $errors]);
        }else{
            return redirect('/')->with('success', 'Berhasil menambahkan data baru ke students API');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //proses ambil data api ke route REST API /student/{id}
        // . untuk menyambungkan route student sama route id 
        $data = (new BaseApi)->edit('/api/students/'. $id);
        if ($data->failed()){
            //
            $errors = $data->json(['data']);
            // dd($proses);
            return redirect()->back()->with(['errors'=> $errors]);
        }else{
            $student = $data->json(['data']);
            // dd($data->json());
            return view('edit')->with(['student' => $student]);
        }
    }

    /**
     * Update the specified resource in storage.
     */

     //Request $request megngambil inputan dari blade
    public function update(Request $request,  $id)
    {
        //data yang akan dikirim ($request ke REST API)
        $payload = [
            'nama' =>$request->nama,
            'nis_siswa' =>$request->nis_siswa,
            'rombel' =>$request->rombel,
            'rayon' =>$request->rayon,
        ];

        //panggil method update dari BaseAPi, Kirim endpoint (route update dari RestApinya ) Dan data ($payload diatas)
        $proses = (new BaseApi)->update('/api/students/update/'. $id, $payload);
        if ($proses->failed()){
            //
            $errors = $proses->json(['data']);
            // dd($proses);
            return redirect()->back()->with(['errors'=> $errors]);
        }else{
            return redirect('/')->with('success', 'Berhasil mengubah data baru ke students API');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $proses = (new BaseApi)->destroy('/api/students/delete/'. $id);
        if ($proses->failed()){
            //
            $errors = $proses->json(['data']);
            // dd($proses);
            return redirect()->back()->with(['errors'=> $errors]);
        }else{
            return redirect('/')->with('success', 'Berhasil menghapus data dari students API');
        }
    }

    public function trash()
    {
        $data = (new BaseApi)->trash('api/students/show/trash',);
        $trash = $data->json();
            return view ('trash')->with(['trash' => $trash['data']]);
    }

    public function restore($id)
    {
        $proses = (new BaseApi)->restore('api/students/trash/restore/'.$id);
        if ($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['Errors' => $errors]);
        }else{
            return redirect('/')->with('success', 'berhasil restore data');
        }
    }

    public function permanenDelete($id)
    {
        $proses= (new BaseApi)->permanenDelete('api/students/trash/delete/permanen/'.$id);
        if($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['Errors' => $errors]);
        }else{
            return redirect()->back()->with(['success', 'berhasil data permanent']);
        }
    }
}
