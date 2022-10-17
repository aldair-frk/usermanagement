Vue.directive('select2', {
    inserted(el) {
        $(el).on('select2:select', () => {
            const event = new Event('change', { bubbles: true, cancelable: true });
            el.dispatchEvent(event);
        });

        $(el).on('select2:unselect', () => {
            const event = new Event('change', {bubbles: true, cancelable: true})
            el.dispatchEvent(event)
        })
    },
});

Vue.directive('uppercase', {
    bind(el) {
        el.addEventListener('keyup', () => {
            el.value = el.value.toUpperCase();
        });
    }
});

const appHomologations = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appHomologation',
    data: {
        errors: [],
        listDepartment: [],
        listEstablishmentsAll: [],
        // PARA REGISTRO ACTUAL
        listProvinces: [],
        listDistricts: [],
        listEstablishments: [],
        // PARA RESIDENCIA ACTUAL
        listProvinces2: [],
        listDistricts2: [],
        // PARA LUGAR NACIDO
        listProvinces3: [],
        listDistricts3: [],

        form: {},
        doc: '',
        formulary: false,
        document_type: '',
        document: '',

        disabled: true,
        disabled2: true,
        patient: false,
        viewCategory: true,
    },
    created: function() {
        // this.filterDepartment();
        // this.filtersEstablishments();
    },
    methods: {
        viewPatient: function(){
            this.patient = true
            this.formulary = false
        },

        listPatient: function() {
            $(".btnSearch").hide();
            $("#document").prop('readonly', true);
            $("#clinic_history").prop('readonly', true);
            this.disabled2 = true
            const formData = $("#formulario0").serialize();
            if (this.doc == '') { toastr.error('Ingrese su Documento', null, { "closeButton": true, "progressBar": true }); }
            else{
                axios({
                    method: 'POST',
                    url: 'metals/listDni',
                    data: formData,
                })
                .then(response => {
                    if(response.data.length == 0){
                        this.document_type = '';
                        this.document = '';
                        this.formulary = false
                        Swal.fire({
                            icon: 'error',
                            title: 'El usuario no se encuentra en el Registrado...!',
                        })
                    }
                    else{
                        this.form = response.data[0];
                        this.document_type = this.form.document_type;
                        this.document = this.form.document;
                        this.formulary = true
                        this.filterDepartment();
                        this.filtersProvinces();
                        this.filtersDistricts();
                        this.filtersEstablishments();
                        this.filtersProvinces2();
                        this.filtersDistricts2();
                        this.filtersProvinces3();
                        this.filtersDistricts3();
                        this.filtersEstablishmentsAll();
                    }

                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },

        // PARA LUGAR DONDE SE ESTA REGISTRANDO
        filterDepartment: function(){
            axios.post('department')
            .then(respuesta => {
                this.listDepartment = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersProvinces() {
            this.listProvinces = [];
            axios({
                method: 'POST',
                url: 'provinces',
                data: { "id": this.form.region_register },
            })
            .then(respuesta => {
                this.listProvinces = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersDistricts() {
            this.listDistricts = [];
            axios({
                method: 'POST',
                url: 'districts',
                data: { "id": this.form.province_register },
            })
            .then(respuesta => {
                this.listDistricts = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersEstablishments: function(){
            this.listEstablishments = [];
            axios({
                method: 'POST',
                url: 'stablishments',
                data: { "id": this.form.district_register },
            })
            .then(respuesta => {
                this.listEstablishments = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        // PARA LUGAR RESIDENCIA ACTUAL
        filtersProvinces2() {
            this.listProvinces2 = [];
            axios({
                method: 'POST',
                url: 'provinces',
                data: { "id": this.form.region_current },
            })
            .then(respuesta => {
                this.listProvinces2 = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersDistricts2() {
            this.listDistricts2 = [];
            axios({
                method: 'POST',
                url: 'districts',
                data: { "id": this.form.province_current },
            })
            .then(respuesta => {
                this.listDistricts2 = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        // PARA LUGAR NACIDO
        filtersProvinces3() {
            this.listProvinces3 = [];
            axios({
                method: 'POST',
                url: 'provinces',
                data: { "id": this.form.region_before },
            })
            .then(respuesta => {
                this.listProvinces3 = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersDistricts3() {
            this.listDistricts3 = [];
            axios({
                method: 'POST',
                url: 'districts',
                data: { "id": this.form.province_before },
            })
            .then(respuesta => {
                this.listDistricts3 = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersEstablishmentsAll: function(){
            this.listEstablishmentsAll = [];
            axios.post('stablishmentsAll')
            .then(respuesta => {
                this.listEstablishmentsAll = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        sendFormUser: function(e){
            // var csrfmiddlewaretoken = document.getElementsByName('csrfmiddlewaretoken')[0].value
            // var body = new FormData(e.target);
            const formData = $("#formulario").serialize();
            axios({
                // headers: { 'X-CSRFToken': csrfmiddlewaretoken, 'Content-Type': 'multipart/form-data' },
                method: 'PUT',
                url: 'homologation/put',
                data: formData,

            }).then(response => {
                toastr.success('Actualizado correctamente', null, { "closeButton": true });
                // setInterval("location.reload()",2000);
                this.patient = false
                this.formulary = true
                setTimeout(() => $('.show-tick').selectpicker('refresh'));
            }).catch(e => {
                this.errors.push(e)
            })
        },

        close: function(){
            this.patient = false
            this.formulary = true
        },

        volver: function(){
            this.formulary = true
            this.patient = false
        },

        changeCategory: function(){
            
        }
    }
})