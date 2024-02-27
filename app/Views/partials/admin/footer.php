</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="<?= base_url()?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url()?>dist/js/adminlte.js"></script>
<script src="<?= base_url()?>plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url()?>plugins/chart.js/Chart.min.js"></script>
<!-- <script src="dist/js/pages/dashboard3.js"></script> -->
<script src="<?= base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url()?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url()?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url()?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url()?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url()?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url()?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url()?>plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?= base_url()?>plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url()?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="<?= base_url()?>plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<script>
    $(function () {
    $("#dataTableFull, #dataTableFull1, #dataTableFull2").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "info": true,
      "paging": true,
      "dom": '<"top"f>rt<"bottom"><"row dt-margin"<"col-md-6"i><"col-md-6"p><"col-md-12"B>><"clear">',
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      "order": [[0, 'desc']] // Example: Sort the first column (index 0) in ascending order
    }).buttons().container().appendTo('#dataTableFull_wrapper .col-md-6:eq(0)');
  });

  $('.select2').select2({
  })

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  $('.summernote').summernote({height:300})

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  window.setTimeout(function() {
		$("#alert-auto").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove();
		});
	}, 3000);

</script>