<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Professor management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1>Professor management</h1>
        <div class="managementConfigs">
            <button id="addNew" data-popup="professor" class="managementConfigs__add">Add a new</button>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Creation date</th>
                <th>Actions</th>
            <tr>
            <?php while ($row = $professors->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['professorId']; ?></td>
                    <td><?= $row['professorName']; ?></td>
                    <td><?= $row['professorEmail']; ?></td>
                    <td><?= ($row['professorStatus'] == 1) ? 'Active <span class="active">•</span>' : 'Disabled <span class="disabled">•</span>'; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['professorCreationDate'])); ?></td>
                    <td>
                        <button class="edit">Edit</button>
                        <button class="delete">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>