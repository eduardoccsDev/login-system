<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Hub management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="wrapper">
        <?php require '../components/sidebar.php' ?>
        <div class="container">
            <h1><i class="fa-solid fa-building-flag"></i> Hub management</h1>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="message">
                    <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                    <button id="close-message" style="margin-left: 20px;">&times;</button>
                </div>
            <?php endif; ?>
            <div class="managementConfigs">
                <button id="addNew" data-popup="hub" class="managementConfigs__add"><i class="fa-solid fa-plus"></i> Add a new</button>
            </div>
            <table>
                <tr>
                    <th><i class="fa-solid fa-hashtag"></i> ID</th>
                    <th><i class="fa-solid fa-signature"></i> Name</th>
                    <th><i class="fa-solid fa-spinner"></i> Status</th>
                    <th><i class="fa-solid fa-scroll"></i> Courses</th>
                    <th><i class="fa-solid fa-calendar-days"></i> Creation date</th>
                    <th><i class="fa-solid fa-gears"></i> Actions</th>
                <tr>
                <?php foreach ($hubs as $row): ?>
                    <tr>
                        <td><?= $row['hubId']; ?></td>
                        <td><?= $row['hubName']?></td>
                        <td><?= ($row['hubStatus'] == 1) ? 'Active <span class="active">•</span>' : 'Disabled <span class="disabled">•</span>'; ?></td>
                        <td><?= $row['courseCount']; ?></td>
                        <td><?= date('d-m-Y', strtotime($row['hubCreationDate'])); ?></td>
                        <td>
                            <form method="post" action="index.php?router=hub&action=delete" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this hub?');">
                                <input type="hidden" name="hubId" value="<?= $row['hubId']; ?>">
                                <button type="submit" name="delete" value="delete" class="delete"><i class="fa-solid fa-trash-can"></i> Delete</button>
                            </form>
                            <button data-hub-id="<?= $row['hubId']; ?>" class="courses"><i class="fa-solid fa-magnifying-glass-plus"></i> Courses</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="overlay" id="overlay" style="display:none"></div>
            <div id="coursePopup" class="popup" style="display: none;">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Courses</h2>
                        <span class="close-btn"><i class="fa-solid fa-xmark"></i></span>
                    </div>
                    <table id="courseTable">
                        <thead>
                            <tr>
                                <th><i class="fa-solid fa-hashtag"></i> ID</th>
                                <th><i class="fa-solid fa-signature"></i> Name</th>
                                <th><i class="fa-regular fa-message"></i> Description</th>
                                <th><i class="fa-solid fa-receipt"></i> Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cursos serão adicionadas aqui via JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require '../components/footer.php' ?>
</body>
</html>
