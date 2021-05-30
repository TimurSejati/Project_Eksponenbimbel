<?= $this->extend('layout_backend/template') ?>
<?= $this->section('content') ?>

<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="<?= base_url() ?>/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script> -->
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>


<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card m-b-30">
                    <h4 class="card-header mt-0">Data Kategori Kelas</h4>
                    <div class="card-body">
                        <div class="card-title">

                        </div>

                        <p class="card-text viewdata mt-4">

                        </p>

                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
    </div><!-- container -->
</div> <!-- Page content Wrapper -->

<div class="viewModal" style="display: none;"></div>

<script>
    function dataKelas() {
        $.ajax({
            url: "<?= site_url('kelas/getData'); ?>",
            dataType: 'json',
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            }
        })
    }
    $(document).ready(function() {
        dataKelas();
    })
</script>

<?= $this->endSection() ?>