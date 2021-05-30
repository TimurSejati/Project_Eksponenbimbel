<?php

namespace App\Controllers;

class Materi extends BaseController
{

    public function index()
    {
        $data = ['title' => 'Materi'];
        return view('pages/materi/index', $data);
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $data = ['tampilData' => $this->materi->findAll()];

            $id = $this->materi->find('kategori_id');

            $msg = ['data' => view('pages/materi/dataMateri', $data)];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formTambahMateri()
    {
        if ($this->request->isAJAX()) {
            $msg = ['data' => view('pages/materi/modalTambahMateri')];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function getDataFormKategori()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'dataKategori' => $this->ktgr->findAll(),
                'kategori' => $this->request->getVar('kategori'),
                'kelas' => $this->request->getVar('kelas'),
            ];
            $msg = ['data' => view('pages/materi/formGetDataKategori', $data)];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function getKelasByKategori()
    {
        if ($this->request->isAJAX()) {
            $idKategori = $this->request->getVar('id');
            $data = $this->kls->where('kategori_id', $idKategori)->findAll();
            $output = '';
            foreach ($data as $row) {
                $output .= '<option value="' . $row['id'] . '">' . $row['kelas'] . '</option>';
            }
            echo json_encode($output);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function getKelasDataEdit()
    {
        if ($this->request->isAJAX()) {
            $idKategori = $this->request->getVar('idKategori');
            $idKelas = $this->request->getVar('idKelas');
            $data = $this->kls->where('kategori_id', $idKategori)->findAll();

            $output = '';
            foreach ($data as $row) {
                $condition = $row['id'] == $idKelas ? 'selected' : '';
                $output .= '<option value="' . $row['id'] . '" ' . $condition . '  >' . $row['kelas'] . '</option>';
            }
            echo json_encode($output);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function simpanData()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'judulMateri' => [
                    'label' => 'Judul materi',
                    'rules' => 'required|is_unique[materi.judul_materi]',
                    'errors' => [
                        'required' => '{field} wajib di isi',
                        'is_unique' => '{field} sudah ada',
                    ],
                ],
                'kategori_id' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus di isi',
                    ],
                ],
                'gambar' => [
                    'label' => 'Gambar',
                    'rules' => 'mime_in[gambar,image/png,image/jpg,image/jpeg]|is_image[gambar]',
                    'errors' => [
                        'mime_in' => 'harus dalam bentuk gambar',
                    ],
                ],
                'file' => [
                    'label' => 'File Materi',
                    'rules' => 'ext_in[file,pdf,docx,doc]',
                    'errors' => [
                        'ext_in' => 'File yang diupload harus dalam bentuk extensi pdf atau doc',
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kategori_id' => $validation->getError('kategori_id'),
                        'judulMateri' => $validation->getError('judulMateri'),
                        'gambar' => $validation->getError('gambar'),
                        'file' => $validation->getError('file'),
                    ],
                ];
            } else {

                $judul = $this->request->getVar('judulMateri');
                $slug = $this->seoURL($judul);
                $prolog = $this->request->getVar('prolog');
                $artikel = $this->request->getVar('artikel');

                $kategoriId = $this->request->getVar('kategori_id');
                $kelasId = $this->request->getVar('kelas_id');
                // $namaKategori = $this->ktgr->find($kategoriId);

                $kelas = $this->request->getVar('kelas');

                $fileGambar = $this->request->getFile('gambar');
                $fileModul = $this->request->getFile('file');

                if ($fileGambar->getError() == 4) {
                    $namaGambar = 'default.png';
                } else {
                    $namaGambar = $fileGambar->getName();
                    $fileGambar->move('file/gambar', $namaGambar);
                }

                if ($fileModul->getError() == 4) {
                    $namaModul = 'default.pdf';
                } else {
                    $namaModul = $fileModul->getName();
                    $fileModul->move('file/modul', $namaModul);
                }

                $data = [
                    'judul_materi' => $judul,
                    'slug' => $slug,
                    'prolog_materi' => $prolog,
                    'artikel_materi' => $artikel,
                    'kategori_id' => $kategoriId,
                    'kelas_id' => $kelasId,
                    'gambar' => $namaGambar,
                    'file' => $namaModul,
                ];

                $this->materi->insert($data);

                $msg = ['success' => 'Berhasil menyimpan materi'];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    private function seoURL($text)
    {
        $text = strtolower(htmlentities($text));
        $text = str_replace(' ', '-', $text);
        return $text;
    }

    public function formEditMateri()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $row = $this->materi->find($id);

            $data = [
                'id' => $id,
                'judul' => $row['judul_materi'],
                'prolog' => $row['prolog_materi'],
                'artikel' => $row['artikel_materi'],
                'kategori' => $row['kategori_id'],
                'kelas' => $row['kelas_id'],
                'gambar' => $row['gambar'],
                'file' => $row['file'],
            ];

            $msg = [
                'success' => view('pages/materi/modalEditMateri', $data),
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function ubahData()
    {
        if ($this->request->isAJAX()) {
            // Cek Judul Materi
            $cekData = $this->materi->find($this->request->getVar('id'));
            if ($cekData['judul_materi'] == $this->request->getVar('judulMateri')) {
                $ruleJudul = 'required';
            } else {
                $ruleJudul = 'required|is_unique[materi.judul_materi]';
            }
            // Validation
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'judulMateri' => [
                    'label' => 'Judul materi',
                    'rules' => $ruleJudul,
                    'errors' => [
                        'required' => '{field} wajib di isi',
                        'is_unique' => '{field} sudah ada',
                    ],
                ],
                'gambar' => [
                    'label' => 'Gambar',
                    'rules' => 'mime_in[gambar,image/png,image/jpg,image/jpeg]|is_image[gambar]',
                    'errors' => [
                        'mime_in' => 'harus dalam bentuk gambar',
                    ],
                ],
                'file' => [
                    'label' => 'File Materi',
                    'rules' => 'ext_in[file,pdf,docx,doc]',
                    'errors' => [
                        'ext_in' => 'File yang diupload harus dalam bentuk extensi pdf atau doc',
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'judulMateri' => $validation->getError('judulMateri'),
                        'gambar' => $validation->getError('gambar'),
                        'file' => $validation->getError('file'),
                    ],
                ];
            } else {
                $id = $this->request->getVar('id');
                $judul = $this->request->getVar('judulMateri');
                $slug = $this->seoURL($judul);
                $prolog = $this->request->getVar('prolog');
                $artikel = $this->request->getVar('artikel');
                $kategoriId = $this->request->getVar('kategori_id');
                $kelasId = $this->request->getVar('kelas_id');

                $fileGambar = $this->request->getFile('gambar');
                $fileModul = $this->request->getFile('file');

                $gambarLama = $this->request->getVar('gambarLama');
                $modulLama = $this->request->getVar('modulLama');

                if ($fileGambar->getError() == 4) {
                    $namaGambar = $gambarLama;
                } else {
                    $namaGambar = $fileGambar->getName();
                    $fileGambar->move('file/gambar');
                    if ($gambarLama != 'default.png') {
                        unlink('file/gambar/' . $gambarLama);
                    }
                }

                if ($fileModul->getError() == 4) {
                    $namaModul = $modulLama;
                } else {
                    $namaModul = $fileModul->getName();
                    $fileModul->move('file/modul', $namaModul);
                    if ($modulLama != 'default.pdf') {
                        unlink('file/modul/' . $modulLama);
                    }
                }

                $data = [
                    'judul_materi' => $judul,
                    'slug' => $slug,
                    'prolog_materi' => $prolog,
                    'artikel_materi' => $artikel,
                    'kategori_id' => $kategoriId,
                    'kelas_id' => $kelasId,
                    'gambar' => $namaGambar,
                    'file' => $namaModul,
                ];

                $this->materi->update($id, $data);

                $msg = [
                    'success' => "Data materi berhasil diubah",
                ];
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

            $cekFile = $this->materi->find($id);
            $gambarLama = $cekFile['gambar'];
            $fileLama = $cekFile['file'];

            if ($gambarLama != 'default.png') {
                unlink('file/gambar/' . $gambarLama);
            }

            if ($fileLama != 'default.pdf') {
                unlink('file/modul/' . $fileLama);
            }

            $this->materi->delete($id);
            $msg = ['success' => 'Data kategori berhasil dihapus'];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
