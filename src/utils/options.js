document.addEventListener("readystatechange", function () {
    if (document.readyState == 'complete') {
        botones = document.getElementsByTagName("button");
        for (var i = 0; i < botones.length; i++) {
            botones[i].addEventListener("click", redirect, true);
        }
    }
}, true);

function redirect(ev) {
    //alert("backend/" + ev.target.value + ".php");
    window.location.href = "backend/" + ev.target.value + ".php";
}