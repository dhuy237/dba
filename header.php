<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Systems Assignment</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <!-- <ul> -->
        <!-- Navigation Bar -->
        <!-- <li><a href="index.html">Home</a></li>
        <li><a href="index.php?page=test_db">Test</a></li>
        <li><a href="index.php?page=employee">Search Employee</a></li>
        <li><a href="index.php?page=add">Add New Account</a></li>
        <li><a href="index.php?page=customer">Search Customer</a></li>
        <li><a href="index.php?page=report">Report</a></li>
        <li><a href="#">Log Out</a></li>
    </ul> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <!-- <div>
            <img src="images/1.png" class="logo" width="10%" height="auto" alt="logo" />
            <h1>My website name</h1>
        </div> -->
        <a class="navbar-brand" href="index.php?page=home">
            <img src="images/1.png" width="30" height="auto" class="d-inline-block align-top" alt="" loading="lazy">
            Bank Database
          </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=test_db">Test</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Employee
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=employee">Search Employee</a>
                        <a class="dropdown-item" href="index.php?page=report">Report</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Customer
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=customer">Search Customer</a>
                        <a class="dropdown-item" href="index.php?page=add">Add New Account</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=logout">Logout</a>
                </li>
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0"> -->
                <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                <!-- <input class="form-control mr-sm-2" id="search_text" type="text" autocomplete="off"
                    placeholder="Search product" onkeydown="if (event.keyCode == 13) 
            document.getElementById('enter').click()" />
                <button class="btn btn-outline-success my-2 my-sm-0" id="enter" onclick="showSearch()" type="button">Search</button>
                <div class="result"></div>
            </form> -->
        </div>
    </nav>
    <!-- <div id="table"></div> -->
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>