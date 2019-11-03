var app = new Vue({
    el: '#app',
    mounted :function(){
        this.addMaskInputs();
    },
    data: {
      cep: '',
      endereco: {},
    },
    methods: {
        fetchCep :function(cep){
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(response => this.endereco = response)
        },
        addMaskInputs :function(){
            var maskCpfOuCnpj = IMask(document.getElementById('cpfcnpj'), {
                mask:[
                    {
                        mask: '000.000.000-00',
                        maxLength: 11
                    },
                    {
                        mask: '00.000.000/0000-00'
                    }
                ]
            });

            $('.telefone').each(function(){
                    var cleave = new Cleave(this, {
                    phone: true,
                    phoneRegionCode: 'BR'
                }); 
            });

            var cepcleave = new Cleave('#cep', {
                delimiters: ['-'],
                blocks: [5, 3],
            });
        }
    },
    watch:{
        cep :function(novo, antigo){
            if(novo.length > 8)
            {
                this.fetchCep(novo);
            }
        }
    }
  })