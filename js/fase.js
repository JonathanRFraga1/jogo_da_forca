var indice = 0;

var numeros = [];

var numErros = 0;

var proximo = false;

var numAcertos = 0;

var acertos = 0;

var letraErrada = [];

var letraCerta = [];



switch (nivel) {
    case 1:
        numAcertos = 7;
        $('#principal').addClass('nivel1');
        break;
    case 2:
        numAcertos = 10;
        $('#principal').addClass('nivel2');
        break;
    case 3:
        numAcertos = 15;
        $('#principal').addClass('nivel3');
        break;
    case 4:
        numAcertos = 20;
        $('#principal').addClass('nivel4');
        break;
    case 5:
        numAcertos = 30;
        $('#principal').addClass('nivel5');
        break;
    case 6:
        numAcertos = 40;
        $('#principal').addClass('nivel6');
        break;
    case 7:
        numAcertos = 50;
        $('#principal').addClass('nivel7');
        break;
}

console.log('Estado Game Over: ' + gameOver);

var proximo = false;

function numero_aleatorio() {

    if (array_palavras.length == 0 || array_palavras.length == 1) {
        $('#modal').addClass('mostrar');

        $('#msg').html('Desculpe, mas não há palavas cadastradas neste nível de dificuldade!<br>Peça ao adminstrador para cadastrar mais palavras.');

        var bt = document.getElementById('btmodal');

        bt.setAttribute("value", 'Voltar a tela inicial');

        $('#btmodal').click(function() {

            window.location.href = "../index.php";

            $('#modal').removeClass('mostrar');

        });

    } else {
        while (numeros.length < array_palavras.length) {
            var aleatorio = Math.floor(Math.random() * (array_palavras.length));

            if (numeros.indexOf(aleatorio) == -1)
                numeros.push(aleatorio);
        }
    }
}

function dica() {
    if (array_dica[numeros[indice]] != null) {
        document.getElementById('dica').innerHTML = 'Dica: ' + array_dica[numeros[indice]];
    }
}

function letras() {

    var i = 0;
    var tam = resultado.length;

    while (i < tam) {
        var letra = document.createElement('p');
        if (resultado[i] == "-") {
            letra.innerHTML = '- &nbsp;';
            document.getElementById('letter').appendChild(letra);
        } else {
            if (resultado[i] == " ") {
                letra.innerHTML = '&nbsp;&nbsp;';
                document.getElementById('letter').appendChild(letra);
            } else {
                letra.setAttribute("class", resultado[i]);
                letra.innerHTML = '_ &nbsp;';
                document.getElementById('letter').appendChild(letra);
            }
        }

        i++;
    }
}

