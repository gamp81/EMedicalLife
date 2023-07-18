@extends('layouts.app')
@section('content')
<div class="container-fluid">
   
    @if (Session::has ('message'))
        <p class="alert alert-success">{{Session::get('message')}}</p>
        @endif
    <tabla-categoria-component baseurl="{{ route('cliente.index') }}"></tabla-categoria-component> 
</div>
@endsection