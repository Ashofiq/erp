@if (session()->has('message'))
    <script>
        // Swal.fire({
        //     position: 'top-end',
        //     icon:  "{{ Session::get('message')['class']; }}",
        //     title: "{{ Session::get('message')['message']; }}",
        //     showConfirmButton: false,
        //     timer: 1500
        // })

        $('#myModal').modal('show');
    </script>
    <div class="alert alert-{{ Session::get('message')['class'] }} text-center" role="alert">
        {{ Session::get('message')['message']; }}
    </div>


@endif