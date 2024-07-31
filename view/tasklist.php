<?php
include __DIR__ . '/../App/Controller/access_control.php';
?>
<h1 class="text-center pt-5 pb-3">Task list</h1>
<div class="p-5 bg-dark mb-5 mx-3">
<div class="addmore mb-3">
    <a href="#" class="btn btn-success">Add New Task</a>
</div>

<table class="table table-dark">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Task</th>
        <th scope="col">Edit task</th>
        <th scope="col">Delete task</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($result = $result_set->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tr>
            <th scope="row"><?php echo $counter; ?></th>
            <td><?php echo($result['task']); ?></td>
            <td><a href="<?php echo $function_path . $result['id'] . $action_path; ?>update"
                   class="btn btn-primary">Edit</a></td>
            <td><a href="<?php echo $function_path . $result['id'] . $action_path; ?>delete" class="btn btn-danger">Delete</a>
            </td>
            <td>
                <div class="form-check d-flex align-items-center">
                    <input type="checkbox" <?php echo ((int)$result['status']) ? 'checked' : '' ?>
                           onclick="window.location.href='<?php echo $function_path . $result['id'] . $action_path; ?>status_update'">
                    <h6><?php echo ((int)$result['status']) ? 'completed' : 'uncomplete' ?></h6>
                </div>
            </td>
        </tr>
        <?php
        $counter++;
    }
    ?>
    </tbody>
</table>
</div>
