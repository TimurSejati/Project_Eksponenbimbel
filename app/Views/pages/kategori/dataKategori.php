<h4 class="card-header mt-0">Data Kategori Materi</h4>
<div class="card-body">
    <div class="card-title">
        <button type="button" class="btn btn-primary btn-sm tombolTambahKategori">
            <i class="fa fa-plus"></i> Tambah Data Kategori
        </button>
    </div>

    <table class="table table-striped no-wrap" id="dataKategori">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Kategori</th>
                <th style="width: 255px; text-align: center;">Opsi Kategori</th>
                <th style="width: 315px; text-align: center;">Opsi Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php $no  = 0;
            foreach ($tampilData as $row) : $no++;  ?>
                <tr>

                    <td><?= $no; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info" onClick="edit('<?= $row['id']; ?>')"><i class="fa fa-tags"></i> Ubah Kategori</button>
                        <button type="button" class="btn btn-sm btn-danger" onClick="hapus('<?= $row['id']; ?>')"><i class="fa fa-trash"> Hapus Kategori</i></button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" onclick="tambahDataKelas(<?= $row['id'] ?>)"><i class="mdi mdi-school"></i> Tambah Data Kelas</button>
                        <button type="button" class="btn btn-sm btn-info" onclick="dataKelas(<?= $row['id'] ?>)"><i class="fa fa-edit"></i> Ubah Data Kelas</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<script>
    $(document).ready(function() {
        $('#dataKategori').DataTable({
            responsive: true
        });

        $('.tombolTambahKategori').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('kategori/formTambahKategori'); ?>",
                dataType: 'json',
                success: function(response) {
                    $('.viewModal').html(response.data).show();
                    $('#modalTambah').modal('show');
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
            url: "<?= site_url('kategori/formEditKategori'); ?>",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('.viewModal').html(response.success).show();
                    $('#modalEdit').modal('show');
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
            text: `Yakin menghapus data kategori ini ?`,
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
                    url: "<?= site_url('kategori/hapus'); ?>",
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
                            dataKategori();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                    }

                })
            }
        })
    }

    function tambahDataKelas(id) {
        $.ajax({
            url: "<?= site_url('kelas/formTambahDataKelas'); ?>",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $('.viewdata').html(response.data).show();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        })
    }

    function dataKelas(id) {
        $.ajax({
            url: "<?= site_url('kelas/formUbahDataKelas'); ?>",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $('.viewdata').html(response.data).show();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        })
    }
</script>