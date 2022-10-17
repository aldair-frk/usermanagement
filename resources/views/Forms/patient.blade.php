<form method="POST" id="formulario" @submit.prevent="sendFormUser">
    @csrf
    <input type="text" name="id" v-model="form.id" v-if="form.id" hidden>
    <div class="card">
        <div class="card-header bg-gray pb-2">
            <h3 class="card-title">Datos del Paciente</h3>
            <div class="card-tools mt-0">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>   
        <div class="card-body pt-2 pb-2">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Tipo Doc <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="document_type" id="document_type" v-model="document_type" v-select2 :disabled="disabled2" required>
                            <option value="DNI">DNI</option>
                            <option value="CE">Carnet Extranjeria</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Documento <span class="text-danger">(*)</span></label>
                        <div class="d-flex">
                            <input type="text" class="form-control form-control-sm" name="document" id="document" v-model="document" maxlength="12" @keyup.enter="listPatient" required>
                            <button class="btn btn-sm btn-primary btnSearch" @click="listPatient"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-13">Apellidos y Nombres <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control form-control-sm textUpper" name="names" id="names" v-model="form.names" readonly required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Sexo <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="gender" id="gender" v-model="form.gender" :disabled="disabled" required>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Etnia <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="ethnicity" id="ethnicity" v-model="form.ethnicity" required>
                            <option value="AYMARA">AYMARA</option>
                            <option value="ASIATICO">ASIATICO</option>
                            <option value="BLANCO">BLANCO</option>
                            <option value="DE COLOR">DE COLOR</option>
                            <option value="MESTIZO">MESTIZO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Lengua Materna <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="mother_tongue" id="mother_tongue" v-model="form.mother_tongue" required>
                            <option value="ESPAÑOL">ESPAÑOL</option>
                            <option value="INGLES">INGLES</option>
                            <option value="QUECHUA">QUECHUA</option>
                            <option value="AYMARA">AYMARA</option>
                            <option value="OTROS">OTROS</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Fecha Nacimiento <span class="text-danger">(*)</span></label>
                        <input type="date" class="form-control form-control-sm" name="birth_date" id="birth_date" v-model="form.birth_date" readonly required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="font-13">Edad <span class="text-danger">(*)</span></label>
                        <input type="number" class="form-control form-control-sm" name="age" id="age" v-model="form.age" readonly required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="font-13">Menor Edad <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="younger" id="younger" v-model="form.younger" :disabled="disabled" required>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Región Nacido <span class="text-danger">(*)</span></label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="region_before" id="region_before" v-model="form.region_before" @change="filtersProvinces3" v-select2 required :disabled="disabled">
                            <option v-for="format in listDepartment" :value="format.Departamento">[[ format.Departamento ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Provincia Nacido <span class="text-danger">(*)</span></label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="province_before" id="province_before" v-model="form.province_before" @change="filtersDistricts3" v-select2 required :disabled="disabled">
                            <option v-for="format in listProvinces3" :value="format.Provincia">[[ format.Provincia ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Distrito Nacido<span class="text-danger">(*)</span></label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="district_before" id="district_before" v-model="form.district_before" required v-select2 :disabled="disabled">
                            <option v-for="format in listDistricts3" :value="format.Distrito">[[ format.Distrito ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="font-13">Dirección Nacido</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="direction_before" id="direction_before" v-model="form.direction_before" readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Celular</label>
                        <input type="text" class="form-control form-control-sm" name="cellphone" id="cellphone" v-model="form.cellphone" maxlength="9">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Historia Clínica <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control form-control-sm textUpper" name="clinic_history" id="clinic_history" v-model="form.clinic_history" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Fecha Ingreso Padrón <span class="text-danger">(*)</span></label>
                        <input type="date" class="form-control form-control-sm" name="pn_registration_date" id="pn_registration_date" v-model="form.pn_registration_date" required readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Tipo Caso <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="case_type" id="case_type" v-model="form.case_type" @click="changeCategory" :disabled="disabled2" required>
                            <option value="EXPUESTO">EXPUESTO</option>
                            <option value="AFECTADO">AFECTADO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Pseudónimo/Código</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="pseudonym_code" id="pseudonym_code" v-model="form.pseudonym_code">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Tipo Seguro <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="sure_type" id="sure_type" v-model="form.sure_type" :disabled="disabled2" required>
                            <option value="SIS">SIS</option>
                            <option value="ESSALUD">ESSALUD</option>
                            <option value="SALUDPOL">SALUDPOL</option>
                            <option value="OTRO">OTRO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2" v-show="viewCategory">
                    <div class="form-group">
                        <label class="font-13">Categoria <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="category" id="category" v-model="form.category" :disabled="disabled2">
                            <option value="C-I">C-I</option>
                            <option value="C-II">C-II</option>
                            <option value="C-III">C-III</option>
                            <option value="C-IV">C-IV</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="font-13">Estado <span class="text-danger">(*)</span></label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="state" id="state" v-model="form.state" required>
                            <option value="A">ACTIVO</option>
                            <option value="I">INACTIVO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-13">Región <span class="text-danger">(*)</span><span class="text-primary">(**)</span></label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="region_register" id="region_register" v-model="form.region_register" @change="filtersProvinces" v-select2 required>
                            <option v-for="format in listDepartment" :value="format.Departamento">[[ format.Departamento ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-13">Provincia <span class="text-danger">(*)</span><span class="text-primary">(**)</span></label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="province_register" id="province_register" v-model="form.province_register" @change="filtersDistricts" v-select2 required>
                            <option v-for="format in listProvinces" :value="format.Provincia">[[ format.Provincia ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-13">Distrito <span class="text-danger">(*)</span><span class="text-primary">(**)</span></label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="district_register" id="district_register" v-model="form.district_register" @change="filtersEstablishments" v-select2 required>
                            <option v-for="format in listDistricts" :value="format.Distrito">[[ format.Distrito ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="font-13">Establecimiento <span class="text-danger">(*)</span><span class="text-primary">(**)</span></label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="establishment_register" id="establishment_register" v-model="form.establishment_register" v-select2 required>
                            <option v-for="format in listEstablishments" :value="format.Nombre_Establecimiento">[[ format.Nombre_Establecimiento ]]</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-gray pb-2">
                    <h3 class="card-title">Residencia Actual</h3>
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
                                <label class="font-13">Región <span class="text-danger">(*)</span></label>
                                <select class="form-control select2 show-tick" style="width: 100%;" name="region_current" id="region_current" v-model="form.region_current" @change="filtersProvinces2" v-select2 required>
                                    <option v-for="format in listDepartment" :value="format.Departamento">[[ format.Departamento ]]</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-13">Provincia <span class="text-danger">(*)</span></label>
                                <select class="form-control select2 show-tick" style="width: 100%;" name="province_current" id="province_current" v-model="form.province_current" @change="filtersDistricts2" v-select2 required>
                                    <option v-for="format in listProvinces2" :value="format.Provincia">[[ format.Provincia ]]</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-13">Distrito <span class="text-danger">(*)</span></label>
                                <select class="form-control select2 show-tick" style="width: 100%;" name="district_current" id="district_current" v-model="form.district_current" v-select2 required>
                                    <option v-for="format in listDistricts2" :value="format.Distrito">[[ format.Distrito ]]</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-13">Dirección <span class="text-danger">(*)</span></label>
                                <input type="text" class="form-control form-control-sm textUpper" name="direction_current" v-model="form.direction_current" maxlength="150" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-gray pb-2">
                    <h3 class="card-title">Datos del Apoderado</h3>
                    <div class="card-tools mt-0">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body pt-2 pb-2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-13">Tipo Documento</label>
                                <select class="custom-select custom-select-sm" style="width: 100%;" name="document_type_authorized" v-model="form.document_type_authorized">
                                    <option value="DNI">DNI</option>
                                    <option value="CE">CARNET DE EXTRANJERÍA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-13">Documento</label>
                                <input type="text" class="form-control form-control-sm textUpper" name="document_authorized" v-model="form.document_authorized" maxlength="12">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-13">Apellidos y Nombres</label>
                                <input type="text" class="form-control form-control-sm textUpper" name="names_authorized" v-model="form.names_authorized" maxlength="150">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="font-13">Celular</label>
                                <input type="text" class="form-control form-control-sm" name="cellphone_authorized" id="cellphone_authorized" v-model="form.cellphone_authorized" maxlength="9">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-danger btn-sm m-1 font-14" @click="close" type="button"><i class="fa fa-times"></i> Cancelar</button>
        <button class="btn btn-success btn-sm m-1 font-14" id="search" type="submit"><i class="fa fa-save"></i> Guardar</button>
        {{-- <button class="btn btn-dark btn-sm m-1 font-14" type="button" id="clear2" @click="finallyForm"><i class="fa fa-times"></i> Terminar</button> --}}
    </div>
</form>
<div>
    <label for="">
        <span class="text-danger font-11">(*): Campos Obligatorios.</span><br>
        <span class="text-primary font-11">(**): Lugar de Atención.</span>
    </label>
</div>
