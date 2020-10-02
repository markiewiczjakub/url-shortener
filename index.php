<?php

// REDIRECT
// let api handle it
if(isset($_GET['p'])){
    $p = $_GET['p'];
    header("Location: ./api/api.php?p=".$p);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>URL Shortener</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./styles.css" rel="stylesheet">
    </head>
    <body>
        <div id="popup">
            <div class="popup-content">
                <p>Here is your result:</p>
                <div id="result">asd</div>
                <button type="button" id="close">Close</button>
            </div>
        </div>
        <header>
            <h1>URL Shortener</h1>
        </header>
        <main>
            <form method="POST" action="#" id="form" class="form">
                <label for="name">Short name</label>
                <input name="name" type="text" id="name" placholder="name" placeholder="short name (optional)">
                <label for="url">URL</label>
                <input name="url" type="text" id="url" placeholder="http://google.com" required>
                <button type="submit" id="submit">
                    <div id="spinner"><img src="./images/spinner.svg"></div>
                    <div id="submitText">Here we go!</div>
                </button>
            </form>
        </main>
        <footer>
            made by <a target="_blank" href="https://github.com/markiewiczjakub">kuba</a>
        </footer>
        <script type="module" src="./js/main.js"></script>
    </body>
</html>