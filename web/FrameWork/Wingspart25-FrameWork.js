document.querySelector(".wingspart25-logo").innerHTML = "<img src='icon/WingPart25 logo replica.svg' alt='Wingspart25'>";
document.querySelector(".search-btn").innerHTML = "<img src='icon/search-con.svg'>";

const notification_btn = document.querySelector(".notification-btn");
const sub_notif = document.getElementById("sub-notification");

const profile_btn = document.querySelector(".profile-btn");
const profile_menu_id = document.getElementById("profile-menu");

window.addEventListener("load", screenDisplay);
window.addEventListener("resize", screenDisplay);

function screenDisplay(){
    const notification_btn_pos = notification_btn.getBoundingClientRect();
    sub_notif.style.left = `${notification_btn_pos.x - 150}px`;

    const profile_btn_pos = profile_btn.getBoundingClientRect();
    profile_menu_id.style.left = `${profile_btn_pos.x - 60}px`;
}

function popup_menu(value){
    const menu_notification = document.querySelector(".sub-notification");
    const menu_profile = document.querySelector(".profile-menu");
    if(value == "notification"){
        menu_notification.classList.toggle("open");
        if(menu_profile.classList.contains("open")){
            menu_profile.classList.toggle("open");
        }
    }else if(value == "profile"){
        menu_profile.classList.toggle("open");
        if(menu_notification.classList.contains("open")){
            menu_notification.classList.toggle("open");
        }
    }
    if(menu_profile.classList.contains("open") || menu_notification.classList.contains("open")){
        document.querySelector("body").style.overflow = 'hidden';
    }
}

// function scroll(value){
//     let category_list = document.getElementById("category");
//     const category_object = document.querySelector(".category-object");
//     if(value == "left"){
//         category_list.scroll({left : -200});
//     }
//     else if(value == "right"){
//         category_list.scrollBy({left : 200});
//     }
// }