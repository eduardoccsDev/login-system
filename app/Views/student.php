<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Student management';
require '../components/customHead.php'; ?>

<body>
    <?php require '../components/nav.php' ?>
    <div class="wrapper">
        <?php require '../components/sidebar.php' ?>
        <div class="container">
            <h1><i class="fa-solid fa-graduation-cap"></i> Student management</h1>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="message">
                    <?= $_SESSION['message'];
                    unset($_SESSION['message']); ?>
                    <button id="close-message" style="margin-left: 20px;">&times;</button>
                </div>
            <?php endif; ?>
            <div class="managementConfigs">
                <button id="addNew" data-popup="student" class="managementConfigs__add"><i class="fa-solid fa-plus"></i> Add a new</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th><i class="fa-solid fa-hashtag"></i> ID</th>
                        <th><i class="fa-solid fa-registered"></i> RC</th>
                        <th><i class="fa-solid fa-signature"></i> Name</th>
                        <th><i class="fa-solid fa-envelope"></i> Email</th>
                        <th><i class="fa-solid fa-id-card"></i> CPF</th>
                        <th><i class="fa-solid fa-building-circle-arrow-right"></i> Hub</th>
                        <th><i class="fa-solid fa-spinner"></i> Status</th>
                        <th><i class="fa-solid fa-calendar-days"></i> Creation date</th>
                        <th><i class="fa-solid fa-gears"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($students && $students->rowCount() > 0): ?>
                        <?php while ($row = $students->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $row['studentId']; ?></td>
                                <td><?= $row['studentRegistrationCode']; ?></td>
                                <td><?= $row['studentName']; ?></td>
                                <td><?= $row['studentEmail']; ?></td>
                                <td><?= $row['studentCPF']; ?></td>
                                <td><?= $row['studentHub']; ?></td>
                                <td><?= ($row['studentStatus'] == 1) ? 'Active <span class="active">•</span>' : 'Disabled <span class="disabled">•</span>'; ?></td>
                                <td><?= date('d-m-Y', strtotime($row['studentCreationDate'])); ?></td>
                                <td>
                                    <form method="post" action="index.php?router=student&action=delete" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        <input type="hidden" name="studentId" value="<?= $row['studentId']; ?>">
                                        <button type="submit" name="delete" value="delete" class="delete"><i class="fa-solid fa-trash-can"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">No students found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require '../components/footer.php' ?>
</body>

</html>