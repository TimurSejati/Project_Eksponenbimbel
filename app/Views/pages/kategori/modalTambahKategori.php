<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('kategori/simpanData', ['class' => 'formKategori']); ?>
      <?= csrf_field(); ?>
      <div class="modal-body">
        <div class="form-group row">
          <label for="nim" class="col-sm-2 col-form-label">Kategori</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="kategori" name="kategori">
            <div class="invalid-feedback errorKategori"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('.formKategori').submit(function(e) {
      e.preventDefault()
      $.ajax({
        type: 'post',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function() {
          $('.btnSimpan').attr('disable', 'disabled');
          $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
        },
        complete: function() {
          $('.btnSimpan').removeAttr('disable');
          $('.btnSimpan').html('Simpan');
        },
        success: function(response) {
          if (response.error) {
            if (response.error.kategori) {
              $('#kategori').addClass('is-invalid');
              $('.errorKategori').html(response.error.kategori);
            } else {
              $('#kategori').removeClass('is-invalid');
              $('.errorKategori').html('');
            }
          } else {
            Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: response.success,
            })
            $('#modalTambah').modal('hide');
            dataKategori();
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