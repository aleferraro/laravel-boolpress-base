@extends('layouts.main')

@section('title', 'Home')

@section('main')
    
    <div class="container">
        <h1>Posts</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Descrizione</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->title }}</td>
                        <td>{{ $post->postInformation->description }}</td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>

@endsection