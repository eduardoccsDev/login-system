<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Course management'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1><i class="fa-solid fa-scroll"></i> Course management</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message">
                <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                <button id="close-message" style="margin-left: 20px;">&times;</button>
            </div>
        <?php endif; ?>
        <div class="managementConfigs">
            <button id="addNew" data-popup="course" class="managementConfigs__add"><i class="fa-solid fa-plus"></i> Add a new</button>
        </div>
        <table>
         <thead>
             <tr>
                 <th><i class="fa-solid fa-hashtag"></i> ID</th>
                 <th><i class="fa-solid fa-signature"></i> Name</th>
                 <th><i class="fa-regular fa-message"></i> Description</th>
                 <th><i class="fa-solid fa-receipt"></i> Type</th>
                 <th><i class="fa-solid fa-spinner"></i> Status</th>
                 <th><i class="fa-solid fa-book"></i> Disciplines</th>
                 <th><i class="fa-solid fa-calendar-days"></i> Creation date</th>
                 <th><i class="fa-solid fa-gears"></i> Actions</th>
         </thead>
            </tr>
            <?php foreach ($courses as $row): ?>
                <tr>
                    <td><?= $row['courseId']; ?></td>
                    <td><?= $row['courseName'] ?></td>
                    <td><?= $row['courseDescription']; ?></td>
                    <td><?= $row['courseType']; ?></td>
                    <td><?= ($row['courseStatus'] == 1) ? 'Active <span class="active">•</span>' : 'Disabled <span class="disabled">•</span>'; ?></td>
                    <td><?= $row['disciplineCount']; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['courseCreationDate'])); ?></td>
                    <td>
                        <form method="post" action="index.php?router=course&action=delete" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            <input type="hidden" name="courseId" value="<?= $row['courseId']; ?>">
                            <button type="submit" name="delete" value="delete" class="delete"><i class="fa-solid fa-trash-can"></i> Delete</button>
                        </form>
                        <button data-course-id="<?= $row['courseId']; ?>" class="disciplines"><i class="fa-solid fa-magnifying-glass-plus"></i> Disciplines</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="overlay" id="overlay" style="display:none"></div>
        <div id="disciplinePopup" class="popup" style="display: none;">
            <div class="popup-content">
                <div class="popup-header">
                    <h2>Disciplines</h2>
                    <span class="close-btn"><i class="fa-solid fa-xmark"></i></span>
                </div>
                <table id="disciplineTable">
                    <thead>
                        <tr>
                            <th><i class="fa-solid fa-hashtag"></i> ID</th>
                            <th><i class="fa-solid fa-signature"></i> Name</th>
                            <th><i class="fa-regular fa-message"></i> Description</th>
                            <th><i class="fa-solid fa-calendar-week"></i> Period</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Disciplinas serão adicionadas aqui via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require '../components/footer.php' ?>
</body>
</html>
