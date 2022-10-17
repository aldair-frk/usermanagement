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
    el: '#appMetals',
    data: {
        errors: [],
        lists: [],
        listsAttentions: [],
        listsResum: [],
        listsDetail: [],
        listProvinces: [],
        listDistricts : [],
        department: '',
        red: '',
        distrito: '',
        anio: '',
        department1: '',
        red1: '',
        distrito1: '',
        anio1: '',
        listProvinces1: [],
        listDistricts1 : [],
        doc: '',
        category: '',
        table: false,
        tableResum: false,
        anioXdep: '',
        typeXdep: '',
        anioXdoc: '',
        typeXdoc: 'METALES',

        Xred: false,
        XPatient: false,
        XCategory: false,
        XAtenInt: false,
    },
    created: function() {
        this.filtersProvinces();
        this.filtersDistricts();
    },
    methods: {

        filtersProvinces() {
            this.listProvinces = [];
            axios({
                method: 'POST',
                url: 'provinces',
                data: { "id": 'PASCO' },
            })
            .then(respuesta => {
                this.listProvinces = respuesta.data;
                this.listProvinces.push({'Departamento': 'TODOS', 'Provincia': 'TODOS'})
                setTimeout(() => $('.show-tick').selectpicker('refresh'));

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersDistricts() {
            this.listDistricts = [];
            axios({
                method: 'POST',
                url: 'districts',
                data: { "id": this.red },
            })
            .then(respuesta => {
                this.listDistricts = respuesta.data;
                this.listDistricts.push({'Departamento': 'TODOS', 'Provincia': 'TODOS', 'Distrito': 'TODOS'})
                setTimeout(() => $('.show-tick').selectpicker('refresh'));

            }).catch(e => {
                this.errors.push(e)
            })
        },

        // PARA ATENCION INTEGRAL
        filtersProvinces1() {
            this.listProvinces1 = [];
            axios({
                method: 'POST',
                url: 'provinces',
                data: { "id": this.department1 },
            })
            .then(respuesta => {
                this.listProvinces1 = respuesta.data;
                this.listProvinces1.push({'Departamento': 'TODOS', 'Provincia': 'TODOS'})
                setTimeout(() => $('.show-tick').selectpicker('refresh'));

            }).catch(e => {
                this.errors.push(e)
            })
        },

        filtersDistricts1() {
            this.listDistricts1 = [];
            axios({
                method: 'POST',
                url: 'districts',
                data: { "id": this.red1 },
            })
            .then(respuesta => {
                this.listDistricts1 = respuesta.data;
                this.listDistricts1.push({'Departamento': 'TODOS', 'Provincia': 'TODOS', 'Distrito': 'TODOS'})
                setTimeout(() => $('.show-tick').selectpicker('refresh'));

            }).catch(e => {
                this.errors.push(e)
            })
        },

        // PARA VISTA DE FORMULARIOS
        selectXred: function(){
            this.Xred = true
            this.table = false
            this.XPatient = false
            this.XCategory = false
            this.XAtenInt = false
        },

        selectXpatient: function(){
            this.XPatient = true
            this.table = false
            this.Xred = false
            this.XCategory = false
            this.XAtenInt = false
        },

        selectXcategory: function(){
            this.XCategory = true
            this.table = false
            this.XPatient = false
            this.Xred = false
            this.XAtenInt = false
        },

        selectXAtenInt: function(){
            this.XAtenInt = true
            this.XCategory = false
            this.table = false
            this.XPatient = false
            this.Xred = false
        },

        // PARA REPORTES
        listMetals: function() {
            const formData = $("#formulario").serialize();
            if (this.red == '') { toastr.error('Seleccione una Provincia', null, { "closeButton": true, "progressBar": true }); }
            else if (this.distrito == '') { toastr.error('Seleccione un Distrito', null, { "closeButton": true, "progressBar": true }); }
            else if (this.anioXdep == '') { toastr.error('Seleccione un Año', null, { "closeButton": true, "progressBar": true }); }
            else if (this.type == '') { toastr.error('Seleccione un Tipo', null, { "closeButton": true, "progressBar": true }); }
            else{
                axios({
                    method: 'POST',
                    url: 'metals/list',
                    data: formData,
                })
                .then(response => {
                    this.table = true
                    this.tableResum = false
                    this.lists = response.data;
                    $("#export").val("lista");
                    $('.footable-page a').filter('[data-page="0"]').trigger('click');

                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },

        PrintNominal: function(){
            const exp = $("#export").val();
            if(exp == 'dni'){
                url_ = window.location.origin + window.location.pathname + '/printDni?d=' + (this.doc) + '&a=' + (this.anioXdoc);
                window.open(url_,'_blank');
            }
            else if(exp == 'category'){
                var cat = $("#category").val();
                url_ = window.location.origin + window.location.pathname + '/printCategory?c=' + (cat);
                window.open(url_,'_blank');
            }
            else{
                var red = $('#red').val();
                var dist = $('#distrito').val();
                var anio = $('#anioXdep').val();
                var type = $('#typeXdep').val();

                url_ = window.location.origin + window.location.pathname + '/printMetals?r=' + (red) + '&ds=' + (dist) + '&a=' + (anio) + '&t=' + (type);
                window.open(url_,'_blank');
            }
        },

        PrintNominalAll: function(){
            var red = $('#red').val();
            var dist = $('#distrito').val();
            var anio = $('#anioXdep').val();

            url_ = window.location.origin + window.location.pathname + '/printAll?r=' + (red) + '&ds=' + (dist) + '&a=' + (anio);
            console.log(url_);
            window.open(url_,'_blank');
        },

        listMetalsDni: function() {
            const formData = $("#formulario2").serialize();
            if (this.doc == '') { toastr.error('Ingrese su Documento', null, { "closeButton": true, "progressBar": true }); }
            else if (this.anioXdoc == '') { toastr.error('Seleccione un año', null, { "closeButton": true, "progressBar": true }); }
            else{
                axios({
                    method: 'POST',
                    url: 'metals/listDni',
                    data: formData,
                })
                .then(response => {
                    this.table = true
                    this.tableResum = false
                    this.lists = response.data;
                    $("#export").val("dni");
                    $('.footable-page a').filter('[data-page="0"]').trigger('click');

                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },

        listMetalsCategory: function() {
            const formData = $("#formulario3").serialize();
            if (this.category == '') { toastr.error('Seleccione una Categoria', null, { "closeButton": true, "progressBar": true }); }
            else{
                axios({
                    method: 'POST',
                    url: 'metals/listCategory',
                    data: formData,
                })
                .then(response => {
                    this.table = true
                    this.tableResum = false
                    this.lists = response.data;
                    $("#export").val("category");
                    $('.footable-page a').filter('[data-page="0"]').trigger('click');

                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },

        listMetalsAtenInt: function() {
            const formData = $("#formulario4").serialize();
            if (this.department1 == '') { toastr.error('Seleccione una Región', null, { "closeButton": true, "progressBar": true }); }
            else if (this.red1 == '') { toastr.error('Seleccione una Provincia', null, { "closeButton": true, "progressBar": true }); }
            else if (this.distrito1 == '') { toastr.error('Seleccione un Distrito', null, { "closeButton": true, "progressBar": true }); }
            else if (this.anio1 == '') { toastr.error('Seleccione un Año', null, { "closeButton": true, "progressBar": true }); }
            else{
                axios({
                    method: 'POST',
                    url: 'metals/listAtenInt',
                    data: formData,
                })
                .then(response => {
                    this.table = false
                    this.tableResum = true
                    this.listsResum = response.data;
                    // $("#export").val("lista");
                    $('.footable-page a').filter('[data-page="0"]').trigger('click');

                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },

        printAtentionsIntg: function(){
            var dep = $('#department1').val();
            var red = $('#red1').val();
            var dist = $('#distrito1').val();
            var anio = $('#anio1').val();

            url_ = window.location.origin + window.location.pathname + '/printAtenInt?d=' + (dep) + '&r=' + (red) + '&ds=' + (dist) + '&a=' + (anio);
            window.open(url_,'_blank');
        },

        clearRed: function(){
            this.table = false
            this.tableResum = false
            $("#red").select2("val", '0');
            $("#distrito").select2("val", '0');
            $("#anio").select2("val", '0');
            $("#mes").select2("val", '0');
        },

        clearDocumento: function(){
            this.table = false
            this.tableResum = false
            document.getElementById('doc').value = '';
        },

        clearCategory: function(){
            this.table = false
            this.tableResum = false
            $("#category").select2("val", '0');
        },

        infPatient: function(e){
            this.listsDetail = e;
            this.listsAttentions = [];
            $('#ModalInformacion').modal('show');
            $('#dta_user').text('Atenciones para '+ e.document);
            if(this.typeXdep && this.anioXdep){
                var tipo = this.typeXdep; var anio = this.anioXdep;
            }

            if(this.typeXdoc && this.anioXdoc){
                var tipo = 'METALES'; var anio = this.anioXdoc;
            }

            axios({
                method: 'POST',
                url: 'metals/listAttentions',
                data: {'doc': e.document, 'anio': anio, 'type': tipo },
            })
            .then(response => {
                if(response.data.length == 0){
                    $(".msmAttentions").text('No hay Atenciones por el momento...');
                }else{
                    $(".msmAttentions").text('');
                    this.listsAttentions = response.data;
                }
                $( "#attentionsTabs" ).tabs({ active: 0 });
                $('.footable-page a').filter('[data-page="0"]').trigger('click');

            }).catch(e => {
                this.errors.push(e)
            })
        },
    }
})