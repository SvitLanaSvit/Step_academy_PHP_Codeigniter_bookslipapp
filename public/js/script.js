document.addEventListener("DOMContentLoaded", async (e)=>{
    let main = document.querySelector("#main");
    if(main){
        let resp = await fetch("/api/books", {
            headers: {
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        });
        if(resp.ok == true){
            main.innerText = "";
            let data = await resp.json();
            Array.from(data.books).forEach(elem=>{
                let p = document.createElement("p");
                p.innerText = `${elem.titleBook}`;
                main.appendChild(p);
            })
        }
    }
})