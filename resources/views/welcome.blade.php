@extends('layouts.app')

@section('title', __('Welcome'))

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-90">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center display-6"><span class="fa fa-home"></span> @yield('title')</h1>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center rounded">
                                <img src="{{ asset('imagen/imagen.jpg') }}" alt="Imagen" class="img-fluid">
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <h3 class="font-weight-bold text-center">
                                    @guest
                                        Gestione sus actividades !!! <br>
                                        Explore características y funcionalidades interesantes. Puede registrarse para comenzar o haga clic en "Login" para acceder a su Panel de control.
                                    @else
                                        Hi {{ Auth::user()->name }}, Welcome back to {{ config('app.name', 'Laravel') }}.
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
