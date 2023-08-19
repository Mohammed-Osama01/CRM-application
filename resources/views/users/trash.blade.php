<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crm Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container m-5  pb-0">
        <div class="d-flex justify-content-between align-center">
            <h1 class="mt-0">Hello <span style="color:red; text-decoration: underline">{{ Auth::user()->name }}</span>
                with Dashboard</h1>

            <a class="btn btn-warning mt-2 btn-logout" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <img src="{{ Auth::user()->image }}" alt="">
        <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-primary mt-5 d-block w-25 ">Back To Home</a>
        <a href="#" class="btn btn-sm btn-primary mt-5 d-block w-25 ">All Trash</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Status</th>
                    <th scope="col">Address</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>{{ $client->status }}</td>
                        <td>{{ $client->address }}</td>
                        <td><img width="80" src="{{ asset('uploads/clients/' . $client->image) }}" alt="">
                        </td>
                        <td>{{ $client->description }}</td>
                        <td>
                            <a href="{{ route('Client.restore', $client->id) }}" class="btn btn-sm btn-primary"><i
                                    class="fas fa-undo"></i></a>
                            <a href="{{ route('Client.forcedelete', $client->id) }}" class="btn btn-sm btn-danger"><i
                                    class="fas fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @if (session('msg'))
        <script>
            Swal.fire(
                'Good job!',
                '{{ session('msg') }}',
                'success'
            )
        </script>
    @endif

    <script>
        $('.btn-delete').on('click', function() {
            let form = $(this).next('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        })
    </script>

</body>

</html>
