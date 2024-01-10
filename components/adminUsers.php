<?php
    // Include the functions file for necessary functions and classes
    require_once './inc/functions.php';

    // Retrieve all roles data using the roles controller
    $members = $controllers->members()->get_all_members();
?>

<!-- HTML for displaying the equipment inventory -->
<h2>Users</h2> 
<table class="table table-striped"> 
        <tr>
            <th>ID</th> 
            <th>First Name</th>
            <th>Second Name</th>
            <th>Email</th> 
            <th>Role</th>
            <th></th>
            <th></th> 
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $member): ?> <!-- Loop through each member item -->
            <tr>

                <td><?= htmlspecialchars($member['ID']) ?></td> 
                <td><?= htmlspecialchars($member['firstname']) ?></td> 
                <td><?= htmlspecialchars($member['lastname']) ?></td> 
                <td><?= htmlspecialchars($member['email']) ?></td> 
                <td><?= htmlspecialchars($controllers->roles()->get_rolename_by_id($member['role_id'])['name']) ?></td>
                <td>
                        <a href="updateUsers.php?id=<?php echo $member['ID']?>" class="btn btn-primary">Edit</a>


                        <a href="delete_users.php?id=<?php echo $member['ID']?>" class="btn btn-primary">Delete</a>
                </td> 

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>