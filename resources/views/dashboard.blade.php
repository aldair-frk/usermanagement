@extends('layouts.base')

@section('content')
    <div class="content-wrapper" id="appDash">
        <section class="content">
            <div class="container-fluid">
                <div class="page-wrapper"><br>
                    <div class="col-md-12 text-center">
                        <h2 class="title_fed pb-3">Avance Metales Pesados, Metaloides y Otras Sustancias</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="small-box text-white" style="background: linear-gradient(to right, #e7488a, #9e3183);">
                                <div class="inner">
                                  <h3>[[ totalPatients ]]</h3>
                                  <p class="m-0">Cantidad de Registros</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-stats-bars text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box text-white" style="background: linear-gradient(to right, #8f6dc4, #5b46b7);">
                                <div class="inner">
                                    <h3>[[ exposed ]]</h3>
                                    <p class="m-0">Expuestos</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box text-white" style="background: linear-gradient(to right, #4accf8, #6093e1);">
                                <div class="inner">
                                    <h3>[[ affected ]]</h3>
                                    <p class="m-0">Afectados</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box text-white" style="background: linear-gradient(to right, #ffb52d, #f67f5f);">
                                <div class="inner">
                                    <h3>[[ young ]]</h3>
                                    <p class="m-0">Menores de Edad</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i> Categoría
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                  <div id="chartCategory" style="height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-line"></i> Grupo de Edad
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                  <div id="chartAge" style="height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Donut chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-pie"></i> Género
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chartGender" style="height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="./js/dashboard/vue/dashboard.js"></script>
    <script src="./js/dashboard/js/dashboard.js"></script>
    <script src="plugins/flot/jquery.flot.js"></script>
@endsection