const formNewUser = document.getElementById("form-new-user");
if(formNewUser){
    formNewUser.addEventListener("submit", async(e) =>{

        // document.getElementById("msg").innerHTML = "<p style='color: #0f0;'>Usuário cadastrado com sucesso!</p>";

        //Recebe o valor do campo 
        var name = document.querySelector('#name').value;
        if(name === ""){
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Nome</p>";
            
            return;
        }
        //Recebe o valor do campo 
        var email = document.querySelector('#email').value;
        if(email === ""){
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo E-mail!</p>";
            
            return;
        }
        //Recebe o valor do campo 
        var password = document.querySelector('#password').value;
        if(password === ""){
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Senha!</p>";
            
            return;
        }

    })

}

const formLogin = document.getElementById("form-login"); 
if(formLogin){
    formLogin.addEventListener("submit", async(e) => {
        // e.preventDefault();

        // document.getElementById("msg").innerHTML = "<p style='color: #0f0;'>Acessou: Validar form login</p>";
        //Recebe o valor do campo 
        var user = document.querySelector('#user').value;
        if(user === ""){
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Usuário!</p>";
            
            return;
        }
        //Recebe o valor do campo 
        var password = document.querySelector('#password').value;
        if(password === ""){
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #f00;'>Necessário preencher campo Senha!</p>";
            
            return;
        }
    })

}