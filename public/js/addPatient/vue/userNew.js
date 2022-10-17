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

const appPrematuros = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appNewUser',
    data: {
        errors: [],
        listDepartment: [],
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
        document_type: '',
        document: '',
        form: {},

        disabled: true,
        disabled2: false,
        viewCategory: false
    },
    created: function() {
        // this.filterDepartment();
    },
    methods: {
        listPatient: function() {;
            if((this.document_type == 'DNI' && this.document.length == 8) || (this.document_type == 'CE' && this.document.length == 12)){
                axios({
                    method: 'POST',
                    url: 'patient/users',
                    data: { "doc": this.document },
                })
                .then(response => {
                    if(response.data == 'h0'){
                        Swal.fire({
                            icon: 'error',
                            title: 'El usuario no se encuentra en el padrón...!',
                            text: 'Ingrese sus datos manualmente.',
                        })

                        this.formClean();
                        this.filterDepartment();
                        this.form = {};
                        this.listDepartment = [];
                        this.listProvinces3 = [];
                        this.listDistricts3 = [];
                    }
                    else if(response.data == 'exist'){
                        this.form = ''; this.document = '';
                        Swal.fire({
                            title: 'El usuario ya se encuentra registrado!',
                            text: 'Ingrese otro Dni o Carnet de Extranjería',
                            imageUrl: './img/person.png',
                            imageWidth: 200,
                            imageHeight: 190,
                            imageAlt: 'Custom image',
                        })

                        this.formExist();
                    }
                    else{
                        this.form = response.data[0];
                        this.form.age = this.calculateAge(response.data[0].birth_date);
                        this.form.age < 17 ? this.form.younger = 'SI' : this.form.younger = 'NO';

                        this.formExist();
                        this.filterDepartment();
                        this.filtersProvinces3();
                        this.filtersDistricts3();
                    }

                    this.form.pn_registration_date = new Date().toISOString().split('T')[0];

                }).catch(e => {
                    this.errors.push(e)
                })
            }else{
                toastr.error('Ingrese su documento o el tipo de documento Correctamente', null, { "closeButton": true, "progressBar": true });
            }
        },

        birthday: function(data){
            this.form.age = this.calculateAge(data);
            this.form.age < 17 ? this.form.younger = 'SI' : this.form.younger = 'NO';
            console.log(this.form.age);
        },

        formClean: function(){
            $('#names').prop('readonly', false);
            $('#birth_date').prop('readonly', false);
            // $('#age').prop('readonly', false);
            $('#direction_before').prop('readonly', false);
            this.disabled = false
        },

        formExist: function(){
            $('#names').prop('readonly', true);
            $('#birth_date').prop('readonly', true);
            $('#age').prop('readonly', true);
            $('#direction_before').prop('readonly', true);
            this.disabled = true
        },

        calculateAge: function(birthday){
            var birthday = birthday.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
            var birthday_arr = birthday.split("/");
            var birthday_date = new Date(birthday_arr[2], birthday_arr[1] - 1, birthday_arr[0]);
            var ageDifMs = Date.now() - birthday_date.getTime();
            var ageDate = new Date(ageDifMs);
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        },

        changeCategory: function(){
            this.form.case_type == 'AFECTADO' ? this.viewCategory = true : this.viewCategory = false;
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

        sendFormUser: function(e){
            var csrfmiddlewaretoken = document.getElementsByName('_token').value;
            $('#gender').prop('disabled', false);
            $('#younger').prop('disabled', false);
            $('#region_before').prop('disabled', false);
            $('#province_before').prop('disabled', false);
            $('#district_before').prop('disabled', false);
            const formData = $("#formulario").serialize();
            console.log(formData);
            $('#gender').prop('disabled', true);
            $('#younger').prop('disabled', true);
            $('#region_before').prop('disabled', true);
            $('#province_before').prop('disabled', true);
            $('#district_before').prop('disabled', true);
            axios({
                // headers: { 'X-CSRFToken': csrfmiddlewaretoken, 'Content-Type': 'multipart/form-data' },
                // "Content-Type": "application/json", "X-CSRF-Token": csrfToken
                method: 'POST',
                url: 'patient/add',
                data: formData,
            })
            .then(respuesta => {
                // toastr.success('Creado correctamente', null, { "closeButton": true });
                // setInterval("location.reload()",1000);
                axios({
                    // headers: { 'X-CSRFToken': csrfmiddlewaretoken, 'Content-Type': 'multipart/form-data' },
                    method: 'POST',
                    url: 'patient/addAttentions2',
                    data: {'doc': this.document, 'id': respuesta.data.id }
                }).then(response => {
                    toastr.success('Creado correctamente', null, { "closeButton": true });
                    setInterval("location.reload()",1000);
                    setTimeout(() => $('.show-tick').selectpicker('refresh'));
                }).catch(e => {
                    this.errors.push(e)
                })

            }).catch(e => {
                this.errors.push(e)
            })
        },

        PrintPDF: function(){
            var doc = $('#doc').val();
            url_ = window.location.origin + window.location.pathname + '/printPdf?d=' + (doc);
            window.open(url_,'_blank');
        },

        PrintExcel: function(){
            var doc = $('#doc').val();
            url_ = window.location.origin + window.location.pathname + '/printExcel?d=' + (doc);
            window.open(url_,'_blank');
        },

        close: function(){
            this.form = {};
        }
    }
})