<?php
session_start();
use App\Models\Database;
use App\Models\User;

$database = new Database();
$db = $database->connect();
$userClass = new User($db);

$user = $userClass->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'User management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1><i class="fa-solid fa-user"></i> User management</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                <button id="close-message" style="margin-left: 20px;">&times;</button>
            </div>
        <?php endif; ?>
        <div class="managementConfigs">
            <button id="addNew" data-popup="user" class="managementConfigs__add"><i class="fa-solid fa-plus"></i> Add a new</button>
        </div>
        <table>
            <tr>
                <th><i class="fa-solid fa-hashtag"></i> ID</th>
                <th><i class="fa-solid fa-signature"></i> Name</th>
                <th><i class="fa-solid fa-envelope"></i> Email</th>
                <th><i class="fa-solid fa-turn-up"></i> Level</th>
                <th><i class="fa-solid fa-spinner"></i> Status</th>
                <th><i class="fa-solid fa-calendar-days"></i> Creation date</th>
                <th><i class="fa-solid fa-gears"></i> Actions</th>
            <tr>
            <?php while ($row = $users->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['userId']; ?></td>
                    <td><?= $row['userName']; ?></td>
                    <td><?= $row['userEmail']; ?></td>
                    <td><?= ($row['userLevel'] == 1) ? 'Admin' : $row['userLevel']; ?></td>
                    <td><?= ($row['userStatus'] == 1) ? 'Active <span class="active">•</span>' : 'Disabled <span class="disabled">•</span>'; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['userCreationDate'])); ?></td>
                    <td>
                        <form method="post" action="index.php?router=user&action=delete" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="userId" value="<?= $row['userId']; ?>">
                            <button type="submit" name="delete" value="delete" class="delete"><i class="fa-solid fa-trash-can"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php require '../components/footer.php' ?>
</body>
</html>