let input = document.getElementById("input-field");

function match(word){
    let req = new XMLHttpRequest();
    req.open("POST","api/searchWord.php");
    req.onload = () => {
        let resp = JSON.parse(req.responseText);
        console.log(resp);
    }
    req.send(JSON.stringify({"word": word}));
}

input.addEventListener("input", () => match(input.value));