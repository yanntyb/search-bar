let deleteButtonLabel = document.getElementById("deleteLabel");
let deleteButton = document.getElementById("delete");


deleteButton.addEventListener("mouseover", () => {
    let styleButton = deleteButton.getBoundingClientRect();
    let styleForm = document.getElementById("form").getBoundingClientRect();
    let styleLabel = deleteButtonLabel.getBoundingClientRect();
    let left = ((styleButton.right - styleButton.left) / 2) + styleButton.left - (styleLabel.right - styleLabel.left) / 2;
    deleteButtonLabel.style.top = styleForm.bottom + 5 + "px";
    deleteButtonLabel.style.left = left - 15 + "px";
    window.setTimeout(() => {
        deleteButtonLabel.style.display = "block";
    },200)

})

deleteButton.addEventListener("mouseout", () => {
    window.setTimeout(() => {
        deleteButtonLabel.style.display = "none";
    },200)
})

deleteButton.addEventListener("click", () => {
    document.getElementById("input-field").value = "";
})