const menu = document.getElementById("menu");
const cancel = document.getElementById("x");
const search = document.getElementById("search");
const textLogo = document.querySelector(".textLogo");
const selectSearch = document.querySelector(".selectSearch");
const navbar = document.querySelector(".logo nav");
const log = document.querySelector(".log-icons");
const iconsLogin = document.querySelector(".LoginSigup");
const dropdown = document.querySelector(".selectDropDown");
const activeDropDown = document.querySelector(".activeDropDown");
const replies = document.querySelectorAll(".replies");
const forms = document.querySelectorAll(".form-action");
const slider = document.querySelectorAll(".slider");
const resultComents = document.querySelectorAll(".result-coment");
const balasKomentars = document.querySelectorAll(".balas-coment");

let number = 0;

//cek status apakah true atau bukan
function cekStatus(element, calback) {
    if (element) {
        calback(element);
    }
}

function inset(element, index) {
    if (element) {
        element.classList.toggle(index);
    }
}

function delet(element, index) {
    if (element) {
        element.classList.remove(index);
    }
}

if (textLogo) {
    textLogo.addEventListener("click", () => {
        window.location = "/";
    });
}

cekStatus(cancel, (element) => {
    element.addEventListener("click", () => {
        delet(selectSearch, "block");
    });
});

cekStatus(menu, (element) => {
    element.addEventListener("click", () => {
        inset(menu, "fa-xmark");
        inset(navbar, "geser");
        delet(iconsLogin, "geser");
        delet(selectSearch, "block");
    });
});

cekStatus(log, (element) => {
    element.addEventListener("click", () => {
        delet(menu, "fa-xmark");
        delet(navbar, "geser");
        inset(iconsLogin, "geser");
        delet(selectSearch, "block");
    });
});

cekStatus(dropdown, (element) => {
    element.addEventListener("click", () => {
        inset(activeDropDown, "active");
    });
});

cekStatus(search, (element) => {
    element.addEventListener("click", () => {
        delet(menu, "fa-xmark");
        delet(navbar, "geser");
        delet(iconsLogin, "geser");
        inset(selectSearch, "block");
        document.getElementById("mencari").focus();
    });
});

cekStatus(slider, (element) => {
    function slide() {
        let offset = number * -100;
        element.forEach((item) => {
            item.style.transform = `translateX(${offset}%)`;
        });
    }

    function nextSlider() {
        number = (number + 1) % slider.length;
        slide();
    }

    setInterval(nextSlider, 5000);
});

cekStatus(replies, (element) => {
    for (let index = 0; index < element.length; index++) {
        element[index].addEventListener("click", () => {
            forms[index].classList.toggle("block");
        });
    }
});

window.onscroll = () => {
    delet(menu, "fa-xmark");
    delet(navbar, "geser");
    delet(activeDropDown, "active");
    if (dropdown) {
        dropdown.blur();
    }
};

// const seeMoreLinks = document.querySelectorAll(".see-more");

// seeMoreLinks.forEach((link) => {
//     link.addEventListener("click", function (e) {
//         e.preventDefault();
//         const siblingDiv = this.nextElementSibling;

//         if (siblingDiv) {
//             siblingDiv.style.display =
//                 siblingDiv.style.display === "block" ? "none" : "block";
//         }
//     });
// });

// Mengambil semua elemen dengan kelas "see-more"
const seeMoreLinks = document.querySelectorAll(".see-more");

// Menangani klik pada tautan "Lihat Selengkapnya"
seeMoreLinks.forEach((link) => {
    link.addEventListener("click", function () {
        const parend = link.parentNode;
        see_more(link);
        if (parend) {
            // Mengubah tampilan semua elemen "has-cild" yang ada
            const has = parend.querySelectorAll(".has-cild");
            has.forEach((hasCild) => {
                hasCild.style.display =
                    hasCild.style.display === "block" ? "none" : "block";
                const seeMoreCild = hasCild.querySelectorAll(".see-more-cild");
                seeMoreCild.forEach((cild) => {
                    cild.addEventListener("click", () => {
                        const parendCild = cild.parentNode;
                        see_more(cild);
                        if (parendCild) {
                            const cildAndCild =
                                parendCild.querySelectorAll(".cild");
                            cildAndCild.forEach((elementCild) => {
                                elementCild.style.display =
                                    elementCild.style.display === "block"
                                        ? "none"
                                        : "block";
                            });
                        }
                    });
                });
            });
        }
    });
});

//aksi untuk funsi lihat selengkapnya
function see_more(action) {
    if (action.style.display === "none" || action.style.display === "") {
        action.style.display = "block";
        action.textContent = "Sembunyikan";
    } else {
        action.textContent = "Lihat Selengkapnya";
        action.style.display = "";
    }
}

//function untuk menghapus notifikasi
function hideElementAfterDelay(element, delay) {
    setTimeout(function () {
        element.style.display = "none";
    }, delay);
}

// Mencari elemen dengan kelas "container-flash"
var containerFlashElements = document.querySelectorAll(".container-flash");

// Loop melalui semua elemen "container-flash"
containerFlashElements.forEach(function (element) {
    // Periksa apakah elemen ini harus dihapus
    if (element) {
        hideElementAfterDelay(element, 5000); // Menghilangkan elemen setelah 5 detik
    }
});
