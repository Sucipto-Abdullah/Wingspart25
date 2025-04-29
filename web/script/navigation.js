window.addEventListener("load", screen_display);
window.addEventListener("resize", screen_display);

function screen_display(){
}

function submenu_open(value){
    const sub_notification = document.querySelector(".sub-notification");
    // const sub_profile = document.querySelector(".sub-profile");
    
    if(value == "notification"){
        sub_notification.classList.toggle("open");
    }else if(value == "profile"){

    }
}