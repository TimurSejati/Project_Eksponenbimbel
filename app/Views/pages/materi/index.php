<?= $this->extend('layout/template') ?>
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

<!-- Dropzone css -->
<link href="<?= base_url() ?>/assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/plugins/dropify/css/dropify.min.css" rel="stylesheet">

<!-- Dropzone js -->
<script src="<?= base_url() ?>/assets/plugins/dropzone/dist/dropzone.js"></script>
<script src="<?= base_url() ?>/assets/plugins/dropify/js/dropify.min.js"></script>

<!--Wysiwig js-->
<script src="<?= base_url() ?>/assets/plugins/tinymce/tinymce.min.js"></script>

<!-- Ckeditor -->
<script src="<?= base_url(); ?>/assets/plugins/ckeditor/ckeditor.js"></script>


<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card m-b-30 viewdata">

                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
    </div><!-- container -->
</div> <!-- Page content Wrapper -->

<div class="viewModal" style="display: none;"></div>

<script>
    function dataMateri() {
        $.ajax({
            url: "<?= site_url('materi/getData'); ?>",
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
        dataMateri();
    })
</script>

<?= $this->endSection() ?>