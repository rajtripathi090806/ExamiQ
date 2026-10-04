
$(document).ready(function () {

    new DataTable('#studentsTable', {
        
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        order: [[1, 'asc']],
        paging: false,
        select: { style: 'multi' }
    });

});
