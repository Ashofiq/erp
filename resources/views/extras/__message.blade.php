@if (session()->has('message'))
    <script>
        // Swal.fire({
        //     position: 'top-end',
        //     icon:  "{{ Session::get('message')['class']; }}",
        //     title: "{{ Session::get('message')['message']; }}",
        //     showConfirmButton: false,
        //     timer: 1500
        // })

    </script>
    <div class="alert alert-{{ Session::get('message')['class'] }} text-center" role="alert">
        {{ Session::get('message')['message']; }}
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  


@endif