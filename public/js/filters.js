
window.onload = () => {
    const FiltersForm = document.querySelector("#filters");

    // boucle sur les inputs
    document.querySelectorAll("#filters input").forEach(input => {
        input.addEventListener("change", () => {
            // Interception des clics
            // Récupération des données du form
            const Form = new FormData(FiltersForm);

            // queryString
            const Params = new URLSearchParams();

            Form.forEach((value, key) => {
                Params.append(key, value);
            });

            //Récupération de l'url active
            const Url = new URL(window.location.href);

            // requête ajax
            fetch(Url.pathname + "?" + Params.toString() + "&ajax=1", {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response => {
                response.json();
            }).then(function (data) {
                const content = document.querySelector("#content");
                content.innerHTML = data.content;
                history.pushState({}, null, Url.pathname + "?" + Params.toString());
            }).catch(e => alert(e));
        });
    });
}