function chutePalavra() {

    var palavarT = $('#palavra').val();

    if (palavarT != "") {

        palavarT = palavarT.toLocaleLowerCase();

        var quantos = array_palavras.length;

        var index = 0;

        var ind = indice;

        if (ind != quantos) {
            index = ind;
        } else {
            ind--;
            index = ind;
        }

        var palavra1 = array_palavras[numeros[index]];

        if (palavarT == palavra1) {

            if (quantos > indice) {

                if (acertos < numAcertos) {

                    $('#palavraTela').html(array_palavras[numeros[index]]);

                    document.getElementById('palavra').value = '';

                    $('#modal').addClass('mostrar');

                    $('#msg').html('Parabéns! Você acertou a palavra.');

                    pont = pont + (75 * nivel);

                    letraCerta = null;
                    letraCerta = [];

                    letraErrada = null;
                    letraErrada = [];

                    document.getElementById('pont').innerHTML = pont;

                    var bt = document.getElementById('btmodal');

                    bt.setAttribute("value", 'Próxima Palavra');

                    $('#btmodal').click(function() {

                        $('#modal').removeClass('mostrar');

                        document.getElementById('letra').focus();

                        console.log("acertos: " + acertos);

                        novaPalavra();

                    });
                } else {

                    pont = pont + (75 * nivel);
                    pont = pont + (200 * nivel);

                    document.getElementById('pont').innerHTML = pont;

                    proximo = true;

                    $('#modal').addClass('mostrar');

                    $('#msg').html('Nível Completo!');

                    var bt = document.getElementById('btmodal');

                    bt.setAttribute("value", 'Próximo nível!');

                    gameOver = 0;

                    $('#btmodal').click(function() {

                        pxFase();

                        $('#modal').removeClass('mostrar');

                        acertos = 0;
                    });

                }

            } else {


                pont = pont + (75 * nivel);
                pont = pont + (200 * nivel);

                document.getElementById('pont').innerHTML = pont;

                proximo = true;

                if (nivel != 6) {

                    $('#modal').addClass('mostrar');

                    $('#msg').html('Nível Completo!');

                    var bt = document.getElementById('btmodal');

                    bt.setAttribute("value", 'Próximo nível!');

                    gameOver = 0;

                    $('#btmodal').click(function() {

                        pxFase();

                        $('#modal').removeClass('mostrar');
                    });

                } else {
                    $('#msg').html('Parabéns, você completou o jogo!!!<br>Agora você pode jogar um nível aleatório com todas as palavas do jogo!');

                    $('#letra').val('');

                    $("#palavraC").off("click");

                    $("#letraC").off("click");

                    $('#modal').addClass('mostrar');

                    gameOver = 0;

                    var bt = document.getElementById('btmodal');

                    bt.setAttribute("value", 'Ver Ranking');

                    $('#btmodal').click(function() {
                        pxFase();
                    });
                }
            }

        } else {

            $('#msg').html('Game Over!!!');

            $("#palavraC").off('click');

            $("#letraC").off('click');

            document.getElementById('boenco').src = '../img/erro' + 6 + '.png';

            $('#modal').addClass('mostrar');

            var bt = document.getElementById('btmodal');

            bt.setAttribute("value", 'Ver Ranking');

            $('#btmodal').click(function() {
                fimdejogo();
            });
        }
    }
}

function palavra() {
    palavraIn = array_palavras[numeros[indice]];
    resultado = palavraIn.split("");
}

function chuteLetra() {

    var letraT = $('#letra').val();

    if (letraT != "") {

        letraT = letraT.toLocaleLowerCase();
        var i = resultado.indexOf(letraT);
        var erro = '&nbsp;';

        if (i == -1) {

            var vetor = letraErrada.indexOf(letraT);

            if (vetor == -1) {

                var tamanho = letraErrada.length;

                letraErrada[tamanho] = letraT;

                var erro = document.getElementById('erro').innerHTML;

                if (erro.indexOf(letraT) == -1) {

                    letraT = letraT.toLocaleUpperCase();

                    document.getElementById('erro').innerHTML = erro + '&nbsp;' + letraT;
                    numErros++;
                    document.getElementById('boenco').src = '../img/erro' + numErros + '.png';

                    pont = pont - (nivel * 10);

                    document.getElementById('pont').innerHTML = pont;

                    if (numErros == 6) {
                        $('#msg').html('Game Over!!!');

                        $('#letra').val('');

                        $("#palavraC").off("click");

                        $("#letraC").off("click");

                        $('#modal').addClass('mostrar');

                        gameOver = 1;

                        var bt = document.getElementById('btmodal');

                        bt.setAttribute("value", 'Ver Ranking');

                        $('#btmodal').click(function() {
                            fimdejogo();
                        });
                    }
                }
            }

        } else {

            if (letraT != '-' && letraT != " ") {

                var vetor = letraCerta.indexOf(letraT);

                if (vetor == -1) {

                    var tamanho = letraCerta.length;

                    letraCerta[tamanho] = letraT;

                    var i = 0;
                    var e = 0;

                    while (e != null) {
                        e = document.getElementsByClassName(letraT)[i].innerHTML = letraT + '&nbsp;';
                        i++;
                        e = document.getElementsByClassName(letraT)[i];

                        pont = pont + (15 * nivel);

                        document.getElementById('pont').innerHTML = pont;

                    }
                }
            }
        }

        document.getElementById('letra').value = '';

        var pal = document.getElementById('letter').textContent;

        pal = pal.replace(/\s/g, '');

        var quantos = array_palavras.length;

        var index = 0;

        var ind = indice;

        if (ind != quantos) {
            index = ind;
        } else {
            ind--;
            index = ind;
        }

        var pal1 = array_palavras[numeros[index]];


        if (pal == pal1) {


            if (quantos > indice) {

                console.log("acertos: " + acertos);
                console.log("Max: " + numAcertos);

                if (acertos < numAcertos) {

                    letraCerta = null;
                    letraCerta = [];

                    letraErrada = null;
                    letraErrada = [];

                    $('#modal').addClass('mostrar');

                    $('#msg').html('Parabéns! Você acertou a palavra.');

                    var bt = document.getElementById('btmodal');

                    bt.setAttribute("value", 'Próxima Palavra');

                    pont = pont + (75 * nivel);

                    document.getElementById('pont').innerHTML = pont;

                    $('#btmodal').click(function() {

                        novaPalavra();

                        document.getElementById('letra').focus();

                        $('#modal').removeClass('mostrar');

                        console.log("acertos: " + acertos);

                    });

                } else {
                    if (nivel != 6) {
                        $('#modal').addClass('mostrar');

                        $('#msg').html('Nível Completo!');

                        var bt = document.getElementById('btmodal');

                        gameOver = 0;

                        bt.setAttribute("value", 'Próximo nível!');

                        $('#btmodal').click(function() {

                            pxFase();

                            $('#modal').removeClass('mostrar');
                        });
                    } else {
                        $('#msg').html('Parabéns, você completou o jogo!!!');

                        $('#letra').val('');

                        $("#palavraC").off("click");

                        $("#letraC").off("click");

                        $('#modal').addClass('mostrar');

                        gameOver = 0;

                        var bt = document.getElementById('btmodal');

                        bt.setAttribute("value", 'Ver Ranking');

                        $('#btmodal').click(function() {
                            pxFase();
                        });
                    }
                }

            } else {

                $('#modal').addClass('mostrar');

                $('#msg').html('Nível Completo!.');

                var bt = document.getElementById('btmodal');

                gameOver = 0;

                bt.setAttribute("value", 'Próxim nível!');

                $('#btmodal').click(function() {

                    pxFase();

                    $('#modal').removeClass('mostrar');
                });


            }

        }
    }
}


