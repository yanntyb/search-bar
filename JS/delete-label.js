let deleteButtonLabel = document.getElementById("deleteLabel");

document.getElementById("delete").addEventListener("mouseover", () => {
    let styleButton = document.getElementById("delete").getBoundingClientRect();
    let styleForm = document.getElementById("form").getBoundingClientRect();
    let styleLabel = deleteButtonLabel.getBoundingClientRect();
    let left = ((styleButton.right - styleButton.left) / 2) + styleButton.left - (styleLabel.right - styleLabel.left) / 2;
    deleteButtonLabel.style.top = styleForm.bottom + 5 + "px";
    deleteButtonLabel.style.left = left - 15 + "px";
    window.setTimeout(() => {
        deleteButtonLabel.style.display = "block";
    },200)

})

document.getElementById("delete").addEventListener("mouseout", () => {
    window.setTimeout(() => {
        deleteButtonLabel.style.display = "none";
    },200)
})