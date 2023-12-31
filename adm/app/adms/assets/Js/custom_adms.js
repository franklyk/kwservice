// window.alert ("carregou");
//Permitir o retorno do navegador aoformulário após erro
if(window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
} 

function passwordEmpty(){
    var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

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
        document.getElementById("msgViewStrength").innerHTML = "<p style='color:#f00;'>Senha Fraca!</p>";
    }else if((strength >= 30) && (strength < 50)){
        document.getElementById("msgViewStrength").innerHTML = "<p style='color:#ff8c00;'>Senha Média!</p>";
    }else if((strength >= 50) && (strength < 70)){
        document.getElementById("msgViewStrength").innerHTML = "<p style='color:#ffaf01;'>Senha Boa!</p>";
    }else if(strength >= 70){
        document.getElementById("msgViewStrength").innerHTML = "<p style='color:#008000;'>Senha Forte!</p>";
    }else{
        document.getElementById("msg").innerHTML = "<p></p>";
        return
    }
}

const formNewUser = document.getElementById("form-new-user");
if (formNewUser) {
    formNewUser.addEventListener("submit", async (e) => {
        formNewUser.passwordEmpty();
        
        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Nome</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

            return;
        }
        // //Recebe o valor do campo SENHA
        // var password = document.querySelector('#password').value;
        // if (password === "") {
        //     e.preventDefault();

        //     document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

        //     return;
        // }
        //Verifica se o campo SENHA possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter (NO MÍNIMO) 6 caracteres!</p>";

            return;
        }

        //Verifica se o campo SENHA não possui núeros repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha não deve ter números repetidos!</p>";

            return;
        }

        //Verifica se o campo SENHA possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter pelo menos uma letra!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Usuário!</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Nome</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var user = document.querySelector('#user').value;
        if (user === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Usuário!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var adms_sits_user_id = document.querySelector('#adms_sits_user_id').value;
        if (adms_sits_user_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Situação!</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

            return;
        }
        //Verifica se o campo SENHA possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter (NO MÍNIMO) 6 caracteres!</p>";

            return;
        }

        //Verifica se o campo SENHA não possui núeros repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha não deve ter números repetidos!</p>";

            return;
        }

        //Verifica se o campo SENHA possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter pelo menos uma letra!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Nome</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var user = document.querySelector('#user').value;
        if (user === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Usuário!</p>";

            return;
        }
        
        //Recebe o valor do campo Usuário
        var adms_sits_user_id = document.querySelector('#adms_sits_user_id').value;
        if (adms_sits_user_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Situação!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha</p>";

            return;
        }
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

            return;
        }
        //Verifica se o campo SENHA possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter (NO MÍNIMO) 6 caracteres!</p>";

            return;
        }

        //Verifica se o campo SENHA não possui núeros repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha não deve ter números repetidos!</p>";

            return;
        }

        //Verifica se o campo SENHA possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter pelo menos uma letra!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Nome</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var user = document.querySelector('#user').value;
        if (user === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Usuário!</p>";

            return;
        }
        
        //Recebe o valor do campo Usuário
        var adms_sits_user_id = document.querySelector('#adms_sits_user_id').value;
        if (adms_sits_user_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Situação!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

            return;
        }
        //Verifica se o campo SENHA possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter (NO MÍNIMO) 6 caracteres!</p>";

            return;
        }

        //Verifica se o campo SENHA não possui núeros repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha não deve ter números repetidos!</p>";

            return;
        }

        //Verifica se o campo SENHA possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter pelo menos uma letra!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário selecionar uma imagem</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário selecionar uma imagem</p>";

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

        document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário selecionar uma imagem JPG ou PNG</p>";
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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Nome</p>";

            return;
        }
        
        
        //Recebe o valor do campo Usuário
        var adms_color_id = document.querySelector('#adms_color_id').value;
        if (adms_color_id === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Situação!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Nome</p>";

            return;
        }
        
        
        //Recebe o valor do campo Usuário
        var color= document.querySelector('#color').value;
        if (color === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Cor!</p>";

            return;
        }else{
            document.getElementById("msg").innerHTML = "<p></p>";
            return
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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Título</p>";

            return;
        }
        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Name!</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo Host
        var host = document.querySelector('#host').value;
        if (host === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Host!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var username = document.querySelector('#username').value;
        if (username === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Usuário!</p>";

            return;
        }
        
        //Recebe o valor do campo SENHA
        var password = document.querySelector('#password').value;
        if (password === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

            return;
        }
        //Verifica se o campo SENHA possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter (NO MÍNIMO) 6 caracteres!</p>";

            return;
        }

        //Verifica se o campo SENHA não possui núeros repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha não deve ter números repetidos!</p>";

            return;
        }

        //Verifica se o campo SENHA possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Erro: A Senha deve conter pelo menos uma letra!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var smtpsecure = document.querySelector('#smtpsecure').value;
        if (smtpsecure === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo SMTP!</p>";

            return;
        }
        var port = document.querySelector('#port').value;
        if (port === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Porta!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Título</p>";

            return;
        }
        //Recebe o valor do campo NAME
        var name = document.querySelector('#name').value;
        if (name === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Name!</p>";

            return;
        }
        //Recebe o valor do campo E-MAIL
        var email = document.querySelector('#email').value;
        if (email === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo E-mail!</p>";

            return;
        }
        //Recebe o valor do campo Host
        var host = document.querySelector('#host').value;
        if (host === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Host!</p>";

            return;
        }
        //Recebe o valor do campo Usuário
        var username = document.querySelector('#username').value;
        if (username === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Usuário!</p>";

            return;
        }
        
        //Recebe o valor do campo Usuário
        var smtpsecure = document.querySelector('#smtpsecure').value;
        if (smtpsecure === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo SMTP!</p>";

            return;
        }
        var port = document.querySelector('#port').value;
        if (port === "") {
            e.preventDefault();

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Porta!</p>";

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

            document.getElementById("msg").innerHTML = "<p style='color: #640000;'>Necessário preencher campo Senha!</p>";

            return;
        }
    })

}
/* Inicio Dropdown Navbar */
let notification = document.querySelector(".notification");
let avatar = document.querySelector(".avatar");

dropMenu(avatar);
dropMenu(notification);

function dropMenu(selector) {
    //console.log(selector);
    selector.addEventListener("click", () => {
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
/* Fim dropdown sidebar */