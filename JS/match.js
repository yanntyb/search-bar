let input = document.getElementById("input-field");
let resultTable = document.getElementById("result-table");
let form = document.getElementById("form");

function placeResultTable(){
    let inputStyle = form.getBoundingClientRect();
    resultTable.style.left = inputStyle.left + "px";
    resultTable.style.top = inputStyle.bottom - 15 + "px";
}

function match(word){
    let req = new XMLHttpRequest();
    req.open("POST","api/searchWord.php");
    req.onload = () => {
        let resp = JSON.parse(req.responseText);
        showResult(resp);
    }
    req.send(JSON.stringify({"word": word}));
}

function showResult(results){
    if(results.length > 0 ){
        form.style.borderRadius = "20px 20px 0px 0px";
        resultTable.style.border = "1px solid darkgrey"
        resultTable.style.borderTop = "none";
    }
    else{
        form.style.borderRadius = "40px 40px 40px 40px";
        resultTable.style.display = "none";
        resultTable.style.border = "none";
    }
    for(let result of results){
        let td = document.createElement("td");
        td.innerHTML = result.word.toString();
        td.className = "result-single";
        resultTable.appendChild(td);
    }
}

function showTable(){

    if(input.value.length > 0){
        if(input.value.split(" ")[input.value.split(" ").length - 1] !== ""){
            match(input.value.split(" ")[input.value.split(" ").length - 1]);
        }
    }
    else{
        form.style.borderRadius = "40px 40px 40px 40px";
    }
}

input.addEventListener("input", () =>
    {
        resultTable.style.border = "none";
        resultTable.innerHTML = "";
        showTable();
    }
);

input.addEventListener("focusin", () => {
    resultTable.style.display = "flex";

})

input.addEventListener("focusout", () => {
    form.style.borderRadius = "40px 40px 40px 40px";
    resultTable.style.display = "none";
    resultTable.style.border = "none";
})


placeResultTable();