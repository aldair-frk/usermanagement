@extends('layouts.base')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <section class="content-header pb-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-9">
                            <h5 class="mb-0">Homologación</span></h5>
                        </div>
                        <div class="col-sm-3">
                            <ol class="breadcrumb float-sm-right font-14">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">Nuevo Usuario</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div id="appHomologation">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary border border-primary">
                                    <form method="POST" id="formulario0" @submit.prevent="listPatient">
                                        <div class="card-body pt-2 pb-2">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input class="form-control form-control-sm" type="text" name="doc" id="doc" v-model='doc' placeholder="Ingrese su dni..." maxlength="8">
                                                </div>
                                                <div class="col-md-3 p-0">
                                                    <button class="btn btn-primary btn-sm m-1 font-11" id="search" type="submit"><i class="fa fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8 text-right mt-2" v-show="patient">
                                <button class="btn btn-danger btn-sm" type="button" @click="volver"><i class="fa fa-reply-all" aria-hidden="true"></i> Regresar</button>
                            </div>
                        </div>
                        <div v-show="formulary" class="formulary">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-outline-info m-3" @click="viewPatient"><img src="./img/examination.png" alt=""><br> <b class="font-18">PACIENTE</b></button>
                                <button class="btn btn-outline-warning m-3" id="metals"><img src="./img/jewelry.png" alt=""><br> <b class="font-18">ESTRATEGIA METALES PESADOS</b></button>
                                <button class="btn btn-outline-danger m-3" id="noMetals"><img src="./img/medical-mask.png" alt=""><br> <b class="font-18">OTRAS ESTRATEGIAS (NO METALES)</b></button>
                            </div>
                        </div>
                        <div class="patient" v-show="patient">
                            @include('Forms.patient')
                        </div>
                    </div>
                    <div class="hola" style="display: none;">
                        <div id="appMetals">
                            @include('Forms.attenionsMetals')
                        </div>
                    </div>
                    <div class="hola2" style="display: none;">
                        <div id="appNoMetals">
                            @include('Forms.attentionsNoMetals')
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
    <script src="./js/homologation/vue/attention.js"></script>
    <script src="./js/homologation/vue/homologation3.js"></script>
    <script src="./js/homologation/vue/patient.js"></script>
    <script src="./js/homologation/js/homologation.js"></script>
@endsection

@section('javascript')
@endsection