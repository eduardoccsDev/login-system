<?php
session_start();
use App\Models\Database;
use App\Models\Professor;

$database = new Database();
$db = $database->connect();
$professorClass = new Professor($db);

$professors = $professorClass->getAllProfessors();
?>

<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Professor management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1>Professor management</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                <button id="close-message" style="margin-left: 20px;">&times;</button>
            </div>
        <?php endif; ?>
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
                        <form method="post" action="index.php?router=professor&action=delete" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this professor?');">
                            <input type="hidden" name="professorId" value="<?= $row['professorId']; ?>">
                            <button type="submit" name="delete" value="delete" class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
