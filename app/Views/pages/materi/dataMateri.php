<h4 class="mt-0 card-header">Data Materi</h4>
<div class="card-body" >
    <div class="card-title">
        <button type="button" class="btn btn-primary btn-sm tombolTambahMateri">
            <i class="fa fa-plus"></i> Tambah Data Materi
        </button>
    </div>

    <table class="table  table-striped no-wrap" id="dataMateri" >
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Judul Materi</th>
                <th>Prolog Materi</th>
                <th>Kategori</th>
                <th>Kelas</th>
                <th>Gambar</th>
                <th style="width: 25px; text-align: center;">File</th>
                <th style="width: 55px; text-align: center;">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
foreach ($tampilData as $row): $no++;?>
																				                <tr>
																				                    <td><?=$no;?></td>
																				                    <td><?=$row['judul_materi'];?></td>
																				                    <td><?=$row['prolog_materi'];?></td>
																				                    <td>
																				                        <?php
    $db = \Config\Database::connect();
    $id = $row['kategori_id'];
    $builder = $db->table('kategori');
    $query = $builder->where('id', $id)->get();

    foreach ($query->getResult() as $r) {
        echo $r->kategori;
    }

    ?>
																				                    </td>
																				                    <td>
																				                        <?php
    $db = \Config\Database::connect();
    $id = $row['kelas_id'];
    $builder = $db->table('kelas');
    $query = $builder->where('id', $id)->get();

    foreach ($query->getResult() as $r) {
        echo $r->kelas;
    }
    ?>
																				                    </td>
																				                    <td><img src="/file/gambar/<?=$row['gambar'];?>" style="width: 220px; height: 160px;" alt=""></td>
																				                    <td><a href="/file/modul/<?=$row['file']?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a></td>
																				                    <td>
																				                        <button type="button" class="btn btn-sm btn-info" onClick="edit('<?=$row['id'];?>')"><i class="fa fa-tags"></i> </button>
																				                        <button type="button" class="btn btn-sm btn-danger" onClick="hapus('<?=$row['id'];?>')"><i class="fa fa-trash"> </i></button>
																				                    </td>
																				                </tr>

																				            <?php endforeach;?>
        </tbody>
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#dataMateri').DataTable({
            responsive: true
        });

        $('.tombolTambahMateri').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?=site_url('materi/formTambahMateri');?>",
                dataType: 'json',
                success: function(response) {
                    $('.viewModal').html(response.data).show();
                    $('#modalTambahMateri').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
            })
        })
    })

    function edit(id) {
        $.ajax({
            type: 'post',
            url: "<?=site_url('materi/formEditMateri');?>",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('.viewModal').html(response.success).show();
                    $('#modalEditMateri').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }

        })
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus',
            text: `Yakin menghapus data materi ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'post',
                    url: "<?=site_url('materi/hapus');?>",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success
                            })
                            dataMateri();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                    }

                })
            }
        })
    }
</script>