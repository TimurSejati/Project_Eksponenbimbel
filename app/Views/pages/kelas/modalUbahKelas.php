<!-- Modal -->
<div class="modal fade" id="modalUbahKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('kelas/ubahKelas', ['class' => 'formKelas']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input type="hidden" class="form-control" name="id">
                <div class="form-group row">
                    <label for="nim" class="col-sm-2 col-form-label">Kelas</label>
                    <input type="hidden" name="katId" value="<?= $data['kategori_id']; ?>">
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $data['kelas']; ?>">
                        <div class="invalid-feedback errorKelas"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary ubahKelas">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        $('.formKelas').submit(function(e) {
            e.preventDefault()
            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('.ubahKelas').attr('disable', 'disabled');
                    $('.ubahKelas').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.ubahKelas').removeAttr('disable');
                    $('.ubahKelas').html('Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.kelas) {
                            $('#kelas').addClass('is-invalid');
                            $('.errorKelas').html(response.error.kelas);
                        } else {
                            $('#kelas').removeClass('is-invalid');
                            $('.errorKelas').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        })
                        $('#modalUbahKelas').modal('hide');
                        dataKelas(response.id);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
            });
            return false;
        });

    })
</script>