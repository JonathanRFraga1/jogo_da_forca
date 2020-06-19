function verCampos(e){
    var nickname = $('#login').val();
    var senha = $('#senha').val();
    var repete = $('#confirma').val();

    if(nickname == ""){
        e.preventDefault();
        console.log('nicknull');
        $('#resposta').html('Campos em Branco!');
        $('#login').addClass('erro');
    }
    if(senha == ""){
        e.preventDefault();
        console.log('passnull');
        $('#resposta').html('Campos em Branco!');
        $('#senha').addClass('erro');
    }else{
        if(senha != repete){
            e.preventDefault();
            console.log('difnull');
            $('#resposta').html('As senhas não conferem!');
            $('#confirma').val('');
            $('#senha').addClass('erro');
            $('#confirma').addClass('erro');
        }
    }
    if(repete == ""){
        e.preventDefault();
        console.log('repnull');
        $('#resposta').html('Campos em Branco!');
        $('#confirma').addClass('erro');
    }else{
        if(senha != repete){
            e.preventDefault();
            console.log('difnull');
            $('#resposta').html('As senhas não conferem!');
            $('#confirma').addClass('erro');
            $('#confirma').val('');
            $('#senha').addClass('erro');
        }
    }

}



$(document).ready(function(){
    $('#cadastrar').click(verCampos); 
});