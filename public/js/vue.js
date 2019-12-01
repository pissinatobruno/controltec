var app = new Vue({
    el: '#app',
    mounted :function(){
        this.addMaskInputs();
        this.removerMarcara();
        this.removerMarcaraUp();
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

        },

        removerMarcara : function(){
            
            $("#salvar").click(function(){

               var cpfcnpj =  $('#cpfcnpj').val();
               var tel = $('#telefone').val();
               var cep = $('#cep').val();
               var tel2 =  $('#telefone2').val();

               cpfcnpj = cpfcnpj.replace(/[^0-9]+/g,'');
               tel = tel.replace(/[^0-9]+/g,'');
               cep = cep.replace(/[^0-9]+/g,'');
               tel2 = tel2.replace(/[^0-9]+/g,'');

               $('#cpfcnpj').val(cpfcnpj);
               $('#telefone').val(tel);
               $('#telefone2').val(tel2);
               $('#cep').val(cep);

            });

        },

        removerMarcaraUp : function(){
            
            $("#saveup").click(function(){

               var cpfcnpj =  $('#cpfcnpj').val();
               var tel = $('#telefone').val();
               var cep = $('#cep').val();
               var tel2 =  $('#telefone2').val();

               cpfcnpj = cpfcnpj.replace(/[^0-9]+/g,'');
               tel = tel.replace(/[^0-9]+/g,'');
               cep = cep.replace(/[^0-9]+/g,'');
               tel2 = tel2.replace(/[^0-9]+/g,'');

               $('#cpfcnpj').val(cpfcnpj);
               $('#telefone').val(tel);
               $('#telefone2').val(tel2);
               $('#cep').val(cep);

            });

        },

    },
    watch:{
        cep :function(novo, antigo){
            if(novo.length > 8)
            {
                this.fetchCep(novo);
            }
        }
    }

  });