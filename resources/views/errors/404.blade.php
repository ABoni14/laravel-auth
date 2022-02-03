@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pagina non trovata - 404 Error</h2>
    <p>{{$exception->getMessage()}}</p>
</div>
@endsection