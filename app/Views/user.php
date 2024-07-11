<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'User management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1>User management</h1>
        <div class="managementConfigs">
            <button id="addNew" data-popup="user" class="managementConfigs__add">Add a new</button>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Status</th>
                <th>Creation date</th>
            <tr>
            <?php while ($row = $users->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['userId']; ?></td>
                    <td><?= $row['userName']; ?></td>
                    <td><?= $row['userEmail']; ?></td>
                    <td><?= ($row['userLevel'] == 1) ? 'Admin' : $row['userLevel']; ?></td>
                    <td><?= ($row['userStatus'] == 1) ? 'Active <span class="active">•</span>' : 'Disabled <span class="disabled">•</span>'; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['userCreationDate'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>