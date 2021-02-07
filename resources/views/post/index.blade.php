@extends('layouts.main')

@section('title', 'Home')

@section('main')
    
    <div class="container">
        <h1>Posts</h1>

        <a class="btn btn-primary" href="{{ route('post.create') }}" role="button">Nuovo Post</a>
    </div>
    
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Tags</th>
                    <th scope="col">Modifica</th>
                    <th scope="col">Elimina</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->title }}</td>
                        <td>{{ $post->postInformation->description }}</td>
                        <td>
                            @foreach ($post->tags as $tag)
                                {{ $tag->name }}
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ route('post.edit', $post->id) }}" role="button">Modifica</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('post.destroy', $post->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>

    </div>
    <div class="container">
        {{ $posts->links() }}
    </div>

@endsection