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

const app2 = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appMetals',
    data: {
        errors: [],
        listDepartment: [],
        listEstablishmentsAll: [],
        listEstablishSector: [],
        doc_metals: '',
        lists: [],

        listColumnMonth: [],
        formStatus: "create",
        year_a: '',
        month_a: '',
        form: {},
        formdetail: {},
        formulary: false,
        lugar_ref: false,
        lugar_ref2: false,
        detail_specialized: false,

        disabled: true,
        disabled2: true,


        // PARA NO METALES
        formNoMetals: {},
        monthNoMetals: '',
        doc: '',
        formStatus2: '',
    },
    created: function() {
        // this.filterDepartment();
        // this.filtersEstablishments();
    },
    methods: {
        SelectMonth: function(){
            if(this.year_a == ''){
                toastr.error('Seleccione un año', null, { "closeButton": true, "progressBar": true });
            } else{
                this.formdetail = {};
                const doc = $("#doc").val();
                axios({
                    method: 'POST',
                    url: 'homologation/month',
                    data: { "id": doc, "m": this.month_a, "a": this.year_a },
                })
                .then(respuesta => {
                    this.doc_metals = doc;
                    respuesta.data.length == 0 ? this.formStatus = "create"  : this.formStatus = "edit";
                    respuesta.data.length != 0 ? this.formdetail = respuesta.data[0] : this.formdetail = {};
                    this.changeReference();
                    this.changeAgainRef();
                    this.changeSpecialized();
                    this.filtersEstablishmentsAll();
                    this.changeSector();
                    setTimeout(() => $('.show-tick').selectpicker('refresh'));

                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },

        PrintExcel: function(){
            var doc = $('#doc').val();
            url_ = window.location.origin + window.location.pathname + '/printExcel?d=' + (doc);
            window.open(url_,'_blank');
        },

        sendFormAttentionsMetals: function(e){
            if (this.formStatus == "create"){
                this.sendFormAttentions()
            } else if (this.formStatus == "edit") {
                this.updateFormAttentions()
            }
        },

        sendFormAttentions: function(){
            // var csrfmiddlewaretoken = document.getElementsByName('csrfmiddlewaretoken')[0].value
            // var body = new FormData(e.target);
            const formData = $("#formulario3").serialize();
            axios({
                // headers: { 'X-CSRFToken': csrfmiddlewaretoken, 'Content-Type': 'multipart/form-data' },
                method: 'POST',
                url: 'homologation/addAtten',
                data: formData,

            }).then(response => {
                // toastr.success('Creado correctamente', null, { "closeButton": true });
                this.month_a = '';
                setInterval(toastr.success('Creado correctamente', null, { "closeButton": true }), 5000);
                this.close();
                setTimeout(() => $('.show-tick').selectpicker('refresh'));
            }).catch(e => {
                this.errors.push(e)
            })
        },

        updateFormAttentions: function(){
            // var csrfmiddlewaretoken = document.getElementsByName('csrfmiddlewaretoken')[0].value
            // var body = new FormData(e.target);
            const formData = $("#formulario3").serialize();
            axios({
                // headers: { 'X-CSRFToken': csrfmiddlewaretoken, 'Content-Type': 'multipart/form-data' },
                method: 'PUT',
                url: 'homologation/edtAtt',
                data: formData,

            }).then(response => {
                setInterval(toastr.success('Actualizado correctamente', null, { "closeButton": true }), 5000);
                // setInterval("location.reload()",2000);
                this.month_a = '';
                this.close();
                setTimeout(() => $('.show-tick').selectpicker('refresh'));
            }).catch(e => {
                this.errors.push(e)
            })
        },

        changeSector: function(){
            this.listEstablishSector = [];
            axios({
                method: 'POST',
                url: 'stablishmentSector',
                data: { "id": this.formdetail.other_attention },
            })
            .then(respuesta => {
                this.listEstablishSector = respuesta.data;
        
            }).catch(e => {
                this.errors.push(e)
            })
        },

        changeReference: function(){
            this.formdetail.reference == 'SI' ? this.lugar_ref = true : this.lugar_ref = false
        },

        changeAgainRef: function(){
            this.formdetail.against_reference == 'SI' ? this.lugar_ref2 = true : this.lugar_ref2 = false
        },

        changeSpecialized: function(){
            this.formdetail.specialized_attention == 'SI' ? this.detail_specialized = true : this.detail_specialized = false
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

        close: function(){
            $(".hola").hide();
            $(".formulary").show();
        }
    }
})