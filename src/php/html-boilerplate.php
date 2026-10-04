
<?php

function injectBoilerplate($title, $cssFile) {
    echo "
        <!DOCTYPE html>
        <html lang='en' dir='ltr' data-bs-theme='dark'>
        
        <head>

            <meta charset='utf-8' />
            <meta name='viewport' content='width=device-width, initial-scale=1.0' />

            <title>$title</title>

            <!-- bootstrap 5 cdn -->
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css' />

            <!-- bootstrap icons cdn -->
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css' />

            <!-- poppins font cdn -->
            <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap' />

            <!-- datatables cdn -->
            <link rel='stylesheet' href='https://cdn.datatables.net/3.1.1/css/dataTables.dataTables.min.css' />
            <link rel='stylesheet' href='https://cdn.datatables.net/3.1.1/css/dataTables.bootstrap5.min.css' />

            <!-- datatables - select box cdn -->
            <link rel='stylesheet' href='https://cdn.datatables.net/fixedcolumns/6.1.0/css/fixedColumns.dataTables.min.css' />
            <link rel='stylesheet' href='https://cdn.datatables.net/select/4.1.0/css/select.dataTables.min.css' />

            <!-- tom-select cdn - for multi-select & searchable dropdown -->
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css'>

            <!-- custom css files -->
            <link rel='stylesheet' href='../src/css/universal.css' />
            <link rel='stylesheet' href='../src/css/$cssFile' />

        </head>
    ";
}

?>
