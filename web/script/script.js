let username = "sucipto";
let email = "ciptoabdul23@gmail.com";
let password = "cipto";

const username_input = document.getElementById("username_input");
const password_input = document.getElementById("password_input");
const login_button = document.getElementById("login_button");
const login_submit = document.getElementById("login_submit");
  
// login_button.onclick = function(){
//     console.log("nigga");
//     if((username_input.value == username || username_input.value == email) && password_input.value == password){
//         login_submit.href = "main menu.html";
//     }
//     else{
//         username_input.value = "";
//         password_input.value = "";
//         username_input.style = "border-color: red;";
//         password_input.style = "border-color: red;";
//         console.log("hallo");
//     }
// }

// const create_submit = document.getElementById("submit_button_create");
// const create_account_submit = document.getElementById("create_account_button");
// const new_username = document.getElementById("Username_create_input");
// const new_email = document.getElementById("Email_create_input");
// const new_password = document.getElementById("Password_create_input");
// const new_vertivy_password = document.getElementById("vertivy_password_create_input");
// const new_alamat = document.getElementById("Alamat_create_input");

// create_submit.onclick = function(){
//     console.log("nigga");
//     if(new_username.value && new_email.value && (new_password.value == new_vertivy_password.value) && new_alamat.value){
//         create_account_submit.href = "main menu.html";
//     }
//     else{
//         new_username.style = "border-color: red;";
//         new_email.style = "border-color: red;";
//         new_password.style = "border-color: red;";
//         new_vertivy_password.style = "border-color: red;";
//         new_alamat.style = "border-color: red;";
//         console.log("hallo");
//     }
// }

let notification_show = false;
let profile_show = false;

const profile_menu = document.getElementById("profile-menu");
const notification_menu = document.getElementById("notification-menu");

function showNotification(){
    if(!notification_show){
        notification_menu.style.display = 'block';
        profile_menu.style.display = 'none';
        notification_show = true;
        profile_show = false;
    }else{
        notification_menu.style.display = 'none';
        notification_show = false;
    }
}
function showProfile(){
    if(!profile_show){
        profile_menu.style.display = 'block';
        notification_menu.style.display = 'none';
        profile_show = true;
        notification_show = false;
    }else{
        profile_menu.style.display = 'none';
        profile_show = false;
    }
}