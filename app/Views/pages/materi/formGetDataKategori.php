<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Kategori</label>
            <input type="hidden" id="kategoriId" value="<?= $kategori; ?>">
            <input type="hidden" id="kelasId" value="<?= $kelas; ?>">

            <select class="form-control" id="selectKategori" name="kategori_id">
                <option value="">Kategori</option>
                <?php foreach ($dataKategori as $row) : ?>
                    echo "<option value="<?= $row['id'] ?>" <?= $kategori == $row['id'] ?  'selected' : ''; ?>><?= $row['kategori'] ?></option>";
                <?php endforeach; ?>

            </select>
            <small class="text-danger errorKategori"></small>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Kelas</label>
            <select class="form-control" id="selectKelas" name="kelas_id">
                <option value="">Pilih Kelas</option>

            </select>
        </div>
    </div>
</div>

<script>
    function getKelasDataEdit() {
        var kategoriId = $('#kategoriId').val();
        var kelasId = $('#kelasId').val();
        // alert(data);
        $.ajax({
            type: "POST",
            url: "<?= site_url('materi/getKelasDataEdit') ?>",
            data: {
                idKategori: kategoriId,
                idKelas: kelasId,
            },
            dataType: "json",
            success: function(response) {
                $('#selectKelas').html(response)
            }
        });
    }

    $(document).ready(function() {
        getKelasDataEdit();
        $('#selectKategori').change(function() {
            var id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= site_url('materi/getKelasByKategori') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#selectKelas').html(response)
                }
            });
        })
    })
</script>