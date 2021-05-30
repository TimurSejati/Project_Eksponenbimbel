<?php

namespace App\Controllers;

class Search extends BaseController
{

    public function search()
    {
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $materi = $this->materi->search($keyword);
        } else {
            $materi = $this->materi;
        }
        $data = [
            'title' => 'Search',
            'keyword' => $keyword,
            'dataSearch' => $materi
        ];
        return view('pages/frontpage/cariMateri', $data);
    }
}
