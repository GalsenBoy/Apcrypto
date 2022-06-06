let body = document.querySelector('body')
let boite = document.querySelector('.hamburger');
boite.addEventListener('click', function(e) {
    body.classList.toggle('open');
    e.target.classList.toggle('active');
})

//Api Observer
//On déclare notre div
const radius = document.querySelector('.radius');
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





const sr = ScrollReveal();
sr.reveal('.image_blockchain', {
    origin: 'left',
    rotate: { x: 0, y: 0, z: -55 },
    scale: 0.5,
    distance: '100px',
    duration: 2000,
});

sr.reveal('.titre', {
    delay: 1200,
    duration: 1500,
    distance: '85px'
})

sr.reveal('.image_bitcoin', {
    scale: 0.5,
    duration: 2000,
})

sr.reveal('.citation', {
    scale: 0.5,
    duration: 2000,
    delay: 800
})

sr.reveal('.image_meta', {
    origin: 'left',
    distance: '150px',
    duration: 2000,

})

sr.reveal('.texte_meta', {
    origin: 'top',
    scale: 0.5,
    distance: '85px',
    duration: 2300,
    delay: 700
})

sr.reveal('.image_shiba', {
    duration: 1000,
    distance: '50px'
})

sr.reveal('.texte_shiba', {
    delay: 500,
    duration: 1500,
    distance: '50px'
})

document.getElementById('year').innerHTML = (new Date()).getFullYear();