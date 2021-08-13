<?php
include('db.php');

try {
    if (!($sentence = $mysqli->prepare("SELECT id, title, description FROM task"))) {
        die("Sentence wasn not prepared: (" . $mysqli->errno . ") " . $mysqli->error);
    }

    if (!$sentence->execute()) {
        die("Execution failed: (" . $sentence->errno . ") " . $sentence->error);
    }

    $id = NULL;
    $task = NULL;
    $description = NULL;

    if (!$sentence->bind_result($id, $task, $description)) {
        die("Binding went wrong: (" . $sentencia->errno . ") " . $sentencia->error);
    }
} catch (Exception $ex) {
    die($ex->getMessage());
}

$message = NULL;
$style = NULL;

if (!(empty($_SESSION["message"] || empty($_SESSION["message_type"])))) {
    $message = $_SESSION["message"];
    $style = $_SESSION["style"];
}

$_SESSION["message"] = NULL;
$_SESSION["style"] = NULL;

?>
<?php include('includes/header.php'); ?>

<div class="container">

    <div class="row">

        <div class="col s4">
            <h3>Create a task</h3>
            <br>
            <form action="create_task.php" method="post">
                <div class="input-field">
                    <input placeholder='Write a task like "Do my homework"' id="task" type="text" class="validate" name="task">
                    <label for="task">Task</label>
                </div>
                <div class="input-field">
                    <textarea id="description" class="materialize-textarea" name="description" placeholder="Write your description here..."></textarea>
                    <label for="description">Description</label>
                </div>
                <button class="btn waves-effect waves-light teal col s12" type="submit" name="action">Save
                    <i class="material-icons right">add</i>
                </button>
            </form>
        </div>
        <div class="col s8">
            <h3>Your tasks</h3>
            <br>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="right">Actions</th>
                </thead>
                <tbody>
                    <?php while ($sentence->fetch()) : ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $task; ?></td>
                            <td><?php echo $description; ?></td>
                            <td>
                                <a href="delete_task.php?id=<?php echo $id;?>" class="waves-effect waves-teal btn-flat right">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<?php if (!empty($style)) : ?>
    <script>
        M.toast({
            html: '<?php echo $message; ?>',
            classes: '<?php echo $style; ?>'
        })
    </script>
<?php endif; ?>
</body>

</html>