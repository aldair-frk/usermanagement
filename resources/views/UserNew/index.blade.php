@extends('layouts.base')

@section('content')
    <div class="content-wrapper" id="appNewUser">
        <section class="content">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-9">
                            <h5 class="mb-0">Crear Paciente</span></h5>
                        </div>
                        <div class="col-sm-3">
                            <ol class="breadcrumb float-sm-right font-14">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">Nuevo Paciente</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    @include('Forms.patient')
                </div>
            </section>
        </section>
    </div>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="./js/addPatient/vue/userNew.js"></script>
    <script src="./js/addPatient/js/userNew.js"></script>
@endsection

@section('javascript')
@endsection