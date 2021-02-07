@extends('layouts.main')

@section('title', 'New Post')

@section('main')

    <main>
        <div class="container">
            <form method="POST" action="{{ route('post.update', $post->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titolo" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="author">Autore</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Autore" value="{{ $post->author }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ $post->postInformation->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select class="form-control" id="category" name="category">
                        <option>---</option>
                        @foreach ($categories as $category)
                            <option {{ ($post->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input 
                                class="form-check-input" type="checkbox" 
                                value="{{ $tag->id }}" 
                                id="tag{{ $tag->id}}" 
                                name="tags[]" 
                                
                                @foreach ($post->tags as $postTag)
                                    {{ ($postTag->id == $tag->id) ? 'checked' : '' }}
                                @endforeach  
                            >
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