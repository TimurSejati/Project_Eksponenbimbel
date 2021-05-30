<?php

namespace App\Controllers;

class Menu extends BaseController
{

    public function menu($kategori, $kelas)
    {
        $getNameKelas = $this->kls->where('id', $kelas)->find();
        $replKategori = str_replace("-", " ", strtoupper($kategori));
        $replKelas = $getNameKelas[0]['kelas'];
        $gIdKtgr = $this->ktgr->where('kategori', $replKategori)->find();
        $getIdKategori = $gIdKtgr[0]['id'];
        $getDataByMenu = $this->materi->where('kategori_id', $getIdKategori)->where('kelas_id', $kelas)->orderBy('id', 'asc')->paginate(1, 'materi');

        $data = [
            'title' => "Materi $replKategori $replKelas",
            'data' => $getDataByMenu,
            'pager' => $this->materi->pager,
            'breadcrumb' => "$replKategori $replKelas"
        ];

        return view('pages/frontpage/materiByKategori', $data);
    }
}