function teclado(letra) {

    var letraT = letra;

    if (letraT != "") {

        letraT = letraT.toLocaleLowerCase();
        var i = resultado.indexOf(letraT);
        var erro = '&nbsp;';

        if (i == -1) {

            var vetor = letraErrada.indexOf(letraT);

            if (vetor == -1) {

                var tamanho = letraErrada.length;

                letraErrada[tamanho] = letraT;

                var erro = document.getElementById('erro').innerHTML;

                if (erro.indexOf(letraT) == -1) {

                    letraT = letraT.toLocaleUpperCase();

                    document.getElementById('erro').innerHTML = erro + '&nbsp;' + letraT;
                    numErros++;
                    document.getElementById('boenco').src = '../img/erro' + numErros + '.png';

                    pont = pont - (nivel * 10);

                    document.getElementById('pont').innerHTML = pont;

                    if (numErros == 6) {
                        $('#msg').html('Game Over!!!');

                        $('#letra').val('');

                        $("#palavraC").off("click");

                        $("#letraC").off("click");

                        $('#modal').addClass('mostrar');

                        gameOver = 1;

                        var bt = document.getElementById('btmodal');

                        bt.setAttribute("value", 'Ver Ranking');

                        $('#btmodal').click(function() {
                            fimdejogo();
                        });
                    }
                }
            }

        } else {

            if (letraT != '-' && letraT != " ") {

                var vetor = letraCerta.indexOf(letraT);

                if (vetor == -1) {

                    var tamanho = letraCerta.length;

                    letraCerta[tamanho] = letraT;

                    var i = 0;
                    var e = 0;

                    while (e != null) {
                        e = document.getElementsByClassName(letraT)[i].innerHTML = letraT + '&nbsp;';
                        i++;
                        e = document.getElementsByClassName(letraT)[i];

                        pont = pont + (15 * nivel);

                        document.getElementById('pont').innerHTML = pont;

                    }
                }
            }
        }

        document.getElementById('letra').value = '';

        var pal = document.getElementById('letter').textContent;

        pal = pal.replace(/\s/g, '');

        var quantos = array_palavras.length;

        var index = 0;

        var ind = indice;

        if (ind != quantos) {
            index = ind;
        } else {
            ind--;
            index = ind;
        }

        var pal1 = array_palavras[numeros[index]];


        if (pal == pal1) {


            if (quantos > indice) {

                console.log("acertos: " + acertos);
                console.log("Max: " + numAcertos);

                if (acertos < numAcertos) {

                    letraCerta = null;
                    letraCerta = [];

                    letraErrada = null;
                    letraErrada = [];

                    $('#modal').addClass('mostrar');

                    $('#msg').html('Parabéns! Você acertou a palavra.');

                    var bt = document.getElementById('btmodal');

                    bt.setAttribute("value", 'Próxima Palavra');

                    pont = pont + (75 * nivel);

                    document.getElementById('pont').innerHTML = pont;

                    $('#btmodal').click(function() {

                        novaPalavra();

                        document.getElementById('letra').focus();

                        $('#modal').removeClass('mostrar');

                        console.log("acertos: " + acertos);

                    });

                } else {
                    if (nivel != 6) {
                        $('#modal').addClass('mostrar');

                        $('#msg').html('Nível Completo!');

                        var bt = document.getElementById('btmodal');

                        gameOver = 0;

                        bt.setAttribute("value", 'Próximo nível!');

                        $('#btmodal').click(function() {

                            pxFase();

                            $('#modal').removeClass('mostrar');
                        });
                    } else {
                        $('#msg').html('Parabéns, você completou o jogo!!!');

                        $('#letra').val('');

                        $("#palavraC").off("click");

                        $("#letraC").off("click");

                        $('#modal').addClass('mostrar');

                        gameOver = 0;

                        var bt = document.getElementById('btmodal');

                        bt.setAttribute("value", 'Ver Ranking');

                        $('#btmodal').click(function() {
                            pxFase();
                        });
                    }
                }

            } else {

                $('#modal').addClass('mostrar');

                $('#msg').html('Nível Completo!.');

                var bt = document.getElementById('btmodal');

                gameOver = 0;

                bt.setAttribute("value", 'Próxim nível!');

                $('#btmodal').click(function() {

                    pxFase();

                    $('#modal').removeClass('mostrar');
                });


            }

        }
    }
}



