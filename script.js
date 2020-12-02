function showSearch() {
    var xhttp;
    var str = document.getElementById("search_text").value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "employee.php?table="+str, true);
    xhttp.send();
}