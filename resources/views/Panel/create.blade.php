@extends('layouts.base')
@section('content')
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <form action="{{route('save.user')}}" method="post" class="form-horizontal"> 
            @csrf
                <div class="card card-primary">
                        <div class="card-header pl-3 pr-3 pt-2 pb-1">
                        <h3 class="card-title">Datos Nuevo Usuario</h3>
                        <div class="card-tools mt-0">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-2 pb-2">
                        <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-13">Usuario<span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control form-control-sm textUpper" name="username" v-model="form.direction_current" maxlength="150" required placeholder="Ingrese el usuario" text-transform: uppercase>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-13">Contraseña<span class="text-danger">(*)</span></label>
                                    <input type="password" class="form-control form-control-sm textUpper" name="password" v-model="form.direction_current" maxlength="150" required placeholder="Ingrese la contraseña">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-13">Provincia <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control form-control-sm textUpper" name="province_name" v-model="form.direction_current" maxlength="150" required placeholder="Ingrese la provincia">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-13">Distrito <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control form-control-sm textUpper" name="district_name" v-model="form.direction_current" maxlength="150" required placeholder="Ingrese el distrito">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-13">Es super<span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control form-control-sm textUpper" name="is_super" v-model="form.direction_current" maxlength="150" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-13">Es admin <span class="text-danger">(*)</span></label>
                                    <input type="text" class="form-control form-control-sm textUpper" name="is_admin" v-model="form.direction_current" maxlength="150" required>
                                </div>
                            </div>
                            </div>
                        
                        <div style="text-align: right">
                        <button class="btn btn-success btn-sm m-1 font-14" id="search" type="submit"><i class="fa fa-save"></i>Guardar</button> 
                        </div>
                    </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
