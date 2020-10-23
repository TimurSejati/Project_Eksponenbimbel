<?php

namespace App\Controllers;

class Kelas extends BaseController
{

    // public function index()
    // {
    //     $data = ['title' => 'Kelas'];
    //     return view('pages/kelas/index', $data);
    // }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $data = ['tampilData' =>  $this->ktgr->findAll()];
            $msg = ['data' => view('pages/kelas/dataKelas', $data)];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formTambahDataKelas()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['data' => $this->ktgr->find($id)];
            $msg = ['data' => view('pages/kelas/tambahDataKelas', $data)];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function simpanDataKelas()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $kelas = $this->request->getVar('kelas');
            $jmlh_data = count($kelas);
            for ($i = 0; $i < $jmlh_data; $i++) {
                $this->kls->insert([
                    'kategori_id' => $id,
                    'kelas' => $kelas[$i]
                ]);
            }

            $msg = ['success' => 'Data kelas berhasil disimpan', 'redirectId' => $id];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formUbahDataKelas()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = ['dataKelas' => $this->kls->where('kategori_id', $id)->findAll(), 'idKategori' => $id];
            $msg = ['data' => view('pages/kelas/ubahDataKelas', $data)];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formUbahKelas()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'data' => $this->kls->find($id),
            ];
            $msg = ['success' => view('pages/kelas/modalUbahKelas', $data)];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function ubahKelas()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kelas' => [
                    'label' => 'Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' =>
                    [
                        'kelas' => $validation->getError('kelas'),
                    ]
                ];
            } else {
                $ubahData = [
                    'kelas' => $this->request->getVar('kelas'),
                ];
                $id = $this->request->getVar('id');

                $this->kls->update($id, $ubahData);

                $msg = ['success' => 'Data kelas berhasil diubah', 'id' => $this->request->getVar('katId')];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function hapusKelas()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $this->kls->delete($id);
            $msg = ['success' => 'Data kategori berhasil dihapus'];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
