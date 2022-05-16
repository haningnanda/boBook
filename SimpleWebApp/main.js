
const books = [
    {
    "judul": "Untuk Apa Seni",
    "primer": {
        "url-foto": "https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1392706216l/20837627.jpg",
        "harga": 60000
    },
    "deskripsi": {
        "penulis": "Bambang Sugiharto, dkk",
        "penerbit": "Pustaka Matahari",
        "penyunting": "Bambang Sugiharto"
    }
    },
    {
    "judul": "Warisan Sejarah Arianisme",
    "primer": {
        "url-foto": "https://pustaka.iainbukittinggi.ac.id/wp-content/uploads/2018/12/arian-198x300.jpg",
        "harga": 97000
    },
    "deskripsi": {
        "judul-asli": "Archetypal Heresy: Arianism Through the Centuries",
        "penulis": "Maurice Wiles",
        "penerjemah": "Zaenal Muttaqin",
        "penerbit": "Pustaka Matahari",
        "penerbit-asli": "Oxford University Press, Inc."
    }
    },
    {
    "judul": "Sejarah Filsafat Kontemporer: Jerman dan Inggris",
    "primer": {
        "url-foto": "https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1551165807l/4309628._SX318_.jpg",
        "harga": 70000
    },
    "deskripsi": {
        "penulis": "K. Bertens",
        "penerbit": "PT Gramedia Pustaka Utama"
    }
    },
    {
    "judul": "Sejarah Filsafat Kontemporer: Prancis",
    "primer": {
        "url-foto": "https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1243418656l/6498943.jpg",
        "harga": 63000
    },
    "deskripsi": {
        "penulis": "K. Bertens",
        "penerbit": "PT Gramedia Pustaka Utama"
    }
    },
    {
    "judul": "Semiotika dan Hipersemiotika",
    "primer": {
        "url-foto": "https://s2.bukalapak.com/img/7734600261/large/IMG_20170912_134621_scaled.jpg",
        "harga": 120000
    },
    "deskripsi": {
        "penulis": "Yasraf Amir Piliang",
        "penerbit": "Pustaka Matahari"
    }
    },
    {
    "judul": "Epistemologi Dasar",
    "primer": {
        "url-foto": "https://togamas.com/css/images/items/potrait/JPEGG_5905_Epistemologi_Dasar.jpg",
        "harga": 60000
    },
    "deskripsi": {
        "penulis": "J. Sudarminta",
        "penerbit": "Penerbit Kanisius"
    }
    },
    {
    "judul": "Teori-Teori Etika",
    "primer": {
        "url-foto": "https://s2.bukalapak.com/img/2027491742/large/Buku_Teori_Teori_Etika_karya_Gordon_Graham.jpg",
        "harga": 96000
    },
    "deskripsi": {
        "penulis": "Nusamedia",
        "penerbit": "Gordon Graham"
    }
    }
];

document.getElementById("container").innerHTML = `
${books.map(function(book, idx){
    return `
    <button class="item" onclick="desc(${idx})">
    <div class="book">
        <img class="book-foto" src=${book.primer["url-foto"]}>
        <h2>${book.judul}</h2>
        <h3>IDR ${book.primer.harga}</h3>
        </div>
    </button>
    `
}).join('')}
`

function desc(idx){
    var modal = document.getElementById("modal");
    modal.style.display = "block";
    var close = document.getElementsByClassName("close")[0];
    close.onclick = function() {
    modal.style.display = "none";
    }
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
    var x ="", i;
    for (i=0; i<Object.keys(books[idx].deskripsi).length; i++) {
    x = x + "<p>" + Object.getOwnPropertyNames(books[idx].deskripsi)[i]+": "+ Object.values(books[idx].deskripsi)[i]+"<p>";
    }
    document.getElementById("isi").innerHTML=`
    <div class="book">
        <h2>${books[idx].judul}</h2>
        <img class="book-foto" src=${books[idx].primer["url-foto"]}>
        <h3>Harga: IDR ${books[idx].primer.harga}</h3>
        <h3>Deskripsi</h3>
        ${x}
        <form action="" method="get">
            <input type="hidden" name="idproduk" value="${idx}">
            <input type="number" style="padding: 10px;" min="1" max="9" value="1" name="submit_jml">
            <button class="cart">Tambah ke Keranjang</button>
        </form>
    </div>`
}


