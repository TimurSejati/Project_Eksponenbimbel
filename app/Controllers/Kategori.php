<?php

namespace App\Controllers;

class Kategori extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Kategori'];
        return view('pages/kategori/index', $data);
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $data = ['tampilData' =>  $this->ktgr->findAll()];

            $msg = ['data' => view('pages/kategori/dataKategori', $data)];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formTambahKategori()
    {
        if ($this->request->isAJAX()) {
            $msg = ['data' => view('pages/kategori/modalTambahKategori')];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function simpanData()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required|is_unique[kategori.kategori]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama, silahkan coba yang lain',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' =>
                    [
                        'kategori' => $validation->getError('kategori'),
                    ]
                ];
            } else {
                $simpanData = [
                    'kategori' => $this->request->getVar('kategori'),
                ];

                $this->ktgr->insert($simpanData);

                $msg = ['success' => 'Data kategori berhasil disimpan'];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formEditKategori()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $row =  $this->ktgr->find($id);

            $data = [
                'id' => $id,
                'kategori' => $row['kategori'],
            ];

            $msg = [
                'success' => view('pages/kategori/modalEditKategori', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function updateData()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required|is_unique[kategori.kategori]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama, silahkan coba yang lain',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' =>
                    [
                        'kategori' => $validation->getError('kategori'),
                    ]
                ];
            } else {
                $simpanData = [
                    'kategori' => $this->request->getVar('kategori'),
                ];
                $id = $this->request->getVar('id');

                $this->ktgr->update($id, $simpanData);

                $msg = ['success' => 'Data kategori berhasil disimpan'];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->ktgr->delete($id);
            $msg = ['success' => 'Data kategori berhasil dihapus'];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
