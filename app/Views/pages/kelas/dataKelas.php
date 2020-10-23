<table class="table table-striped no-wrap" id="dataKategori">
    <thead>
        <tr>
            <th style="width: 50px;">No</th>
            <th>Kategori</th>
            <th style="width: 305px;">Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no  = 0;
        foreach ($tampilData as $row) : $no++;  ?>
            <tr>

                <td><?= $no; ?></td>
                <td><?= $row['kategori']; ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary tambahDataKelas"><i class="mdi mdi-school"></i> Tambah Data Kelas</button>
                    <button type="button" class="btn btn-sm btn-info ubahDataKelas"><i class="fa fa-edit"></i> Ubah Data Kelas</button>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#dataKategori').DataTable({
            responsive: true
        });

        $('.tambahDataKelas').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('kelas/formUbahDataKelas'); ?>",
                dataType: 'json',

                success: function(response) {
                    $('.viewdata').html(response.data).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
            })
        })
    })
</script>