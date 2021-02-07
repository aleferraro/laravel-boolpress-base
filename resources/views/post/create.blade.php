@extends('layouts.main')

@section('title', 'New Post')

@section('main')

    <main>
        <div class="container">
            <form method="POST" action="{{ route('post.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titolo">
                </div>
                <div class="form-group">
                    <label for="author">Autore</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Autore">
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select class="form-control" id="category" name="category">
                        <option>---</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="tags" name="tags[]">
                            <label class="form-check-label" for="tags">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Salva Post</button>
            </form>
        </div>
    </main>

@endsection