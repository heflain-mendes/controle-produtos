function validarSenha() {
    const senha = document.getElementById("floatingPassword");
    const confirmarSenha = document.getElementById("floatingCPassword");
    const erroSenha = document.getElementById("erroSenha");

    if (senha.value == confirmarSenha.value){
        erroSenha.style.display = "none";
        confirmarSenha.setCustomValidity("");
    }else{
        erroSenha.style.display = "block";
        confirmarSenha.setCustomValidity("A senha e confirmação de senha são diferentes.");
    }
}

function validarCPF(inputField) {
    inputField.value = inputField.value.replace(/[^0-9]/g, '');

    if (inputField.value.length < 11) {
        inputField.setCustomValidity("O CPF deve ter exatamente 11 dígitos.");
    } else if (inputField.value.length > 11) {
        inputField.setCustomValidity("O CPF deve ter exatamente 11 dígitos.");
    } else {
        inputField.setCustomValidity(""); // Limpa a mensagem de erro
    }
}

function validarTelefone(inputField) {
     inputField.value = inputField.value.replace(/[^0-9]/g, '');

     const minLength = 10; 
     const maxLength = 11; 

     if (inputField.value.length < minLength) {
         inputField.setCustomValidity(`O número de telefone deve ter pelo menos ${minLength} dígitos.`);
     } else if (inputField.value.length > maxLength) {
         inputField.setCustomValidity(`O número de telefone deve ter no máximo ${maxLength} dígitos.`);
     } else {
         inputField.setCustomValidity("");
     }
}

function validarDataNascimento(){
    const formDtNasc = document.querySelector("#floatingInputDtNasc");
    const dataNasc = new Date(formDtNasc.value);
    const dataAtual = new Date();
    const msgErro = document.querySelector("#erroDtNasc");

    let idade = dataAtual.getFullYear() - dataNasc.getFullYear();
    const mes = dataAtual.getMonth() - dataNasc.getMonth();
    const dia = dataAtual.getDate() - dataNasc.getDate();

    if (mes < 0 || (mes === 0 && dia < 0)) {
        idade--;
    }

    if(idade < 18){
        formDtNasc.setCustomValidity("O usuário precisa ter 18 ou mais anos.");
        msgErro.style.display = "block";
    }else{
        formDtNasc.setCustomValidity("");
        msgErro.style.display = "none";
    }
}

