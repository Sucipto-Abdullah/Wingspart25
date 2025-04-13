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

const daftar_kategori = document.getElementById("daftar-kategori");

class kategori{
    constructor(nama){
        this.nama = nama;
        this.image_locate = `../image/${nama}.png`;
    }
}

function show_category(kategori){
    return`<button id="anggota-kategori" value"#">
                                    <img src="${kategori.image_locate}">
                                    <p>${kategori.nama}</p>
                                    </button>`;
}

const helm = new kategori("Helm");
const spion = new kategori("Spion");
const head_lamp = new kategori("Head lamp");
const knalpot = new kategori("Knalpot");
const disc_motor = new kategori("Disc motor");
const rem = new kategori("Rem");
const motor = new kategori("Motor");

let kategori_array = [];

kategori_array.push(helm);
kategori_array.push(spion);
kategori_array.push(knalpot);
kategori_array.push(head_lamp);
kategori_array.push(disc_motor);
kategori_array.push(rem);
kategori_array.push(motor);

console.log(kategori_array);

let tampilan_kategori_array = [];

for(let i=0; i<kategori_array.length; i++){
    tampilan_kategori_array.push(show_category(kategori_array[i]));
}

daftar_kategori.innerHTML = tampilan_kategori_array;