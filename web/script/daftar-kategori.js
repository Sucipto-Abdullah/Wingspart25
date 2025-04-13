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

let tampilan_kategori_array = [];

for(let i=0; i<kategori_array.length; i++){
    tampilan_kategori_array.push(show_category(kategori_array[i]));
}

daftar_kategori.innerHTML = tampilan_kategori_array;