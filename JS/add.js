function ajout(){
    let req = new XMLHttpRequest();
    req.open("GET", "/api/dicToDB.php");
    req.onload = () => {
        let resp = JSON.parse(req.responseText);
        let span = document.createElement("span");
        span.innerHTML = resp.mot + "<span style='color : red'> " + resp.stat + "</span><br>";
        document.getElementById("main").prepend(span);
    }
    req.send();
}

function isLast(){
    let spans = document.getElementsByTagName("span");
    if(spans.length > 0){
        return spans[0].innerHTML === "Insertion fini";
    }
    return false;

}

window.setInterval(() => {
    if(isLast()){
        return false;
    }
    else{
        ajout();
    }
},500);


