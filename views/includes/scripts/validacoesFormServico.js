//datas mínima é o dia de amanhã os elementos possuem a class data_input e a mensagem de erro tem o id erroDataMinima
//e os input inválidos devem ser marcaos com a classe isInvalid
function validarData(){
    console.log("fui chamado");
    const datas = document.querySelectorAll(".data_input");
    const dataAtual = new Date();
    const msgErro = document.getElementById("erroDataMinima");

    let possuiErro = false;

    datas.forEach(data => {
        const dataServico = new Date(data.value);

        if(dataServico < dataAtual){
            possuiErro = true;
            data.classList.add("isInvalid");
        }else{
            data.classList.remove("isInvalid");
        }
    });

    if(possuiErro){
        msgErro.style.display = "block";
    }else{
        msgErro.style.display = "none";
    }
}