function tela() {

    //var i = indice;

    numero_aleatorio();

    dica();

    palavra();

    letras();


}

function limpaTela() {

    $('#letter').empty();
    document.getElementById('boenco').src = '../img/erro0.png';
    numErros = 0;
    document.getElementById('erro').innerHTML = '&nbsp;';
    document.getElementById('dica').innerHTML = 'Dica: ';
}

function novaPalavra() {

    var quantos = array_palavras.length;


    if (indice < quantos) {

        indice++;

        console.log('indice arrays: ' + indice);

        limpaTela();

        dica();

        palavra();

        letras();

        if ((indice + 1) == quantos) {
            indice++;
        }

        acertos++;

    }
}

function fimdejogo() {

    var pontuacao = document.getElementById('pont');

    var pont1 = pontuacao.textContent;

    pont1 = parseInt(pont1, 10);

    console.log(pont1);

    //alert(array_id[numeros[indice]]);

    if (pont1 != 0) {

        $.ajax({
            method: "GET",
            url: "../mediadores/gameOver.php",
            data: {
                pont: pont1,
                id_palavra: array_id[numeros[indice]]
            },
            success: function(data) {
                console.log('sucesso na volta de dados');
            }
        })
    }

    window.location.href = "../telas/ranking.php";

}

function pxFase() {

    nivel++;

    var pontuacao = document.getElementById('pont');

    var pont1 = pontuacao.textContent;

    pont1 = parseInt(pont1, 10);

    console.log(pont1);

    console.log(gameOver);

    if (pont1 != 0) {

        $.ajax({
            method: "GET",
            url: "../mediadores/gameOver.php",
            data: {
                pont: pont1,
                gameOver: gameOver,
                nivel: nivel
            },
            success: function(data) {
                console.log('sucesso na volta de dados');
            }
        })
    }

    window.location.href = "../telas/escolhaDificuldade.php";
}

$(document).ready(function() {

    tela();

    $('#palavraC').click(function() {
        chutePalavra();
        document.getElementById('letra').focus();
    });
    $('#letraC').click(function() {
        chuteLetra();
        document.getElementById('letra').focus();
    });
    $('#next').click(novaPalavra);

});

$(document).keypress(function(e) {
    if (e.which == 13) $('#letraC').click();
});
