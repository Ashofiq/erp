// date initialize
$(function () {
    $('.date').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    });
});

$(function () {
    

    var datatable = $('.datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });

    $('#datatableSearch').keyup(function(){
        datatable.search($(this).val()).draw() ;
    })

    $('#datatableLength').keyup(function () {
        datatable.page.len($(this).val()).draw();
    } );

    datatable.on( 'draw', function () {
        $('.paginate_button.previous').html('<a class="page-link" href="#" tabindex="-1" aria-disabled="true"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>prev</a>');
        $('.paginate_button.next').html('<a class="page-link" href="#">next <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg></a>');
    });

    
});

