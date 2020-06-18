function verCampos(e){
    var pal = $('#pal').val();
    var dica = $('#dica').val();

    if(pal == ""){
        e.preventDefault();
        $('#resposta').html('Campos em Branco!');
        $('#pal').addClass('erro');
        window.scrollTo(0,document.body.scrollTop);

    }else{

        if(pal.indexOf(' ')!=-1){
            e.preventDefault();
            $('#resposta').html('A palavra não deve conter espaços ou underlines "_"!<br>Caso necessite de dos mesmos, utilize hifens"-"');
            $('#pal').addClass('erro');
            window.scrollTo(0,document.body.scrollTop);
        }else{
            if(pal.indexOf('_')!=-1){
                e.preventDefault();
                $('#resposta').html('A palavra não deve conter espaços ou underlines "_"!<br>Caso necessite de dos mesmos, utilize hifens"-"');
                $('#pal').addClass('erro');
                window.scrollTo(0,document.body.scrollTop);
            }else {
                $('#pal').removeClass('erro');
            }
        }

    }
    if(dica == ""){
        e.preventDefault();
        $('#resposta').html('Campos em Branco!');
        $('#dica').addClass('erro');
    }else{
        $('#dica').removeClass('erro');
    }
}

function EnterTab(e){

    if(e.keyCode == 13){
        e.preventDefault;
        document.getElementById('dica').focus();

    }

}

$(document).ready(function(){
    $('#cadastrar').click(verCampos);
    document.getElementById('pal').addEventListener('keyup',EnterTab);
});
