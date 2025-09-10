<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Properties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">

    <div class="container">
        <h2 class="mb-4">Manage Properties</h2>

        <table class="table table-bordered table-hover shadow-sm bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>City</th>
                    <th>Posted By</th>
                    <th>Status</th>
                    <th width="220">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>{{ $loop->index }}</td>
                        <td>{{ $property->title }}</td>
                        <td class="text-capitalize">{{ $property->listing_type }}</td>
                        <td>{{ number_format($property->price, 2) }} {{ $property->currency }}</td>
                        <td>{{ $property->city }}</td>
                        <td>{{ $property->user->name ?? 'N/A' }}</td>

                        <td>
                            @if ($property->is_published)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-secondary">Pending</span>
                            @endif
                        </td>
                        <td>
                            {{-- <form action="{{ route('approve', $property->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <form action="{{ route('disapprove', $property->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-sm">Disapprove</button>
                            </form>

                            <form action="{{ route('destroy', $property->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>

</html>
