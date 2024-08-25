function validarSenha() {
    const senha = document.getElementById("floatingPassword");
    const confirmarSenha = document.getElementById("floatingCPassword");
    const erroSenha = document.getElementById("erroSenha");

    if (senha.value == confirmarSenha.value){
        erroSenha.style.display = "none";
        confirmarSenha.classList.remove("isInvalid");
    }else{
        erroSenha.style.display = "block";
        confirmarSenha.classList.add("isInvalid");
    }
}

function validarDataNascimento(){
    const formDtNasc = document.querySelector("#floatingInputDtNasc");
    const dataNasc = new Date(formDtNasc.value);
    const dataAtual = new Date();
    const msgErro = document.querySelector("#erroDtNasc");

    // Calcula a diferença em anos
    let idade = dataAtual.getFullYear() - dataNasc.getFullYear();
    const mes = dataAtual.getMonth() - dataNasc.getMonth();
    const dia = dataAtual.getDate() - dataNasc.getDate();

    // Ajusta a idade se ainda não tiver feito aniversário este ano
    if (mes < 0 || (mes === 0 && dia < 0)) {
        idade--;
    }

    // Retorna true se a idade for 18 ou mais, caso contrário, retorna false
    if(idade < 18){
        formDtNasc.classList.add("isInvalid");
        msgErro.style.display = "block";
    }else{
        formDtNasc.classList.remove("isInvalid");
        msgErro.style.display = "none";
    }
}

function validarSubmit() {
    camposInvalid = document.querySelectorAll(".isInvalid");

    return camposInvalid.length == 0;
}