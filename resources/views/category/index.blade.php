<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href=" {{ asset('/css/bootstrap.min.css') }}">

</head>

<body>
    <div class='container'>

        <h1 class="mb-3">{{ $title }}
            <small><a href="/categories/create">create</a></small>
        </h1>

        @if($flashMessage)
        <div class="alert alert-success">
            {{ $flashMessage }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Discription</th>
                        <th>Parent_id</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($categories as $category)
                    <tr>
                        <td> {{ $category->id }}</td>
                        <td><a href="{{ url('categories', $category->id) }}"> {{ $category->name }}</a></td>
                        <td> {{ $category->discription }}</td>
                        <td> {{ $category->parent_id }}</td>
                        <!-- <td> <img src="{{$category->getFirstMediaUrl()}}" height="100px" width="100px"></td> -->
                        <td> <img src="{{asset('/images/category/' . $category->photo)}}" height="100px" width="100px"></td>
                        <td> {{ $category->created_at }}</td>
                        <td><a href="{{url('categories/edit', $category->id) }}" class="btn btn-sm btn-dark">Edit</a></td>

                        <td>
                            <form action="/categories/{{ $category->id }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
