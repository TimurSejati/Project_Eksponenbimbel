    <!-- Begin page -->
        <?=$this->include('layout_frontend/loadAsset');?>
        <!-- Start content -->
        <div class="content">
            <div class="mb-0 jumbotron jumbotron-fluid bg-info">
                <h1 class="mt-5 mb-3 text-center text-uppercase text-white">Cinta Ilmu, Gemar Belajar</h1>
                <div class="container">
                    <form action="<?=site_url('Search/search')?>" autocomplete="off" class="form-horizontal" method="post" accept-charset="utf-8">
                        <div class="p-2 card">
                            <div class="input-group">
                                <input name="search" class="border-0 form-control" type="text" placeholder="Lagi pengen belajar apa?" autofocus>
                                <button class="ml-1 btn btn-info w-md">Cari</button>
                            </div>
                        </div>
                    </form>

                    <nav class="mt-3 navbar navbar-expand-lg navbar-light">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <?php $db = \Config\Database::connect();
                                    $dataKategori = $db->table('kategori');
                                    $queryKategori = $dataKategori->get();
                                ?>

                                <?php foreach ($queryKategori->getResult() as $row): ?>
                                    <li class="mr-3 nav-item dropdown">
                                        <a class="text-white nav-link dropdown-toggle" href="kategori" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?=$row->kategori;?>
                                        </a>
                                        <?php $dataKelas = $db->table('kelas');
                                            $queryKelas = $dataKelas->where('kategori_id', $row->id)->get();?>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <?php foreach ($queryKelas->getResult() as $rowKelas): ?>
                                                <a class="dropdown-item" href="/menu/<?=str_replace(" ", "-", strtolower($row->kategori))?>/<?=$rowKelas->id?>"><?=$rowKelas->kelas?></a>
                                            <?php endforeach;?>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>


            <div class="card ">
                <div class="card-body">
                    <div>
                        <div class="mx-5">
                            <div class="row">
                                <?=$this->renderSection('content')?>
                                <div class="col-3">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item mr-1" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Materi</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Artikel</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="card bg-info mt-3">
                                                <div class="text-white card-header">
                                                    Total Materi
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <?php $dataMateri = $db->table('materi');
                                                        $queryMateri = $dataMateri->groupBy('kategori_id')->get();
                                                    ?>

                                                    <?php foreach ($queryMateri->getResult() as $rowMateri): ?>
                                                        <?php
                                                            $kategoriName = $dataKategori->where('id', $rowMateri->kategori_id)->get();
                                                            $countMateriByKategori = $dataMateri->where('kategori_id', $rowMateri->kategori_id)->get()->getResultArray();
                                                        ?>

                                                        <?php foreach ($kategoriName->getResult() as $rowNameKategori): ?>
                                                            <li class="list-group-item"><?=$rowNameKategori->kategori;?> (<?=count($countMateriByKategori);?>)</li>
                                                        <?php endforeach;?>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="card">
                                                <div class="card-body">
                                                    Masih dalam pengembangan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- content -->
    </div>
    <!-- END wrapper -->

    <footer class="text-white pt-5 pb-5 bg-info">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4>Eksponen Bimbel</h4>
                    <small class="mb-3 d-block text-white"> © <?=date("Y");?></small>
                </div>
                <div class="col-md-3 col-sm-4">
                    <h5>Materi</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-white" href="#">Pembahasan Soal</a></li>
                        <li><a class="text-white" href="#">Bank Soal</a></li>
                        <li><a class="text-white" href="#">Model Pembelajaran</a></li>
                        <li><a class="text-white" href="#">Perangkat Pembelajaran</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4">
                    <h5>Media Sosial</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-white" href="#">Youtube</a></li>
                        <li><a class="text-white" href="#">Twitter</a></li>
                        <li><a class="text-white" href="#">Facebook</a></li>
                        <li><a class="text-white" href="#">Whatsapp</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-4">
                    <h5>Tentang</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-white" href="#">Team</a></li>
                        <li><a class="text-white" href="#">Lokasi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery  -->
    <script src="<?=base_url()?>/assets/js/popper.min.js"></script>
    <script src="<?=base_url()?>/assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>/assets/js/modernizr.min.js"></script>
    <script src="<?=base_url()?>/assets/js/detect.js"></script>
    <script src="<?=base_url()?>/assets/js/fastclick.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.slimscroll.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.blockUI.js"></script>
    <script src="<?=base_url()?>/assets/js/waves.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.nicescroll.js"></script>
    <script src="<?=base_url()?>/assets/js/jquery.scrollTo.min.js"></script>

    <!-- App js -->
    <script src="<?=base_url()?>/assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>

</body>

</html>
