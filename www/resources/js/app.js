require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#sarf',
    data() {
        return {
            tashkil_check: true,
            numberofayah: 7,
            ayah: '',
            ayah_no: '',
            word_list: [],
            selected_data: {}
        }
    },
    mounted() {
        $('#ayah')[0].selectedIndex = 0;
        this.getAyas('#surah');
    },
    methods: {
        getAyas(numberofayah) {
            this.ayah = ''
            this.word_list = []
            $('#ayah')[0].selectedIndex = 0;
            let num = $(numberofayah).find('option:selected').data('ayas')
            this.numberofayah = num;
            this.getWords()
        },

        getWords() {
            let surah = $('#surah').val();
            let ayah = $('#ayah').val();

            axios.get(`api/get_ayah/${surah}/${ayah}`)
                .then((res) => {
                    this.ayah = res.data.ayah[0].ayah_text
                    this.ayah_no = res.data.ayah[0].ayah_text_no_diacratic
                    this.word_list = res.data.sarf
                    this.selected_data = res.data.sarf[0]
                    $('#words')[0].selectedIndex = 0;
                })
        },

        selected(item) {
            this.selected_data = this.word_list.find(a => a.id == parseInt(item.value))
        },

    },

});