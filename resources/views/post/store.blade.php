@extends('layouts.main')

@section('title', 'Post Creato')

@section('main')
    <main>
        <div class="container">
            <h1>Post creato con successo</h1>
            <a href="{{ route('post.index') }}"> Ritorna alla home </a>
        </div>
    </main>
@endsection