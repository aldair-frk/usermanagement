<form method="POST" id="formulario4" @submit.prevent="sendFormAttentionsNoMetals">
    @csrf
    <input type="text" v-if="formNoMetals.id" v-model="formNoMetals.id" name="id" hidden>
    {{-- <input type="text" v-if="form.id" v-model="form.id" name="patient_id" > --}}
    <input type="text" v-if="doc_nometals" v-model="doc_nometals" name="document" hidden>
    <input type="text" value="2022" name="year_a" hidden>
    <div class="card">
        <div class="card-header bg-indigo pb-2">
            <h3 class="card-title">Atenciones Por Otras Estrategias (No Metales)</h3>
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
                        <label for="exampleInputEmail1" class="font-13 text-indigo">Seleccione Año</label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="year_a" v-model="yearNoMetal" required v-select2>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-indigo">Seleccione Mes</label>
                        <select class="form-control select2 show-tick" style="width: 100%;" id="month_a" name="month_a" v-model="monthNoMetal" v-select2 @change="SelectMonthNoMetals" required>
                            <option value="1">ENERO</option>
                            <option value="2">FEBRERO</option>
                            <option value="3">MARZO</option>
                            <option value="4">ABRIL</option>
                            <option value="5">MAYO</option>
                            <option value="6">JUNIO</option>
                            <option value="7">JULIO</option>
                            <option value="8">AGOSTO</option>
                            <option value="9">SETIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13">Solicito Médico</label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="solicitude_medic" id="solicitude_medic" v-model="formNoMetals.solicitude_medic" required>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13">Tuvo Referencia</label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="reference" id="reference" v-model="formNoMetals.reference" v-select2 @click="changeReferenceNoMetals" required>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3" v-show="lugar_ref">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13">Lugar Referencia:</label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="reference_place" id="reference_place" v-model="formNoMetals.reference_place" v-select2>
                            <option v-for="format in listEstablishmentsAll" :value="format.Nombre_Establecimiento">[[ format.Nombre_Establecimiento ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13">Tuvo Contrareferencia</label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="against_reference" id="against_reference" v-model="formNoMetals.against_reference" v-select2 @click="changeAgainRefNoMetals" required>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3" v-show="lugar_ref2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13">Lugar Contrareferencia:</label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="against_reference_place" id="against_reference_place" v-model="formNoMetals.against_reference_place" v-select2>
                            <option v-for="format in listEstablishmentsAll" :value="format.Nombre_Establecimiento">[[ format.Nombre_Establecimiento ]]</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-maroon">Atención Integral</label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="integral_attention" id="integral_attention" v-model="formNoMetals.integral_attention" required>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Vacuna</label>
                        <input type="text" class="form-control form-control-sm" name="vaccine_attention" id="vaccine_attention" v-model="formNoMetals.vaccine_attention" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Medicina</label>
                        <input type="text" class="form-control form-control-sm" name="medicine_attention" id="medicine_attention" v-model="formNoMetals.medicine_attention" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Enfermeria</label>
                        <input type="text" class="form-control form-control-sm" name="nursing_attention" id="nursing_attention" v-model="formNoMetals.nursing_attention" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Obstetricia</label>
                        <input type="text" class="form-control form-control-sm" name="obstetrics_attention" id="obstetrics_attention" v-model="formNoMetals.obstetrics_attention" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Psicología</label>
                        <input type="text" class="form-control form-control-sm" name="psychology_attention" id="psychology_attention" v-model="formNoMetals.psychology_attention" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Cred</label>
                        <input type="text" class="form-control form-control-sm" name="cred_attention" id="cred_attention" v-model="formNoMetals.cred_attention" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Odontología</label>
                        <input type="text" class="form-control form-control-sm" name="odontology_attention" id="odontology_attention" v-model="formNoMetals.odontology_attention" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-purple">Telemonitoreo</label>
                        <input type="text" class="form-control form-control-sm" name="telemedicine_attention" id="telemedicine_attention" v-model="formNoMetals.telemedicine_attention" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-primary">Hemoglobina</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="hemoglobin" id="hemoglobin" v-model="formNoMetals.hemoglobin" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-primary">Orina</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="urine" id="urine" v-model="formNoMetals.urine" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-primary">Perfil Hepatico</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="liver_profile" id="liver_profile" v-model="formNoMetals.liver_profile" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-primary">Hematocrito</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="hematocrit" id="hematocrit" v-model="formNoMetals.hematocrit" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-primary">Perfil Lipidico</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="lipidic_profile" id="lipidic_profile" v-model="formNoMetals.lipidic_profile" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13">Atención Telemedicina</label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="telemedicine" id="telemedicine" v-model="formNoMetals.telemedicine">
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-secondary">Especializada</label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="specialized_attention" id="specialized_attention" v-model="formNoMetals.specialized_attention" @click="changeSpecializedNoMetals" required>
                            <option value="SI">Si</option>
                            <option value="NO">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-show="detail_specialized">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-secondary">Detalle Atención</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="specialized_attention_detail" id="specialized_attention_detail" v-model="formNoMetals.specialized_attention_detail">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Tipo</label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="type_intervention" id="type_intervention" v-model="formNoMetals.type_intervention">
                            <option value="Laboratorial">Laboratorial</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Pb (µg/dl)</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="pb_attention" id="pb_attention" v-model="formNoMetals.pb_attention" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">As (µg/g creatinina)</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="as_attention" id="as_attention" v-model="formNoMetals.as_attention" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Cd (µg/g creatinina)</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="cd_attention" id="cd_attention" v-model="formNoMetals.cd_attention" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Hg (µg/g creatinina)</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="hg_attention" id="hg_attention" v-model="formNoMetals.hg_attention" min="0">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Tipo Sector </label>
                        <select class="custom-select custom-select-sm" style="width: 100%;" name="other_attention" id="other_attention" v-model="formNoMetals.other_attention" @change="changeSectorNoMetals">
                            <option value="GOBIERNO REGIONAL">GOBIERNO REGIONAL</option>
                            <option value="ESSALUD">ESSALUD</option>
                            <option value="PRIVADO">PRIVADO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Ipress</label>
                        <select class="form-control select2 show-tick" style="width: 100%;" name="ipress_attention" id="ipress_attention" v-model="formNoMetals.ipress_attention" v-select2 required>
                            <option v-for="format in listEstablishSector" :value="format.Nombre_Establecimiento">[[ format.Nombre_Establecimiento ]]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Servicio</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="service_attention" id="service_attention" v-model="formNoMetals.service_attention">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Fecha</label>
                        <input type="date" class="form-control form-control-sm" name="date_attention" id="date_attention" v-model="formNoMetals.date_attention">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Resultados</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="results_attention" id="results_attention" v-model="formNoMetals.results_attention">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="font-13 text-olive">Observaciones</label>
                        <input type="text" class="form-control form-control-sm textUpper" name="observations_attention" id="observations_attention" v-model="formNoMetals.observations_attention">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-danger btn-sm m-1 font-14" @click="closeNoMetals" type="button"><i class="fa fa-times"></i> Cancelar</button>
        <button class="btn btn-success btn-sm m-1 font-14" id="search" type="submit"><i class="fa fa-save"></i> Guardar Cambios</button>
    </div>
</form>