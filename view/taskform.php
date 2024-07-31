<?php
include __DIR__ . '/../App/Controller/access_control.php';
?>
<div class="p-5 m-3 border border-primary rounded bg-light">
    <a href="../index.php">
        <button type="button" class="btn btn-success"><?php echo isset($id) ? 'Edit Task' : 'Create New Task'; ?></button>
    </a>
    <form method="post">
        <div class="form-group px-5 pt-5">
            <label>Task</label>
            <input type="text" class="form-control" name="task">
        </div>
        <button type="submit" name="submit" class="btn btn-primary"><?php echo isset($id) ? 'Update' : 'Submit'; ?></button>
        <small><?php echo $taskController->filederror; ?></small>
    </form>
</div>
