document.querySelector(".wingspart25-logo").innerHTML = "<img src='icon/WingPart25 logo replica.svg' alt='Wingspart25'>";
document.querySelector(".search-btn").innerHTML = "<img src='icon/search-con.svg'>";

const notification_btn = document.querySelector(".notification-btn");
const sub_notif = document.getElementById("sub-notification");

window.addEventListener("load", screenDisplay);
window.addEventListener("resize", screenDisplay);

function screenDisplay(){
    const notification_btn_pos = notification_btn.getBoundingClientRect();
    sub_notif.style.left = `${notification_btn_pos.x - 150}px`;
}

function popup_menu(value){
    if(value == "notification"){
        const menu_notification = document.querySelector(".sub-notification");
        menu_notification.classList.toggle("open");
    }
}