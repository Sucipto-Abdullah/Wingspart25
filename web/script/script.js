let username = "sucipto";
let email = "ciptoabdul23@gmail.com";
let password = "cipto";

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