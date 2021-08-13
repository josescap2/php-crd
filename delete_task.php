<?php

include("db.php");

if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    try {
        $task = $_POST["task"];
        $description = $_POST["description"];

        if (!($sentence = $mysqli->prepare("DELETE FROM task WHERE id = ?"))) {
            die("Sentence was not prepared: (" . $mysqli->errno . ") " . $mysqli->error);
        }

        if (!$sentence->bind_param("d", $id)) {
            die("Parameter could not bind successfully: (" . $sentence->errno . ") " . $sentence->error);
        }

        if (!$sentence->execute()) {
            die("Something was wrong: (" . $sentence->errno . ") " . $sentence->error);
        }

        $_SESSION["message"] = "Task deleted succesfully";
        $_SESSION["style"] = "green orange lighten-2 rounded";
    } catch (Exception $ex) {
        $_SESSION["message"] = "Something went wrong.";
        $_SESSION["style"] = "deep-orange darken-2 rounded";
    }
} else {
    $_SESSION["message"] = "Task undefined";
    $_SESSION["style"] = "deep-orange darken-2 rounded";
}

header("Location: /php-crd");