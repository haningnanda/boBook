function login() {
    var modal = document.getElementById("modal");
    modal.style.display = "block";
    var x = document.getElementsByClassName("close")[0];
    x.onclick = function() {
    modal.style.display = "none";
    }
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
}

