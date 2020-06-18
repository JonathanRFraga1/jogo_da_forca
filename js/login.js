function verCampos(e){
    var nickname = $('#login').val();
    var senha = $('#senha').val();

    if(nickname == ""){
        e.preventDefault();
        console.log('nicknull');
        $('#resposta').html('Campos em Branco!');
        $('#login').addClass('erro');
    }else{
        $('#login').removeClass('erro');
    }
    if(senha == ""){
        e.preventDefault();
        console.log('passnull');
        $('#resposta').html('Campos em Branco!');
        $("#senha").style.borderBottomColor = "#FF0000";
    }else{
        //$('#lsenha').style.backgroundColor = "#00838f";
    }
}

$(document).ready(function(){
    $('#enviar').click(verCampos); 
});
