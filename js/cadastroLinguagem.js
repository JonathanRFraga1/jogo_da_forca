function verCampos(e){
    var ling = $('#ling').val();
    var desc = $('#desc').val();

    if(ling == ""){
        e.preventDefault();
        $('#resposta').html('Campos em Branco!');
        $('#ling').addClass('erro');
    }else{
        $('#ling').removeClass('erro');
    }
    if(desc == ""){
        e.preventDefault();
        $('#resposta').html('Campos em Branco!');
        $('#desc').addClass('erro');
    }else{
        $('#desc').removeClass('erro');
    }
}

$(document).ready(function(){
    $('#cadastrar').click(verCampos); 
});