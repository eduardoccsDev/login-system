<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Professor management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1>Professor management</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Creation date</th>
            <tr>
            <?php while ($row = $professors->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['professorId']; ?></td>
                    <td><?= $row['professorName']; ?></td>
                    <td><?= $row['professorEmail']; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['professorCreationDate'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>