@extends('layouts.main')

@section('title', 'Post Modificato')

@section('main')
    <main>
        <div class="container text-center">
            <h1>Post modificato con successo</h1>
            <a href="{{ route('post.index') }}"> Ritorna alla home </a>
        </div>
    </main>
@endsection