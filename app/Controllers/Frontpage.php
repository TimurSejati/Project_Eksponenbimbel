<?php

namespace App\Controllers;

class Frontpage extends BaseController
{

    public function kontent()
    {
        $data = [
            'title' => 'Konten Materi',
            'materi' => $this->materi->orderBy('id', 'desc')->paginate(4, 'materi'),
            'pager' => $this->materi->pager,
            'isActive' => true,
        ];
        return view('pages/frontpage/kontent', $data);
    }

    public function home()
    {
        $data = [
            'title' => 'Home',
        ];
        return view('pages/frontpage/home', $data);
    }

    public function registerPage()
    {
        $data = [
            'title' => 'Registrasi Member',
        ];
        return view('pages/frontpage/registerBimbel', $data);
    }

    public function detail($slug)
    {

        $dataMateri = $this->materi->where('slug', $slug)->find();
        $judul = $dataMateri[0]['judul_materi'];

        $namaFile = $dataMateri[0]['file'];

        $data = [
            'title' => "Detail Materi $judul",
            'materi' => $dataMateri,
            'isActive' => true,
        ];
        return view('pages/frontpage/detailMateri', $data);
    }

}
