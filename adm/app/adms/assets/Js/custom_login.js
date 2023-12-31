// window.alert ("carregou");
//Permitir o retorno do navegador aoformulário após erro
if(window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
} 

function passwordEmpty(){
    var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Senha!</p>";

            return;
        }
}
//Calcular a forca da senha
function passwordStrength(){
    var password = document.getElementById("password").value;
    console.log(password);
    var strength = 0;

    if((password.length >= 6) && (password.length <= 7)){
        strength += 10;
    }else if(password.length > 7){
        strength += 25;
    }
    if((password.length >= 6) && (password.match(/[a-z]+/))){
        strength += 10;
    }
    if((password.length >= 7) && (password.match(/[A-Z]+/))){
        strength += 20;
    }
    if((password.length >= 8) && (password.match(/[@#$%;*]+/))){
        strength += 25;
    }
    if(password.match(/[1-9]+\1{1,}/)){
        strength -= 25;
    }

    viewStrength(strength);
}
function viewStrength(strength){
    if(strength < 30){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-danger'>Senha Fraca!</p>";
    }else if((strength >= 30) && (strength < 50)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-info'>Senha Média!</p>";
    }else if((strength >= 50) && (strength < 70)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-warning'>Senha Boa!</p>";
    }else if(strength >= 70){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-success'>Senha Forte!</p>";
    }else{
        document.getElementById("msg").innerHTML = "<p></p>";
        return
    }
}

const formNewUser = document.getElementById("form-new-user");
if (formNewUser) {
    formNewUser.addEventListener("submit", async (e) => {
        
        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nome</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Senha!</p>";

            return;
        }
        //Verifica se o campo SENHA possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A Senha deve conter (NO MÍNIMO) 6 caracteres!</p>";

            return;
        }

        //Verifica se o campo SENHA não possui núeros repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A Senha não deve ter números repetidos!</p>";

            return;
        }

        //Verifica se o campo SENHA possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A Senha deve conter pelo menos uma letra!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }

    })

}

const formLogin = document.getElementById("form-login");
if (formLogin) {
    formLogin.addEventListener("submit", async (e) => {

        //Recebe o valor do campo USER
        var user = document.querySelector('#user').value;
        if (user === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Usuário!</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Senha!</p>";

            return;
        }
        else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }

    })

}

const formNewConfEmail = document.getElementById("form-new-conf-email");
if (formNewConfEmail) {
    formNewConfEmail.addEventListener("submit", async (e) => {
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo E-mail!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })
}


const formRecoverPass = document.getElementById("form-recover-pass");
if (formRecoverPass) {
    formRecoverPass.addEventListener("submit", async (e) => {
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo E-mail!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    }
    )
}

const formUpdatePass = document.getElementById("form-update-pass");
if (formUpdatePass) {
    formUpdatePass.addEventListener("submit", async (e) => {
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#password').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Senha!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    }
    )
}
