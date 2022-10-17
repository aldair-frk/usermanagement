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

const app3 = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appNoMetals',
    data: {
        errors: [],
        listDepartment: [],
        listEstablishmentsAll: [],
        listEstablishSector: [],
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
        doc: '',
        lists: [],

        listColumnMonth: [],
        formStatus: "create",
        month_a: '',
        form: {},
        formdetail: {},
        formulary: false,
        lugar_ref: false,
        lugar_ref2: false,
        detail_specialized: false,
        document_type: '',
        document: '',
        yearNoMetal: '',
        disabled: true,
        disabled2: true,

        // PARA NO METALES
        formNoMetals: {},
        monthNoMetals: '',
        doc: '',
        formStatus2: '',

        doc_nometals: '',
        monthNoMetal: '',
    },
    created: function() {
        // this.filterDepartment();
        // this.filtersEstablishments();
    },
    methods: {
        // -----------------------------------------------------------------------PARA NO METALES
        SelectMonthNoMetals: function(){
            if(this.yearNoMetal == ''){
                toastr.error('Seleccione un año', null, { "closeButton": true, "progressBar": true });
            } else{
                this.formNoMetals = {};
                const doc = $("#doc").val();
                axios({
                    method: 'POST',
                    url: 'homologation/monthNoMetals',
                    data: { "id": doc, "m": this.monthNoMetal, "a": this.yearNoMetal },
                })
                .then(respuesta => {
                    this.doc_nometals = doc;
                    respuesta.data.length == 0 ? this.formStatus2 = "create"  : this.formStatus2 = "edit";
                    respuesta.data.length != 0 ? this.formNoMetals = respuesta.data[0] : this.formNoMetals = {};
                    this.changeReferenceNoMetals();
                    this.changeAgainRefNoMetals();
                    this.changeSpecializedNoMetals();
                    this.filtersEstablishmentsAll();
                    this.changeSectorNoMetals();
                    setTimeout(() => $('.show-tick').selectpicker('refresh'));
    
                }).catch(e => {
                    this.errors.push(e)
                })
            }
        },

        sendFormAttentionsNoMetals:function(e){
            if (this.formStatus2 == "create"){
                this.sendFormNoMetals()
            } else if (this.formStatus2 == "edit") {
                this.updateFormNoMetals()
            }
        },

        sendFormNoMetals: function(){
            // var csrfmiddlewaretoken = document.getElementsByName('csrfmiddlewaretoken')[0].value
            // var body = new FormData(e.target);
            const formData = $("#formulario4").serialize();
            axios({
                // headers: { 'X-CSRFToken': csrfmiddlewaretoken, 'Content-Type': 'multipart/form-data' },
                method: 'POST',
                url: 'homologation/addAttenNoMetals',
                data: formData,

            }).then(response => {
                toastr.success('Creado correctamente', null, { "closeButton": true });
                // setInterval("location.reload()",2000);
                this.closeNoMetals();
                setTimeout(() => $('.show-tick').selectpicker('refresh'));
            }).catch(e => {
                this.errors.push(e)
            })
        },

        updateFormNoMetals: function(){
            // var csrfmiddlewaretoken = document.getElementsByName('csrfmiddlewaretoken')[0].value
            // var body = new FormData(e.target);
            const formData = $("#formulario4").serialize();
            axios({
                // headers: { 'X-CSRFToken': csrfmiddlewaretoken, 'Content-Type': 'multipart/form-data' },
                method: 'PUT',
                url: 'homologation/edtAttNoMetals',
                data: formData,

            }).then(response => {
                toastr.success('Actualizado correctamente', null, { "closeButton": true });
                // setInterval("location.reload()",2000);
                this.closeNoMetals();
                setTimeout(() => $('.show-tick').selectpicker('refresh'));
            }).catch(e => {
                this.errors.push(e)
            })
        },

        changeSectorNoMetals: function(){
            this.listEstablishSector = [];
            axios({
                method: 'POST',
                url: 'stablishmentSector',
                data: { "id": this.formNoMetals.other_attention },
            })
            .then(respuesta => {
                this.listEstablishSector = respuesta.data;

            }).catch(e => {
                this.errors.push(e)
            })
        },

        changeReferenceNoMetals: function(){
            this.formNoMetals.reference == 'SI' ? this.lugar_ref = true : this.lugar_ref = false
        },

        changeAgainRefNoMetals: function(){
            this.formNoMetals.against_reference == 'SI' ? this.lugar_ref2 = true : this.lugar_ref2 = false
        },

        changeSpecializedNoMetals: function(){
            this.formNoMetals.specialized_attention == 'SI' ? this.detail_specialized = true : this.detail_specialized = false
        },

        closeNoMetals: function(){
            $(".hola2").hide();
            $(".formulary").show();
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


    }
})