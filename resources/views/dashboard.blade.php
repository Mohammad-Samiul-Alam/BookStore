@extends('layouts.dash_board')
@section('content')
    <!-- Search and New Book -->
    <form method="GET" action="{{ route('dashboard') }}">
    <div class="row mb-3 mt-3">
            <div class="col-12 col-md-8">
                    <input type="text" name="title" class="form-control" placeholder="Search Book Title">
            </div>
            <div class="col-6 col-md-2">
                <button class="btn btn-primary w-100" type="submit">Search</button>
            </div>
        
            <div class="col-6 col-md-2">
                <a href="{{ route('book.add') }}" class="btn btn-success w-100">New Book</a>
            </div>
            
            {{-- <input type="text" name="title" placeholder="Search by title">
            <input type="text" name="author" placeholder="Search by author">
            <button type="submit">Search</button> --}}
            
        </div>
        </form>
    <div style="overflow-x: auto; max-width: 100%;">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Stock</th>
                    <th>Price (TK)</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $sl => $book)
                    <tr>
                        <td>{{ $books->firstItem() + $sl }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->price }}</td>
                        <td class="text-center">
                            <a href="{{ route('book.info', $book->id) }}"
                                class="btn btn-info btn-sm text-white btn-custom">Details</a>
                            <a href="{{ route('book.edit', $book->id) }}"
                                class="btn btn-warning btn-sm text-white btn-custom">Update</a>
                            <a href="{{ route('book.delete', $book->id) }}"
                                class="btn btn-danger btn-sm text-white btn-custom">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $books->links() }}
@endsection