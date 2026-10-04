
<?php

function injectFooter($jsFile) {
    echo "
        <!-- bootstrap 5 cdn -->
        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js'></script>

        <!-- jQuery cdn -->
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js'></script>

        <!-- datatables cdn -->
        <script type='text/javascript' src='https://cdn.datatables.net/3.1.1/js/dataTables.min.js'></script>
        <script type='text/javascript' src='https://cdn.datatables.net/3.1.1/js/dataTables.bootstrap5.min.js'></script>

        <!-- datatables - select box cdn -->
        <script type='text/javascript' src='https://cdn.datatables.net/fixedcolumns/6.1.0/js/dataTables.fixedColumns.min.js'></script>
        <script type='text/javascript' src='https://cdn.datatables.net/fixedcolumns/6.1.0/js/fixedColumns.dataTables.min.js'></script>
        <script type='text/javascript' src='https://cdn.datatables.net/select/4.1.0/js/dataTables.select.min.js'></script>
        <script type='text/javascript' src='https://cdn.datatables.net/select/4.1.0/js/select.dataTables.min.js'></script>

        <!-- tom-select cdn - for multi-select & searchable dropdown -->
        <script src='https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js'></script>

        <!-- sweetalert -->
        <script type='text/javascript' src='../src/includes/sweetalert_11.14.4/sweetalert_11.14.4.js'></script>
        <script type='text/javascript' src='../src/includes/sweetalert_11.14.4/Swal.mixin.js'></script>

        <!-- custom js files -->
        <script type='text/javascript' src='../src/js/universal.js'></script>
        <script type='text/javascript' src='../src/js/datatables.js'></script>
        <script type='text/javascript' src='../src/js/$jsFile'></script>
    ";
}

?>
