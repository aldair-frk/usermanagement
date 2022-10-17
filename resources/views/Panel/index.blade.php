@extends('layouts.base')
@section('content')

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
              @csrf
                <div class="card card-primary">
                        <div class="card-header pl-3 pr-3 pt-2 pb-1">
                            <h3 class="card-title">Datos Nuevo Usuarios</h3>
                            <div class="card-tools mt-0">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    <div class="card-body pt-2 pb-2">
                      @if (session('success'))
                      <div class="alert alert-success" role="success">
                              <!-- {{('Usuario creado correctamente')}} -->
                              {{(session('success'))}}
                      </div>
                      @endif  
                        <!-- <div class="row">
                          <div class="col-12 text">
                            <a href="{{route('create.user')}}" class="btn btn-warning">Añadir Usuario</a>
                          </div>
                        </div> -->
                                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                          Añadir Usuario
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Añadir Usuario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            <div class="modal-body">
                            <form action="{{route('save.user')}}" method="post" class="form-horizontal"> 
                                @csrf
                                  <div class="card card-primary">                                        
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
                                          </div>
                                       </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="search" type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                  </div>
                                </div>
                              </div>
                           </form>
                        </div>

                     
                        <div class="table-responsive">
                            <table class="table" style="text-align:center;">
                                <thead class="text-primary" style>
                                    <th>ID</th>
                                    <th>ULTIMO INGRESO</th>
                                    <th>USUARIO</th>
                                    <th>PROVINCIA</th>
                                    <th>DISTRITO</th>
                                    <th class="text-right">ACCIONES</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)                                  
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->last_login}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->province_name}}</td>
                                        <td>{{$user->district_name}}</td>
                                        <td class="td-actions text-right">
                                       
                                          <a href="{{route('panel.show', $user->id)}}" class="btn btn-info"><i class="fa fa-user" aria-hidden="true"></i></a>
                                            
                                          <!--Boton para Modal Editar -->
                                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModaledit{{ $user->id }}">
                                          <i class="fa fa-cog" style="color: white;" aria-hidden="true"></i>
                                          </button>
                                            <!-- Eliminar -->
                                            <form action="{{route('delete.user', $user->id)}}" method="POST" style="display: inline-block;"> 
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger" type="submit" rel="tooltip">
                                                                  <i class="fa fa-trash"></i>
                                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                  <!-- Modal Editar -->
                                  <div class="modal fade text-left" id="exampleModaledit{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('update.user', $user->id)}}" method="post" class="form-horizontal"> 
                                                            @csrf
                                                            @method('PUT') 
                                                            <div class="card card-primary">                                        
                                                                    <div class="card-body pt-2 pb-2">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                        <label class="font-13">Usuario<span class="text-danger">(*)</span></label>
                                                                                        <input type="text" class="form-control form-control-sm textUpper" name="username" v-model="form.direction_current" maxlength="150" value="{{$user->username}}" text-transform: uppercase>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                        <label class="font-13">Contraseña<span class="text-danger">(*)</span></label>
                                                                                        <input type="password" class="form-control form-control-sm textUpper" name="password" v-model="form.direction_current" maxlength="150" placeholder="Ingrese la nueva contraseña">
                                                                                </div>
                                                                            </div>                                                 
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                        <label class="font-13">Provincia <span class="text-danger">(*)</span></label>
                                                                                        <input type="text" class="form-control form-control-sm textUpper" name="province_name" v-model="form.direction_current" maxlength="150" value="{{$user->province_name}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                        <label class="font-13">Distrito <span class="text-danger">(*)</span></label>
                                                                                        <input type="text" class="form-control form-control-sm textUpper" name="district_name" v-model="form.direction_current" maxlength="150" value="{{$user->district_name}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                        <label class="font-13">Es super<span class="text-danger">(*)</span></label>
                                                                                        <input type="text" class="form-control form-control-sm textUpper" name="is_super" v-model="form.direction_current" maxlength="150" required value="{{$user->is_super}}">
                                                                                </div>
                                                                            </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="font-13">Es admin <span class="text-danger">(*)</span></label>
                                                                                        <input type="text" class="form-control form-control-sm textUpper" name="is_admin" v-model="form.direction_current" maxlength="150" required value="{{$user->is_admin}}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                             
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                  <div class="modal-footer">
                                                                    <button id="search" type="submit" class="btn btn-primary">Guardar</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    
                                                                  </div>
                                                              </div>
                                                            </div>
                                                        </form>
                                                    </div>  
                                                </div>
                                  </div>
                                   
                                                       
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
          
          </div>
        </div>
      </div>
  </div>
</div>
</div>

@endsection


