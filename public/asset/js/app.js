const body = document.querySelector('body');
const crypto = document.querySelector('#crypto')
crypto.addEventListener('mouseover', function(e) {
    document.getElementById('ul_crypto').style.display = "block";
    document.getElementById('ul_nft').style.display = "none";
    document.getElementById('ul_metavers').style.display = "none";
    body.addEventListener('click', function() {
        document.getElementById('ul_crypto').style.display = "none";
    })
})
const nft = document.querySelector("#nft")
nft.addEventListener('mouseover', function(e) {
    document.getElementById('ul_nft').style.display = "block";
    document.getElementById('ul_crypto').style.display = "none";
    document.getElementById('ul_metavers').style.display = "none";
    body.addEventListener('click', function() {
        document.getElementById('ul_nft').style.display = "none";
    })
})
const metavers = document.querySelector('#metavers')
metavers.addEventListener('mouseover', function(e) {
    document.getElementById('ul_metavers').style.display = "block";
    document.getElementById('ul_nft').style.display = "none";
    document.getElementById('ul_crypto').style.display = "none";
    body.addEventListener('click', function() {
        document.getElementById('ul_metavers').style.display = "none";
    })
})
let boite = document.querySelector('.hamburger');
boite.addEventListener('click', function(e) {
    body.classList.toggle('open');
    e.target.classList.toggle('active')
})



//Api Observer
//On déclare notre div
const radius = document.querySelector('.radius');
const card = document.querySelector('.card')
    //Nos paramètres d'options
let options = {
        root: null,
        threshold: 0.5
    }
    //entries c'est les éléments qu'on observe
function handleIntersect(entries) {
    entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.toggle('show')
                entry.target.style.opacity = 1;
            }
        })
        //console.log(entries);
}
//on crée crée notre constructeur 
const observer = new IntersectionObserver(handleIntersect, options);
//On observe notre div radius
observer.observe(radius);


/*
//Page de chargement
const chargement = document.querySelector('.chargement');
window.addEventListener('load', function() {
    chargement.classList.add('chargement-affiche')
})
*/