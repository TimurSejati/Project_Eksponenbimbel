<!-- Modal -->
<div class="modal fade" id="modalEditMateri" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?=form_open_multipart('', ['class' => 'formMateri']);?>
            <?=csrf_field();?>
            <div class="modal-body">
                <div class="card m-b-30">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?=$id;?>">
                        <div class="form-group">
                            <label for="judulMateri">Judul Materi</label>
                            <input type="text" class="form-control" name="judulMateri" id="judulMateri" value="<?=$judul;?>">
                            <div class="invalid-feedback errorJudul"></div>
                        </div>

                        <div class="form-group">
                            <label for="ketMateri">Prolog Materi</label>
                            <!-- <textarea name="prolog" class="form-control"></textarea> -->
                            <textarea name="prolog" class="form-control"><?=$prolog;?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="ketMateri">Artikel Materi</label>
                            <!-- <textarea name="prolog" class="form-control"></textarea> -->
                            <textarea name="artikel" id="editor1" class="form-control"><?=$artikel;?></textarea>
                        </div>

                        <div class="getDataKategori"></div>

                        <div class="form-group">
                            <label>Upload Gambar</label>
                            <input type="hidden" name="gambarLama" value="<?=$gambar;?>">
                            <input type="file" name="gambar" id="gambar" class="dropify" data-default-file="file/gambar/<?=$gambar;?>" />
                            <small class="errorGambar text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload Materi</label>
                            <input type="hidden" name="modulLama" value="<?=$file;?>">
                            <input type="file" name="file" id="input-file-now" class="dropify" data-default-file="file/modul/<?=$file;?>" />
                            <small class=" errorFile text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnUbah">Ubah</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            <?=form_close();?>
        </div>
    </div>
</div>


<script>
    function getDataForm() {
        var kategoriId = "<?=$kategori?>";
        var kelasId = "<?=$kelas?>";
        $.ajax({
            url: "<?=site_url('materi/getDataFormKategori');?>",
            dataType: 'json',
            data: {
                kategori: kategoriId,
                kelas: kelasId
            },
            success: function(response) {
                $('.getDataKategori').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        })
    }
    CKEDITOR.replace('editor1', {
            extraPlugins: 'mathjax',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
            height: 320

            });

        if (CKEDITOR.env.ie && CKEDITOR.env.version == 8) {
        document.getElementById('ie8-warning').className = 'tip alert';
        }
    $(document).ready(function() {
        getDataForm();
        // Basic
        $('.dropify').dropify();

        $('.btnUbah').click(function(e) {
            e.preventDefault();

            let content = CKEDITOR.instances['editor1'].getData();
            let form = $('.formMateri')[0];
            let data = new FormData(form);
            data.append('artikel', content);


            $.ajax({
                type: "POST",
                url: "<?=site_url('materi/ubahData')?>",
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
                        $('#modalEditMateri').modal('hide');
                        dataMateri();
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
            });
        })
    })
</script>