<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<script text="text/javascript">
    $(document).ready(function () {

        $('#data-table').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();

    });
</script>
