<?=$this->extend('layout_frontend/template')?>
<?=$this->section('content')?>



<div class="col-9 border-right">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/kontent">Kontent</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cari materi keyword <?=$keyword;?></li>
        </ol>
    </nav>
        <?php if ($dataSearch) {?>
            <?php foreach ($dataSearch as $row): ?>
                <div class="card mb-5 mt-5">
                    <div class="row ">
                        <div class="col-md-4">
                            <img src="<?=base_url('file/gambar/' . $row->gambar)?>" class="card-img m-2" alt="..." style="height: 180px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <?php
                                    $db = \Config\Database::connect();
                                    $dataKategori = $db->table('kategori');
                                    $dataKelas = $db->table('kelas');
                                    $kategori = $dataKategori->where('id', $row->kategori_id)->get()->getRowArray();
                                    $kelas = $dataKelas->where('id', $row->kelas_id)->get()->getRowArray();
                                ?>
                                <span class="badge badge-info float-right mt-2"><?=$kelas['kelas'];?></span>
                                <span class="badge badge-info float-right mt-2 mr-1"><?=$kategori['kategori'];?></span>
                                <h5 class="card-title"><a href="/detail/<?=$row->slug;?>" class="text-dark"><?=$row->judul_materi;?></a></h5>
                                <p class="card-text"><?=word_limiter($row->prolog_materi, 20);?></p>
                                <p class="card-text">
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> Di publish pada
                                        <?php $date = date_create($row->created_at);
                                            echo date_format($date, "d M Y ");
                                        ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        <?php } else {?>

            <div class="card" style="margin-bottom: 200px;">
                <div class="card-body">
                    Materi yang anda cari tidak ditemukan
                </div>
            </div>
        <?php }?>
</div>

<?=$this->endSection()?>