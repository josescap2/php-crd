<?php

include("db.php");

if (!empty($_POST["task"]) && !empty($_POST["description"])) {
    try {
        $task = $_POST["task"];
        $description = $_POST["description"];
    
        if (!($sentence = $mysqli->prepare("INSERT INTO task(title, description) VALUES (?, ?)"))) {
            die("Sentence was not prepared: (" . $mysqli->errno . ") " . $mysqli->error);
        }
    
        if (!$sentence->bind_param("ss", $task, $description)) {
            die("Parameter could not bind successfully: (" . $sentence->errno . ") " . $sentence->error);
        }
    
        if (!$sentence->execute()) {
            die("Something was wrong: (" . $sentence->errno . ") " . $sentence->error);
        }
    
        $_SESSION["message"] = "Task created succesfully";
        $_SESSION["style"] = "green darken-2 rounded";
    } catch (Exception $ex) {
        $_SESSION["message"] = "Task creation went wrong.";
        $_SESSION["style"] = "deep-orange darken-2 rounded";
    }

} else {
    $_SESSION["message"] = "Task creation went wrong.";
    $_SESSION["style"] = "deep-orange darken-2 rounded";
}

header("Location: /php-crd");