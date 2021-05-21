// Attendre que le DOM soit charger
window.onload=()=>{
    //Gestion des boutons "Supprimer" (avec l'attribut data-delete)
    let links = document.querySelectorAll("[data-delete]");
    
    // On boucle sur links
    for(link of links){
        // Ecoute le clic
        link.addEventListener('click', function(e){
            e.preventDefault()

            //Confirmation
            if(confirm("Voulez-vous supprimer cette image?")){
                // Envoie une requête Ajax vers le href du lien avec la methode DELETE
                fetch(this.getAttribute("href"),{
                    method: "DELETE",
                    headers: {
                        'X-Requested-With': "XMLHttpRequest", 
                        "Content-Type" : "application/json"
                    },
                    body: JSON.stringify({"_token": this.dataset.token})
                }).then(
                    // On récupere la reponse en BDd
                    response => response.json()
                ).then(data => {
                    if(data.success)
                        this.parentElement.remove()
                    else
                        alert(data.error)
                    
                }).catch(e => alert(e))
            }
        })
    }
   
}