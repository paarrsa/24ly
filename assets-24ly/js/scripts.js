let width = screen.width;
if(width < 720) {
    var mySVG = document.getElementById('svg');
    mySVG.setAttribute("viewBox", "0 0 540 320");
}

function resetHeight(){
    document.body.style.height = window.innerHeight + "px";
}
window.addEventListener("resize", resetHeight);
resetHeight();

function shortenUrl() {
    let url = document.getElementById("input").value;
    if(url == "") {
      alert("Please fill in the field.");
      return false;
    }
    document.getElementById("submit").innerHTML = "Shortnering url...";
    document.getElementById("submit").disabled = true;
    let checkUrl = url.substr(0,7);
    if (checkUrl == "http://" || checkUrl == "https:/") {
      var apiReq = "./api?url=" + url;
    } else {
      var apiReq = "./api?url=" + "http://" + url;
    }
    fetch(apiReq)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      let link = data;
      let shortenedUrl = link.url;
      showUrl(shortenedUrl);
      });
}
function showUrl(url) {
    document.getElementById("url").value = url;
    document.getElementById("container").classList.add("hide");
    document.getElementById("bg").classList.add("moveUp");
    document.getElementById("result").classList.add("show");
    document.getElementById("title").classList.add("show");
    document.getElementById("shortenedURL").classList.add("show");
}
function copy() {
    var textBox = document.getElementById("url");
    textBox.select();
    document.execCommand("copy");
    alert("You copied the link!");
}