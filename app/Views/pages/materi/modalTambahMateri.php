<!-- Modal -->
<div class="modal fade" id="modalTambahMateri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formMateri']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judulMateri">Judul Materi</label>
                            <input type="text" class="form-control" name="judulMateri" id="judulMateri" aria-describedby="emailHelp">
                            <div class="invalid-feedback errorJudul"></div>
                        </div>


                        <div class="form-group">
                            <label for="ketMateri">Prolog Materi</label>
                            <!-- <textarea name="prolog" class="form-control"></textarea> -->
                            <textarea name="prolog" id="editor1" class="form-control"></textarea>
                        </div>


                        <div class="getDataKategori"></div>

                        <div class="form-group">
                            <label>Upload Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="dropify" />
                            <small class="errorGambar text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload Materi</label>
                            <input type="file" name="file" id="input-file-now" class="dropify" />
                            <small class="errorFile text-danger"></small>
                        </div>


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
    function getDataForm() {
        $.ajax({
            url: "<?= site_url('materi/getDataFormKategori'); ?>",
            dataType: 'json',
            success: function(response) {
                $('.getDataKategori').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        })
    }

    $(document).ready(function() {
        getDataForm();

        CKEDITOR.replace('editor1');


        $('.btnSimpan').click(function(e) {
            e.preventDefault();

            let content = CKEDITOR.instances['editor1'].getData();
            let form = $('.formMateri')[0];
            let data = new FormData(form);
            data.append('prolog', content);


            $.ajax({
                type: "POST",
                url: "<?= site_url('materi/simpanData') ?>",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function(e) {
                    $('.btnSimpan').prop('disabled', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function(e) {
                    $('.btnSimpan').removeAttr('disabled', 'disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {


                    if (response.error) {
                        if (response.error.kategori_id) {
                            $('#selectKategori').addClass('is-invalid');
                            $('.errorKategori').html(response.error.kategori_id);
                        } else {
                            $('#selectKategori').removeClass('is-invalid');
                            $('.errorKategori').html('');
                        }

                        if (response.error.judulMateri) {
                            $('#judulMateri').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judulMateri);
                        } else {
                            $('#judulMateri').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }

                        if (response.error.gambar) {
                            $('.errorGambar').html(response.error.gambar);
                        } else {
                            $('.errorGambar').html('');
                        }

                        if (response.error.file) {
                            $('.errorFile').html(response.error.file);
                        } else {
                            $('.errorFile').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.success,
                        })
                        $('#modalTambahMateri').modal('hide');
                        dataMateri();
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
            });
        })

        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>