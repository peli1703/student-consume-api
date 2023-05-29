<?php
//namespace untuk mengatur posisi file
namespace App\Http\Libraries;
//Helpers sama seperti servis yang nanti property method yang bakal dipanggil di controller(hanya satu method)
use Illuminate\Support\Facades\http;

class BaseApi
{
    // variabel yg cuma bisa diakses di class ini dan turunannya
    protected $baseurl;
    //constructor : menyiapkan isi data, dijalankan otomatis tanpa dipanggil 
    public function __construct()
    {
        //var $baseurl yang diatas diisi nilainya dari file .env bagian API_HOST
        //var ini diisi otomatis ketika file/class BaseApi dipanggil di controller
        $this->baseurl ="http://127.0.0.1:3333";
    }
    private function client()
    {
        //koneksikan ip dari var $baseurl ke depedency http
        // menggunakan depedency http karena project api nya berbasis web( protect http )
        return Http::baseurl($this->baseurl);
    }
    public function index(string $endpoint, Array $data = [])
    {
        //manggil ke function yang diatas, terus manggil path yang dari $endpoint yang dikirim controller, kalau ada data yang mau dicari params di  
        return $this->client()->get($endpoint, $data);
    }
    public function store(string $endpoint, Array $data = [])
    {
        //pake post( ) karena buat route tambah data di project APInya pakai ::post
        return $this->client()->post($endpoint, $data);
    }
    public function edit(string $endpoint, Array $data = [])
    {
        //pake get( ) karena buat route tambah data di project APInya pakai ::get
        return $this->client()->get($endpoint, $data);
    }
    public function update(string $endpoint, Array $data = [])
    {
        //pake patch( ) karena buat route tambah data di project APInya pakai ::patch
        return $this->client()->patch($endpoint, $data);
    }
    public function destroy(string $endpoint, Array $data = [])
    {
        //pake delete( ) karena buat route tambah data di project APInya pakai ::delete
        return $this->client()->delete($endpoint, $data);
    }
    public function trash(string $endpoint, Array $data = [])
    {
        //pake get( ) karena buat route tambah data di project APInya pakai ::get
        return $this->client()->get($endpoint, $data);
    }
    public function restore(string $endpoint, Array $data = [])
    {
        //pake get( ) karena buat route tambah data di project APInya pakai ::get
        return $this->client()->get($endpoint, $data);
    }
    public function permanenDelete(string $endpoint, Array $data = [])
    {
        //pake get( ) karena buat route tambah data di project APInya pakai ::get
        return $this->client()->get($endpoint, $data);
    }
}




?>