// window.alert ("carregou");
const formNewUser = document.getElementById("form-new-user");
if (formNewUser) {
    formNewUser.addEventListener("submit", async (e) => {

        // document.getElementById("msg").innerHTML = "<p style='color: #0f0;'>Usuário cadastrado com sucesso!</p>";

        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Nome</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Senha!</p>";

            return;
        }
        //Verifica se o campo SENHA possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: A Senha deve conter (NO MÍNIMO) 6 caracteres!</p>";

            return;
        }

        //Verifica se o campo SENHA não possui núeros repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: A Senha não deve ter números repetidos!</p>";

            return;
        }

        //Verifica se o campo SENHA possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Erro: A Senha deve conter pelo menos uma letra!</p>";

            return;
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

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Usuário!</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Senha!</p>";

            return;
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

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo E-mail!</p>";

            return;
        }
    }
    )
}


const formRecoverPass = document.getElementById("form-recover-pass");
if (formRecoverPass) {
    formRecoverPass.addEventListener("submit", async (e) => {
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo E-mail!</p>";

            return;
        }
    }
    )
}