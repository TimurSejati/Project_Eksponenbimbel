<?=$this->extend('layout_frontend/template')?>
<?=$this->section('content')?>

<div class="col-9 border-right">
    <?php if ($materi): ?>
        <?php foreach ($materi as $rowMateri): ?>
            <div class="card mb-5 mt-5" >
                <div class="row ">
                    <div class="col-md-4">
                        <img src="file/gambar/<?=$rowMateri['gambar'];?>" class="card-img m-2" alt="..." style="height: 220px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <?php
                                $db = \Config\Database::connect();
                                $dataKategori = $db->table('kategori');
                                $dataKelas = $db->table('kelas');
                                $kategori = $dataKategori->where('id', $rowMateri['kategori_id'])->get()->getRowArray();
                                $kelas = $dataKelas->where('id', $rowMateri['kelas_id'])->get()->getRowArray();
                            ?>
                            <span class="badge badge-info float-right mt-2"><?=$kelas['kelas'];?></span>
                            <span class="badge badge-info float-right mt-2 mr-1"><?=$kategori['kategori'];?></span>
                            <h5 class="card-title"><a href="/detail/<?=$rowMateri['slug'];?>" class="text-dark text-uppercase"><?=$rowMateri['judul_materi'];?></a></h5>
                            <p class="card-text"><?=word_limiter($rowMateri['prolog_materi'], 80);?></p>
                            <p class="card-text">         
                                <small class="text-muted"><i class="fa fa-clock-o"></i> Di publish pada
                                    <?php
                                        $date = Carbon\Carbon::create($rowMateri['created_at']);
                                        echo $date->diffForHumans();
                                        // $date = date_create($rowMateri['created_at']);
                                        // echo date_format($date, "d M Y ");
                                    ?>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <?=$pager->links('materi', 'materi_paginate');?>

</div>

<?=$this->endSection()?>