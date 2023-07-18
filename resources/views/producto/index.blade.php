@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Productos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                
                {{-- <a id="xlsbtn" class="btn btn-sm btn-outline-secondary" href="" role="button" target="_self"><i class="fas fa-file-excel"></i>&nbsp;Exportar</a> --}}
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('producto.create') }}" role="button"><i class="far fa-plus-square"></i>&nbsp;Nuevo</a>
                
            </div>
        </div>
    </div>
    @if (Session::has ('message'))
    <p class="alert alert-success">{{Session::get('message')}}</p>
    @endif
    <tabla-producto-component text="{{ route('producto.index') }}" :idrole="{{$role}}"></tabla-producto-component> 
</div>
@endsection
    

