<h4 class="card-header mt-0">Tambah Kelas Kategori <?= $data['kategori'] ?></h4>
<div class="card-body">

    <?= form_open('kelas/simpanDataKelas', ['class' => 'formSimpanKelas']); ?>
    <?= csrf_field(); ?>
    <div class="mb-3 ">
        <button type="button" class="btn btn-warning btn-sm btnKembali">
            <i class="fa fa-chevron-left"></i> Kembali
        </button>
        <button type="submit" class="btn btn-primary btn-sm float-right btnSimpanDataKelas">
            <i class="fa fa-save"></i> Simpan Data
        </button>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kelas</th>
                <th style="width: 50px;">Opsi</th>
            </tr>
        </thead>
        <tbody class="formTambah">
            <tr>
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <td>
                    <input type="text" name="kelas[]" class="form-control">
                </td>

                <td>
                    <button type="button" class="btn btn-primary btnAddForm"><i class="fa fa-plus"></i></button>
                </td>

            </tr>
        </tbody>
    </table>
    <?= form_close(); ?>

</div>



<script>
    $(document).ready(function() {

        $('.formSimpanKelas').submit(function(e) {
            e.preventDefault()
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.btnSimpanDataKelas').attr('disable', 'disabled');
                    $('.btnSimpanDataKelas').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpanDataKelas').removeAttr('disable');
                    $('.btnSimpanDataKelas').html('<i class="fa fa-save"></i> Simpan Data');
                },
                success: function(response) {

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.success}`,
                        }).then((result) => {
                            if (result.value) {
                                // window.location.href = ("<?= site_url('kategori/index') ?>");
                                dataKelas(response.redirectId);
                            }
                        })
                    }

                },

                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
            });
            return false;
        });

        $('.btnAddForm').click(function(e) {
            e.preventDefault();

            $('.formTambah').append(`
                <tr>
                    <td>
                    <input type="text" name="kelas[]" class="form-control">
                    </td>

                    <td>
                    <button type="button" class="btn btn-danger btnDeleteForm"><i class="fa fa-trash"></i></button>
                    </td>

                </tr>
            `)
        })

        $('.btnKembali').click(function(e) {
            e.preventDefault();
            dataKategori();
        })
    })

    $(document).on('click', '.btnDeleteForm', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();
    })
</script>