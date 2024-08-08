<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Discipline management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1><i class="fa-solid fa-book"></i> Discipline management</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                <button id="close-message" style="margin-left: 20px;">&times;</button>
            </div>
        <?php endif; ?>
        <div class="managementConfigs">
            <button id="addNew" data-popup="discipline" class="managementConfigs__add"><i class="fa-solid fa-plus"></i> Add a new</button>
        </div>
        <table>
            <tr>
                <th><i class="fa-solid fa-hashtag"></i> ID</th>
                <th><i class="fa-solid fa-signature"></i> Name</th>
                <th><i class="fa-regular fa-message"></i> Description</th>
                <th><i class="fa-solid fa-calendar-week"></i> Period</th>
                <th><i class="fa-solid fa-spinner"></i> Status</th>
                <th><i class="fa-solid fa-calendar-days"></i> Creation date</th>
                <th><i class="fa-solid fa-gears"></i> Actions</th>
            <tr>
            <?php while ($row = $discipline->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['disciplineId']; ?></td>
                    <td><?= $row['disciplineName']. ' - ' .$row['disciplineModality']; ?></td>
                    <td><?= $row['disciplineDescription']; ?></td>
                    <td><?= $row['disciplinePeriod']; ?></td>
                    <td><?= ($row['disciplineStatus'] == 1) ? 'Active <span class="active">•</span>' : 'Disabled <span class="disabled">•</span>'; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['disciplineCreationDate'])); ?></td>
                    <td>
                        <form method="post" action="index.php?router=discipline&action=delete" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this discipline?');">
                            <input type="hidden" name="disciplineId" value="<?= $row['disciplineId']; ?>">
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
