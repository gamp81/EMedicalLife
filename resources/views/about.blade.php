
@extends('layouts.app')
@section('content')

    <section class="bg-success">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-4 text-white">
                    <h1>Nuestra Empresa</h1>
                    <p>
                        Nace de la demanda en la provincia de personal capacitado en el area de la Ingenieria Médica.</p>
                    <p>Nuestro objetivo es proporcionar productos de alta calidad, excelente servicio al cliente e inmediato soporte técnico.
                    </p>
                </div>
                <div class="col-md-8">
                    <img src="assets/img/4.jpg" alt="About Hero">
                </div>
            </div>
        </div>
    </section>
    <!-- Close Banner -->
@include('services')    
@include('brand')
    

    
@endsection