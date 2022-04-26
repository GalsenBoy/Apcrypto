document.querySelectorAll("[data-reply]").forEach(element => {
    element.addEventListener("click", function() {
        document.querySelector('#commentaire__parentid').value.dataset.id;
    })
})