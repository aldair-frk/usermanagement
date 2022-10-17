const appPrematuros = new Vue({
    delimiters: ['[[', ']]'],
    el: '#appDash',
    data: {
        errors: [],
        listPatients: [],
        listCategory: [],
        listGroupAge: [],
        totalPatients: 0,
        exposed: 0,
        affected: 0,
        young: 0,
    },
    created: function() {
        this.Patients();
        this.Category();
        this.GroupAge();
    },
    methods: {
        Patients: function(){
            axios.post('dash/tPatients')
            .then(respuesta => {
                this.listPatients = respuesta.data;
                var woman=0; var man=0;
                for (var i = 0; i < this.listPatients.length; i++) {
                    this.totalPatients++;
                    this.listPatients[i].younger == 'SI' ? this.young++ : this.young;
                    this.listPatients[i].case_type == 'EXPUESTO' ? this.exposed++ : this.affected++;
                    this.listPatients[i].gender == 'F' ? woman++ : man++;
                }
                var dataGender = [
                    { label: 'Mujeres', data : woman, color: '#3bd5ab' },
                    { label: 'Varones', data : man, color: '#34B2E3' },
                ]
                $.plot('#chartGender', dataGender, {
                    series: seriesPie,
                    legend: { show: false }
                })

            }).catch(e => {
                this.errors.push(e)
            })
        },

        Category: function(){
            axios.post('dash/contCategory')
            .then(respuesta => {
                this.listCategory = respuesta.data[0];
                var category1 = [
                    {data : [[1, this.listCategory.Cat1]], color: '#FFD791'},
                    {data : [[2, this.listCategory.Cat2]], color: '#F7C2B0'},
                    {data : [[3, this.listCategory.Cat3]], color: '#DB8694'},
                    {data : [[4, this.listCategory.Cat4]], color: '#D48EC8'}
                ]

                $.plot('#chartCategory', category1, {
                    grid  : {
                        borderWidth: 1,
                        borderColor: '#f3f3f3',
                        tickColor  : '#f3f3f3',
                        hoverable: true,
                    },
                    series: seriesBar,
                    xaxis : {
                        ticks: [[1,'C-I'], [2,'C-II'], [3,'C-III'], [4,'C-IV']]
                    }
                })
            }).catch(e => {
                this.errors.push(e)
            })
        },

        GroupAge: function(){
            axios.post('dash/groupAge')
            .then(respuesta => {
                this.listGroupAge = respuesta.data[0];
                var dataAge = [
                    [1, this.listGroupAge.oneFour], [2, this.listGroupAge.fiveEleven],
                    [3, this.listGroupAge.twelveSeventeen], [4, this.listGroupAge.eighteenTwentynine],
                    [5, this.listGroupAge.thirtyFiftynine], [6, this.listGroupAge.sixty],
                ];

                var age = { data : dataAge, color: '#3c8dbc' }
                $.plot('#chartAge', [age], {
                    grid  : gridAge,
                    series: seriesLine,
                    lines : { fill : true, color: ['#3c8dbc', '#f56954'] },
                    xaxis : {
                        ticks: [[1,'1-4'], [2,'5-11'], [3,'12-17'], [4,'18-29'], [5,'30-59'], [6,'60+']]
                    }
                })

            }).catch(e => {
                this.errors.push(e)
            })
        },
    }
})