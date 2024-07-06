<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Home'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1>Home</h1>
        <h2>Listagem de Professores</h2>
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
                    <td><?= $row['professorCreationDate']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>