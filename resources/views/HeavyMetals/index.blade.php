@extends('layouts.base')

@section('content')
    <div class="content-wrapper" id="appMetals">
        <section class="content">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-10">
                            <h5 class="mb-0">Seguimiento de Personas Expuestas a Metales Pesados, Metaloides y Otras Sustancias Químicas</span></h5>
                        </div>
                        <div class="col-sm-2">
                            <ol class="breadcrumb float-sm-right font-14">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Inicio</a></li>
                                <li class="breadcrumb-item active">Reportes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-7">
                            {{-- {{ auth()->user() }} --}}
                            <div class="card card-primary">
                                <div class="card-header pl-3 pr-3 pt-2 pb-1">
                                    <h3 class="card-title font-16">Lista de Filtros</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                                                <label for="customRadio1" class="custom-control-label font-14 font-weight-normal" @click="selectXred">Relación de Pacientes</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio">
                                                <label for="customRadio2" class="custom-control-label font-14 font-weight-normal" @click="selectXpatient">Búsqueda Paciente</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio3" name="customRadio">
                                                <label for="customRadio3" class="custom-control-label font-14 font-weight-normal" @click="selectXcategory">Categoria</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio4" name="customRadio">
                                                <label for="customRadio4" class="custom-control-label font-14 font-weight-normal" @click="selectXAtenInt">Atención Integral</label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio5" name="customRadio">
                                                <label for="customRadio5" class="custom-control-label font-14 font-weight-normal" @click="">Atención por Telemedicina</label>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FORMULARIO PARA FILTROS -->
                        <div class="col-md-5">
                            <div class="card card-info border border-info" v-show="Xred">
                                <div class="card-header pl-3 pr-3 pt-2 pb-1">
                                    <h3 class="card-title font-15">Filtro por Red</h3>
                                </div>
                                
                                <form method="post" id="formulario" @submit.prevent="listMetals">
                                    <div class="card-body pt-2 pb-2">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="red" name="red" id="red" @change="filtersDistricts" v-select2>
                                                                <option value="">Seleccione Provincia</option>
                                                                <option v-for="format in listProvinces" :value="format.Provincia">[[ format.Provincia ]]</option>
                                                                {{-- @if ($person->province_name == "TODOS")
                                                                @else
                                                                    <option v-for="format in listProvinces" v-if="format.Provincia == '{{ $person->province_name }}'" :value="format.Provincia">[[ format.Provincia ]]</option>
                                                                @endif --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="distrito" name="distrito" id="distrito" v-select2>
                                                                <option value="">Seleccione Distrito</option>
                                                                <option v-for="format in listDistricts" :value="format.Distrito">[[ format.Distrito ]]</option>
                                                                {{-- @if ($person->district_name == "TODOS")
                                                                @else
                                                                    <option v-for="format in listDistricts" v-if="format.Distrito == '{{ $person->district_name }}'" :value="format.Distrito">[[ format.Distrito ]]</option>
                                                                @endif --}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="anioXdep" id="anioXdep" name="anioXdep" v-select2>
                                                                <option value="">Seleccione año</option>
                                                                <option value="2022">2022</option>
                                                                <option value="2023">2023</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="typeXdep" id="typeXdep" name="typeXdep" v-select2>
                                                                <option value="">Seleccione Tipo</option>
                                                                <option value="METALES">ESTRATEGIA METALES</option>
                                                                <option value="NO_METALES">OTRAS ESTRATEGIAS</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 p-0 text-center">
                                                <button class="btn btn-info btn-sm m-1 font-11" id="search" type="button" @click="listMetals"> Buscar</button>
                                                <button class="btn btn-outline-secondary btn-sm m-1 font-11" type="button" @click="clearRed"> Limpiar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                {{-- @endforeach --}}
                            </div>
                            <div class="card card-info border border-info" v-show="XPatient">
                                <div class="card-header pl-3 pr-3 pt-2 pb-1 text-center">
                                    <h3 class="card-title font-15">Filtro Paciente</h3>
                                </div>
                                <form method="POST" id="formulario2" @submit.prevent="listMetalsDni">
                                    <div class="card-body p-2">
                                        <input class="form-control form-control-sm" type="text" name="typeXdoc" id="typeXdoc" v-model='typeXdoc' hidden>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="form-control form-control-sm" type="text" name="doc" id="doc" v-model='doc' placeholder="Ingrese su dni..." maxlength="8">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <select class="form-control select2 show-tick" style="width: 100%;" v-model="anioXdoc" name="anioXdoc" v-select2>
                                                        <option value="">Seleccione año</option>
                                                        <option value="2022">2022</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pt-1 text-center">
                                            <button class="btn btn-info btn-sm m-1 font-11" id="search" type="submit"><i class="fa fa-search"></i> Buscar</button>
                                            <button class="btn btn-outline-secondary btn-sm m-1 font-11" type="button" @click="clearDocumento"><i class="fa fa-broom"></i> Limpiar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card card-info border border-info" v-show="XCategory">
                                <div class="card-header pl-3 pr-3 pt-2 pb-1 text-center">
                                    <h3 class="card-title font-15">Filtro Por Categoria</h3>
                                </div>
                                <form method="POST" id="formulario3">
                                    <div class="card-body p-2">
                                        <div class="col-md-12">
                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="category" id="category" name="category" v-select2>
                                                <option value="C-I">C-I</option>
                                                <option value="C-II">C-II</option>
                                                <option value="C-III">C-III</option>
                                                <option value="C-IV">C-IV</option>
                                                <option value="TODOS">TODOS</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 pt-1 text-center">
                                            <button class="btn btn-info btn-sm m-1 font-11" id="search" type="button" @click="listMetalsCategory"><i class="fa fa-search"></i> Buscar</button>
                                            <button class="btn btn-outline-secondary btn-sm m-1 font-11" type="button" @click="clearCategory"><i class="fa fa-broom"></i> Limpiar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card card-info border border-info" v-show="XAtenInt">
                                <div class="card-header pl-3 pr-3 pt-2 pb-1">
                                    <h3 class="card-title font-15">Filtro por Atenciones Integrales</h3>
                                </div>
                                <form method="POST" id="formulario4">
                                    <div class="card-body pt-2 pb-2">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="red1" name="red1" id="red1" @change="filtersDistricts1" v-select2>
                                                                <option value="">Seleccione Red</option>
                                                                <option v-for="format in listProvinces1" :value="format.Provincia">[[ format.Provincia ]]</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="distrito1" name="distrito1" id="distrito1" v-select2>
                                                                <option value="">Seleccione Distrito</option>
                                                                <option v-for="format in listDistricts1" :value="format.Distrito">[[ format.Distrito ]]</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-2">
                                                            <select class="form-control select2 show-tick" style="width: 100%;" v-model="anio1" id="anio1" name="anio1" v-select2>
                                                                <option value="">Seleccione año</option>
                                                                <option value="2022">2022</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 p-0 text-center">
                                                <button class="btn btn-info btn-sm m-1 font-11" id="search" type="button" @click="listMetalsAtenInt"> Buscar</button>
                                                <button class="btn btn-outline-secondary btn-sm m-1 font-11" type="button" @click="clearRed"> Limpiar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- TABLA PARA LISTADO DE PACIENTES --}}
                    <div class="col-md-12" v-show='table'>
                        <button type="submit" id="export" value="" name="export" class="btn btn-outline-success m-1 mb-2 font-13" @click="PrintNominal"><i class="fa fa-print"></i> Descargar Historial</button>
                        <button v-show="Xred" type="submit" id="export" value="" name="export" class="btn btn-outline-success m-1 mb-2 font-13" @click="PrintNominalAll"><i class="fa fa-print"></i> Descargar Todo</button>
                    </div>
                    <div class="col-md-12 col-sm-12" v-show='table'>
                        <div class="table-responsive nominalTable" id="cred">
                            <table id="demo-foo-addrow2" class="table table-hover table-striped" data-page-size="20" data-limit-navigation="10">
                                <thead>
                                    <tr class="font-10 text-center" style="background: #e0eff5;">
                                        <th class="align-middle">#</th>
                                        <th class="align-middle">Provincia Atendido</th>
                                        <th class="align-middle">Distrito Atendido</th>
                                        <th class="align-middle">Establecimiento Atendido</th>
                                        <th class="align-middle">Tipo Documento</th>
                                        <th class="align-middle">Documento</th>
                                        <th class="align-middle">Apellidos y Nombres</th>
                                        <th class="align-middle">Etnia</th>
                                        <th class="align-middle">Lengua Materna</th>
                                        <th class="align-middle">Fecha Nacido</th>
                                        <th class="align-middle">Edad</th>
                                        <th class="align-middle">Historia Clínica</th>
                                        <th class="align-middle" id="fields_cred">Tipo Doc Apoderado</th>
                                        <th class="align-middle" id="fields_cred">Documento Apoderado</th>
                                        <th class="align-middle" id="fields_cred">Nombres Apoderado</th>
                                        <th class="align-middle" id="fields_cred">Celular Apoderado</th>
                                        <th class="align-middle">Tipo Caso</th>
                                        <th class="align-middle">Fecha Ingreso Padrón</th>
                                        <th class="align-middle">Pseudónimo Código</th>
                                        <th class="align-middle">Teléfono</th>
                                        <th class="align-middle" id="fields_cred1">Región Actual</th>
                                        <th class="align-middle" id="fields_cred1">Provinia Actual</th>
                                        <th class="align-middle" id="fields_cred1">Distrito Actual</th>
                                        <th class="align-middle" id="fields_cred1">Dirección Actual</th>
                                        <th class="align-middle">Tipo Seguro</th>
                                        <th class="align-middle" id="fields_cred2">Categoria</th>
                                    </tr>
                                </thead>
                                <div class="float-right col-md-3">
                                    <div class="mb-2">
                                        <div class="input-wrapper input-group-sm">
                                            <input id="demo-input-search2" class="form-control input" type="search" placeholder="Buscar por nombres o dni..." style="padding-left: 25px;">
                                            <i class="fa fa-search input-icon font-13"></i>
                                        </div>
                                    </div>
                                </div>
                                <tbody>
                                    <tr v-for="(format, key) in lists" class="font-9">
                                        <td class="align-middle text-center">[[ key+1 ]]</td>
                                        <td class="align-middle text-center">[[ format.province_register ]]</td>
                                        <td class="align-middle text-center">[[ format.district_register ]]</td>
                                        <td class="align-middle text-center">[[ format.establishment_register ]]</td>
                                        <td class="align-middle text-center">[[ format.document_type ]]</td>
                                        <td class="align-middle text-center">[[ format.document ]]</td>
                                        <td class="align-middle" style="cursor: pointer;" @click="infPatient(format)">[[ format.names ]]</td>
                                        <td class="align-middle text-center">[[ format.ethnicity ]]</td>
                                        <td class="align-middle text-center">[[ format.mother_tongue ]]</td>
                                        <td class="align-middle text-center">[[ format.birth_date ]]</td>
                                        <td class="align-middle text-center">[[ format.age ]]</td>
                                        <td class="align-middle text-center">[[ format.clinic_history ]]</td>
                                        <td class="align-middle text-center">[[ format.document_type_authorized ]]</td>
                                        <td class="align-middle text-center">[[ format.document_authorized ]]</td>
                                        <td class="align-middle text-center">[[ format.names_authorized ]]</td>
                                        <td class="align-middle text-center">[[ format.cellphone_authorized ]]</td>
                                        <td class="align-middle text-center">[[ format.case_type ]]</td>
                                        <td class="align-middle text-center">[[ format.pn_registration_date ]]</td>
                                        <td class="align-middle text-center">[[ format.pseudonym_code ]]</td>
                                        <td class="align-middle text-center">[[ format.cellphone ]]</td>
                                        <td class="align-middle text-center">[[ format.region_current ]]</td>
                                        <td class="align-middle text-center">[[ format.province_current ]]</td>
                                        <td class="align-middle text-center">[[ format.district_current ]]</td>
                                        <td class="align-middle text-center">[[ format.direction_current ]]</td>
                                        <td class="align-middle text-center">[[ format.sure_type ]]</td>
                                        <td class="align-middle text-center">[[ format.category ]]</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="30">
                                            <div class="">
                                                <ul class="pagination"></ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{-- TABLA PARA LISTADO DE ATENCIONES INTEGRALES --}}
                    <div class="col-md-12" v-show='tableResum'>
                        <button type="submit" id="export" value="" name="export" class="btn btn-outline-success m-1 mb-2 font-13" @click="printAtentionsIntg"><i class="fa fa-print"></i> Descargar Conteo</button>
                    </div>
                    <div class="col-md-12 col-sm-12" v-show=tableResum>
                        <div class="table-responsive nominalTable" id="cred">
                            <table id="demo-foo-addrow2" class="table table-hover table-striped" data-page-size="20" data-limit-navigation="10">
                                <thead>
                                    <tr class="font-10 text-center" style="background: #e0eff5;">
                                        <th class="align-middle">#</th>
                                        <th class="align-middle">Región</th>
                                        <th class="align-middle">Provinia</th>
                                        <th class="align-middle">Distrito</th>
                                        <th class="align-middle">Mes</th>
                                        <th class="align-middle" id="fields_cred2">Medicina</th>
                                        <th class="align-middle" id="fields_cred3">Enfermería</th>
                                        <th class="align-middle" id="fields_cred4">Obstetricia</th>
                                        <th class="align-middle" id="fields_cred5">Psicología</th>
                                        <th class="align-middle" id="fields_cred6">Cred</th>
                                        <th class="align-middle" id="fields_cred7">Odontología</th>
                                        <th class="align-middle" id="fields_cred8">Telemonitoreo</th>
                                        <th class="align-middle" id="fields_cred9">Vacuna</th>
                                    </tr>
                                </thead>
                                <div class="float-right col-md-3">
                                    <div class="mb-2">
                                        <div class="input-wrapper input-group-sm">
                                            <input id="demo-input-search2" class="form-control input" type="search" placeholder="Buscar por nombres o dni..." style="padding-left: 25px;">
                                            <i class="fa fa-search input-icon font-13"></i>
                                        </div>
                                    </div>
                                </div>
                                <tbody>
                                    <tr v-for="(format, key) in listsResum" class="font-11">
                                        <td class="align-middle text-center">[[ key+1 ]]</td>
                                        <td class="align-middle text-center">[[ format.region_current ]]</td>
                                        <td class="align-middle text-center">[[ format.province_current ]]</td>
                                        <td class="align-middle text-center">[[ format.district_current ]]</td>
                                        <td class="align-middle text-center">[[ format.month_a ]]</td>
                                        <td class="align-middle text-center">[[ format.MEDICINE ]]</td>
                                        <td class="align-middle text-center">[[ format.NURSE ]]</td>
                                        <td class="align-middle text-center">[[ format.OBSTE ]]</td>
                                        <td class="align-middle text-center">[[ format.PSYCOLOGY ]]</td>
                                        <td class="align-middle text-center">[[ format.CRED ]]</td>
                                        <td class="align-middle text-center">[[ format.ODONTOLOGY ]]</td>
                                        <td class="align-middle text-center">[[ format.TELEMEDICINE ]]</td>
                                        <td class="align-middle text-center">[[ format.VACUNA ]]</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="30">
                                            <div class="">
                                                <ul class="pagination"></ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <div class="modal fade" id="ModalInformacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-info" id="dta_user"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 text-center">
                            <p class="msmAttentions"></p>
                        </div>
                        <div class="row" id="attentionsTabs">
                            <div class="col-3 col-sm-2">
                                <div class="nav flex-column nav-tabs h-100 font-14" id="attentionsTabs" role="tablist" aria-orientation="vertical">
                                    <template v-for="(format, key) in listsAttentions">
                                        <a v-if="format.month_a == 1" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-alt"></i> Enero</a>
                                        <a v-if="format.month_a == 2" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-check"></i> Febrero</a>
                                        <a v-if="format.month_a == 3" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-alt"></i> Marzo</a>
                                        <a v-if="format.month_a == 4" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-check"></i> Abril</a>
                                        <a v-if="format.month_a == 5" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-alt"></i> Mayo</a>
                                        <a v-if="format.month_a == 6" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-check"></i> Junio</a>
                                        <a v-if="format.month_a == 7" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-alt"></i> Julio</a>
                                        <a v-if="format.month_a == 8" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-check"></i> Agosto</a>
                                        <a v-if="format.month_a == 9" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-alt"></i> Setiembre</a>
                                        <a v-if="format.month_a == 10" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-check"></i> Octubre</a>
                                        <a v-if="format.month_a == 11" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-alt"></i> Noviembre</a>
                                        <a v-if="format.month_a == 12" class="nav-link" :id="'mes'+format.month_a+'-tab'" data-toggle="pill" :href="'#mes'+format.month_a" role="tab"><i class="fa fa-calendar-check"></i> Diciembre</a>
                                    </template>
                                </div>
                            </div>
                            <div class="col-9 col-sm-10">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <template v-for="(format, key) in listsAttentions">
                                    <div class="tab-pane text-left fade" :id="'mes'+format.month_a" role="tabpanel" :aria-labelledby="'mes'+format.month_a+'-tab'">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Solicito Médico: </label> <p class="pl-2 font-13">[[ format.solicitude_medic ]]</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Tuvo Referencia: </label> <p class="pl-2 font-13">[[ format.reference ]]</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6" v-if="format.reference == 'SI'">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary col-md-5">Lugar Referencia: </label> <p class="pl-2 font-13">[[ format.reference_place ]]</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Tuvo Contrareferencia: </label> <p class="pl-2 font-13">[[ format.against_reference ]]</p>
                                                </div>
                                            </div>
                                            <div class="col-md-8" v-if="format.against_reference == 'SI'">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Lugar Contrareferencia: </label> <p class="pl-2 font-13">[[ format.against_reference_place ]]</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class="text-center font-13 bg-purple">
                                                        <th class="align-middle">Medicina</th>
                                                        <th class="align-middle">Enfermería</th>
                                                        <th class="align-middle">Obstetricia</th>
                                                        <th class="align-middle">Psicología</th>
                                                        <th class="align-middle">Odontología</th>
                                                        <th class="align-middle">Cred</th>
                                                        <th class="align-middle">Telemonitoreo</th>
                                                        <th class="align-middle">Vacuna</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-13 text-center">
                                                        <td class="align-middle">[[ format.medicine_attention ]]</td>
                                                        <td class="align-middle">[[ format.nursing_attention ]]</td>
                                                        <td class="align-middle">[[ format.obstetrics_attention ]]</td>
                                                        <td class="align-middle">[[ format.psychology_attention ]]</td>
                                                        <td class="align-middle">[[ format.odontology_attention ]]</td>
                                                        <td class="align-middle">[[ format.cred_attention ]]</td>
                                                        <td class="align-middle">[[ format.telemedicine_attention ]]</td>
                                                        <td class="align-middle">[[ format.vaccine_attention ]]</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class="text-center font-13 bg-pink">
                                                        <th class="align-middle">Hemoglobina</th>
                                                        <th class="align-middle">Orina</th>
                                                        <th class="align-middle">Perfil Hepático</th>
                                                        <th class="align-middle">Hematocrito</th>
                                                        <th class="align-middle">Perfil Lipídico</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-13 text-center">
                                                        <td class="align-middle">[[ format.hemoglobin ]]</td>
                                                        <td class="align-middle">[[ format.urine ]]</td>
                                                        <td class="align-middle">[[ format.liver_profile ]]</td>
                                                        <td class="align-middle">[[ format.hematocrit ]]</td>
                                                        <td class="align-middle">[[ format.lipidic_profile ]]</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Atención Integral: </label> <p class="pl-2 font-13">[[ format.integral_attention ]]</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Aten. Especializada: </label> <p class="pl-2 font-13">[[ format.specialized_attention ]]</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6" v-if="format.specialized_attention == 'SI'">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Detalle Atención: </label> <p class="pl-2 font-13">[[ format.specialized_attention_detail ]]</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group d-flex mb-2">
                                                    <label class="font-13 text-secondary">Aten. Telemedicina: </label> <p class="pl-2 font-13">[[ format.telemedicine ]]</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class="text-center font-13 bg-navy">
                                                        <th class="align-middle">Pb (µg/dl)</th>
                                                        <th class="align-middle">As (µg/g creatinina)</th>
                                                        <th class="align-middle">Cd (µg/g creatinina)</th>
                                                        <th class="align-middle">Hg (µg/g creatinina)</th>
                                                        <th class="align-middle">Otro</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-13 text-center">
                                                        <td class="align-middle">[[ format.pb_attention ]]</td>
                                                        <td class="align-middle">[[ format.as_attention ]]</td>
                                                        <td class="align-middle">[[ format.cd_attention ]]</td>
                                                        <td class="align-middle">[[ format.hg_attention ]]</td>
                                                        <td class="align-middle">[[ format.other_attention ]]</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive ">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class="text-center font-13 bg-navy">
                                                        <th class="align-middle">Establecimiento</th>
                                                        <th class="align-middle">Servicio</th>
                                                        <th class="align-middle">Fecha</th>
                                                        <th class="align-middle">Resultados</th>
                                                        <th class="align-middle">Observaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="font-13 text-center">
                                                        <td class="align-middle">[[ format.ipress_attention ]]</td>
                                                        <td class="align-middle">[[ format.service_attention ]]</td>
                                                        <td class="align-middle">[[ format.date_attention ]]</td>
                                                        <td class="align-middle">[[ format.results_attention ]]</td>
                                                        <td class="align-middle">[[ format.observations_attention ]]</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/metals.js"></script>
@endsection

@section('scripts')
@endsection