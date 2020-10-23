<h4 class="card-header mt-0">Ubah Kelas </h4>
<div class="card-body">

    <div class="mb-3 ">
        <button type="button" class="btn btn-warning btn-sm btnKembali">
            <i class="fa fa-chevron-left"></i> Kembali
        </button>

    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kelas</th>
                <th style="width: 110px;">Opsi</th>
            </tr>
        </thead>
        <?php if ($dataKelas) { ?>
            <?php foreach ($dataKelas as $row) : ?>

                <tbody>
                    <tr>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>" id="id">
                        <td>
                            <input type="text" name="kelas" class="form-control" value="<?= $row['kelas'] ?>" disabled>
                        </td>

                        <td>
                            <button type="button" class="btn btn-info" onclick="ubahKelas(<?= $row['id'] ?>)"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="hapusKelas(<?= $row['id'] ?>,<?= $idKategori[0] ?>)"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        <?php } else { ?>
            <tbody>
                <tr>
                    <td colspan="2" class="text-center text-bold">
                        Belum ada kelas
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>

</div>




<script>
    $(document).ready(function() {
        $('.btnKembali').click(function(e) {
            e.preventDefault();
            dataKategori();
        })
    })

    function ubahKelas(id) {
        $.ajax({
            type: 'post',
            url: "<?= site_url('kelas/formUbahKelas'); ?>",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('.viewModal').html(response.success).show();
                    $('#modalUbahKelas').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }

        })
    }

    function hapusKelas(id, idKategori) {
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
                    url: "<?= site_url('kelas/hapusKelas'); ?>",
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
                        }
                        dataKelas(idKategori);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                    }

                })
            }
        })
    }
</script>