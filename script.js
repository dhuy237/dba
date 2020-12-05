function showSearch() {
    var xhttp;
    var str = document.getElementById("search_text").value;
    console.log(str);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("employee_id").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "employee.php?employee_id="+str, true);
    xhttp.send();
}