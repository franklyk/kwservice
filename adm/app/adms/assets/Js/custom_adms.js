// window.alert ("carregou");
//Permitir o retorno do navegador ao formulário após erro
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
    // console.log(password);
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
        document.getElementById("msgViewStrength").innerHTML = "<<p class='alert-seccess'>Senha Forte!</p>";
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

const formAddUser = document.getElementById("form-add-user");
if (formAddUser) {
    formAddUser.addEventListener("submit", async (e) => {

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
        //Recebe o valor do campo Usuário
        var user = document.querySelector('#user').value;
        if (user === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Usuário!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var adms_sits_user_id = document.querySelector('#adms_sits_user_id').value;
        if (adms_sits_user_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Situação!</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var adms_access_level_id = document.querySelector('#adms_access_level_id').value;
        if (adms_access_level_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Nível de Acesso!</p>";

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
        }

    })

}
const formEditUser = document.getElementById("form-edit-user");
if (formEditUser) {
    formEditUser.addEventListener("submit", async (e) => {

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
        //Recebe o valor do campo Usuário
        var user = document.querySelector('#user').value;
        if (user === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Usuário!</p>";

            return;
        }
        
        //Recebe o valor do campo Nível
        var adms_access_levels = document.querySelector('#adms_access_levels').value;
        if (adms_access_levels === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nível!</p>";

            return;
        }

        //Recebe o valor do campo Situação
        var adms_sits_user_id = document.querySelector('#adms_sits_user_id').value;
        if (adms_sits_user_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Situação!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}
    
const formEditUserPass = document.getElementById("form-edit-user-pass");
if (formEditUserPass) {
    formEditUserPass.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Senha</p>";

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

const formEditProfile = document.getElementById("form-edit-profile");
if (formEditProfile) {
    formEditProfile.addEventListener("submit", async (e) => {

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
        //Recebe o valor do campo Usuário
        var user = document.querySelector('#user').value;
        if (user === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Usuário!</p>";

            return;
        }
        
        //Recebe o valor do campo Usuário
        var adms_sits_user_id = document.querySelector('#adms_sits_user_id').value;
        if (adms_sits_user_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Situação!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}
const formEditProfPass = document.getElementById("form-edit-prof-pass");
if (formEditProfPass) {
    formEditProfPass.addEventListener("submit", async (e) => {

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


const formEditUserfImg = document.getElementById("form-edit-user-image");
if (formEditUserfImg) {
    formEditUserfImg.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var new_image = document.querySelector('#new_image').value;
        if (new_image === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário selecionar uma imagem</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}

const formEditProfImg = document.getElementById("form-edit-prof-img");
if (formEditProfImg) {
    formEditProfImg.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var new_image = document.querySelector('#new_image').value;
        if (new_image === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário selecionar uma imagem</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}
function inputFileValImg(){
    //Recebe o valor do campo
    var new_image = document.querySelector('#new_image')
    var filePath = new_image.value;
    
    
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(!allowedExtensions.exec(filePath)){

        new_image.value = '';

        document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário selecionar uma imagem JPG ou PNG</p>";
        return;
    }else{
        previewImage(new_image)
        document.getElementById("msg").innerHTML = "<p></p>";
        return
    }
}

function previewImage(new_image){
    if((new_image.files) && (new_image.files[0])){
        //new FileReader() Serve para ler o conteúdo do arquivo
        var reader = new FileReader();
        // onload (Dispara quando qualquer elemento tiver sido carregado)
        reader.onload = function(e){
            document.getElementById('preview-img').innerHTML = "<img src='"+ e.target.result +"' alt='imagem'style='width: 100px;'>"
        }

    }
    // readAsDataUrl - Retorna os dados do formato blob com uma URL de dados - Blob representa um arquivo
    reader.readAsDataURL(new_image.files[0]);
}
const formSitUser = document.getElementById("form-sit-user");
if (formSitUser) {
    formSitUser.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nome</p>";

            return;
        }
        
        
        //Recebe o valor do campo Usuário
        var adms_color_id = document.querySelector('#adms_color_id').value;
        if (adms_color_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Situação!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}
const formColor = document.getElementById("form-color");
if (formColor) {
    formColor.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nome</p>";

            return;
        }
        
        
        //Recebe o valor do campo Usuário
        var color= document.querySelector('#color').value;
        if (color === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Cor!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}

const formGroupsPages = document.getElementById("form-groups-pages");
if (formGroupsPages) {
    formGroupsPages.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nome</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}

const formEditTypesPages = document.getElementById("form-add-types-pages");
if (formEditTypesPages) {
    formEditTypesPages.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nome</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}
const formAddTypesPages = document.getElementById("form-edit-types-pages");
if (formAddTypesPages) {
    formAddTypesPages.addEventListener("submit", async (e) => {

        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nome</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}
const formPages = document.getElementById("form-pages");
if (formPages) {
    formPages.addEventListener("submit", async (e) => {

        
        //Recebe o valor do campo name_page
        var name_page = document.querySelector('#name_page').value;
        if (name_page === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Nome</p>";

            return;
        }
        //Recebe o valor do campo Classe
        var controller = document.querySelector('#controller').value;
        if (controller === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Classe</p>";

            return;
        }
        //Recebe o valor do campo metodo
        var metodo = document.querySelector('#metodo').value;
        if (metodo === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Método</p>";

            return;
        }
        //Recebe o valor do campo Classe do menu
        var menu_controller = document.querySelector('#menu_controller').value;
        if (menu_controller === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Classe do menu</p>";

            return;
        }
        //Recebe o valor do campo menu_metodo
        var menu_metodo = document.querySelector('#menu_metodo').value;
        if (menu_metodo === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Método no menu</p>";

            return;
        }
        
        //Recebe o valor do campo Página Pública
        var publish = document.querySelector('#publish').value;
        if (publish === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Página Pública</p>";

            return;
        }
        //Recebe o valor do campo NAME
        var adms_sits_pgs_id = document.querySelector('#adms_sits_pgs_id').value;
        if (adms_sits_pgs_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Situação da Página</p>";

            return;
        }
        //Recebe o valor do campo NAME
        var adms_groups_pgs_id = document.querySelector('#adms_groups_pgs_id').value;
        if (adms_groups_pgs_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Grupo da Página</p>";

            return;
        }
        //Recebe o valor do campo NAME
        var adms_types_pgs_id = document.querySelector('#adms_types_pgs_id').value;
        if (adms_types_pgs_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Tipo da Página</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
        }
    })

}

const formSitPages = document.getElementById("form-sit-pages");
if (formSitPages) {
    formSitPages.addEventListener("submit", async (e) => {

        //Recebe o valor do campo Nome
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Nome!</p>";

            return;
        }
        
        //Recebe o valor do campo Nome
        var adms_color_id = document.querySelector('#adms_color_id').value;
        if (adms_color_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Cor!</p>";

            return;
        }
    })

}
const formAddConfEmail = document.getElementById("form-add-conf-emails");
if (formAddConfEmail) {
    formAddConfEmail.addEventListener("submit", async (e) => {

        //Recebe o valor do campo Título
        var title = document.querySelector('#title').value;
        if (title === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Título</p>";

            return;
        }
        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Name!</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo Host
        var host = document.querySelector('#host').value;
        if (host === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Host!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var username = document.querySelector('#username').value;
        if (username === "") {
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
        }
        //Recebe o valor do campo Usuário
        var smtpsecure = document.querySelector('#smtpsecure').value;
        if (smtpsecure === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo SMTP!</p>";

            return;
        }
        var port = document.querySelector('#port').value;
        if (port === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Porta!</p>";

            return;
        }

    })

}



const formEditConfEmails = document.getElementById("form-edit-conf-emails");
if (formEditConfEmails) {
    formEditConfEmails.addEventListener("submit", async (e) => {

        //Recebe o valor do campo Título
        var title = document.querySelector('#title').value;
        if (title === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Título</p>";

            return;
        }
        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo Name!</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo Host
        var host = document.querySelector('#host').value;
        if (host === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Host!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var username = document.querySelector('#username').value;
        if (username === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Usuário!</p>";

            return;
        }
        
        //Recebe o valor do campo Usuário
        var smtpsecure = document.querySelector('#smtpsecure').value;
        if (smtpsecure === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo SMTP!</p>";

            return;
        }
        var port = document.querySelector('#port').value;
        if (port === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Porta!</p>";

            return;
        }

    })

}

const formEditConfEmailsPass = document.getElementById("form-edit-conf-email-pass");
if (formEditConfEmailsPass) {
    formEditConfEmailsPass.addEventListener("submit", async (e) => {

        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Senha!</p>";

            return;
        }
    })

}

const formAccessLevels = document.getElementById("form-access-levels");
if (formAccessLevels) {
    formAccessLevels.addEventListener("submit", async (e) => {

        //Recebe o valor do campo SENHA
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Nome!</p>";

            return;
        }
        
        
    })

}

const formItemMenu = document.getElementById("form-item-menu");
if (formItemMenu) {
    formItemMenu.addEventListener("submit", async (e) => {

        //Recebe o valor do campo Nome
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Nome!</p>";

            return;
        }
        
        //Recebe o valor do campo Nome
        var icon = document.querySelector('#icon').value;
        if (icon === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Ícone!</p>";

            return;
        }
    })

}


const formEditPageMenu = document.getElementById("form-edit-page-menu");
if (formEditPageMenu) {
    formEditPageMenu.addEventListener("submit", async (e) => {

        //Recebe o valor do campo Nome
        var adms_items_menu_id = document.querySelector('#adms_items_menu_id').value;
        if (adms_items_menu_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p class=' alert-danger'>Necessário preencher campo Item de Menu!</p>";

            return;
        }
    })

}

/* Inicio Dropdown Navbar */
let notification = document.querySelector(".notification");
let avatar = document.querySelector(".avatar");

dropMenu(avatar);
// dropMenu(notification);

function dropMenu(selector) {
    // console.log(selector);
    selector.addEventListener("click",  () => {
        let dropdownMenu = selector.querySelector(".dropdown-menu");
        dropdownMenu.classList.contains("active") ? dropdownMenu.classList.remove("active") : dropdownMenu.classList.add("active");
    });
}
/* Fim Dropdown Navbar */

/* Inicio Sidebar Toggle / bars */
let sidebar = document.querySelector(".sidebar");
let bars = document.querySelector(".bars");

bars.addEventListener("click", () => {
    sidebar.classList.contains("active") ? sidebar.classList.remove("active") : sidebar.classList.add("active");
});

window.matchMedia("(max-width: 768px)").matches ? sidebar.classList.remove("active") : sidebar.classList.add("active");
/* Fim Sidebar Toggle / bars */

function actionDropdown(id) {
    closeDropdownAction();
    document.getElementById("actionDropdown" + id).classList.toggle("show-dropdown-action");
}

window.onclick = function (event) {
    if (!event.target.matches(".dropdown-btn-action")) {
        /*document.getElementById("actionDropdown").classList.remove("show-dropdown-action");*/
        closeDropdownAction();
    }
}

function closeDropdownAction() {
    var dropdowns = document.getElementsByClassName("dropdown-action-item");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i]
        if (openDropdown.classList.contains("show-dropdown-action")) {
            openDropdown.classList.remove("show-dropdown-action");
        }
    }
}


/* Inicio dropdown sidebar */

var dropdownSidebar = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdownSidebar.length; i++) {
    dropdownSidebar[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}
/* Inicio dropdown sidebar ativo */

var sidebarNav = document.getElementsByClassName("sidebar-nav");

for(var i = 0; i < sidebarNav.length; i++){
    if(sidebarNav[i].classList.contains("active")){
        document.querySelector(".btn-" + sidebarNav[i].classList[1]).classList.add("active");
        document.querySelector(".cont-" + sidebarNav[i].classList[1]).classList.add("active");
    }
}

/* Fim dropdown sidebar ativo */
/* Fim dropdown sidebar */