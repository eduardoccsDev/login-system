<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Home'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="wrapper">
        <?php require '../components/sidebar.php' ?>
        <div class="container">
            <h1>Home</h1>
            <section class="quickLinks">
                <div class="quickLinks__card">
                    <p class="quickLinks__card__title"><i class="fa-solid fa-chalkboard-user"></i> Professor management</p>
                    <p class="quickLinks__card__description">Here you can manage the system's professors.</p>
                    <a href="?router=professor" class="quickLinks__card__router"><i class="fa-solid fa-gear"></i> Config</a>
                </div>
                <div class="quickLinks__card">
                    <p class="quickLinks__card__title"><i class="fa-solid fa-scroll"></i> Course management</p>
                    <p class="quickLinks__card__description">Here you can manage the system's courses.</p>
                    <a href="?router=course" class="quickLinks__card__router"><i class="fa-solid fa-gear"></i> Config</a>
                </div>
                <div class="quickLinks__card">
                    <p class="quickLinks__card__title"><i class="fa-solid fa-book"></i> Discipline management</p>
                    <p class="quickLinks__card__description">Here you can manage the system's disciplines.</p>
                    <a href="?router=discipline" class="quickLinks__card__router"><i class="fa-solid fa-gear"></i> Config</a>
                </div>
                <div class="quickLinks__card">
                    <p class="quickLinks__card__title"><i class="fa-solid fa-graduation-cap"></i> Student management</p>
                    <p class="quickLinks__card__description">Here you can manage the system's students.</p>
                    <a href="?router=student" class="quickLinks__card__router"><i class="fa-solid fa-gear"></i> Config</a>
                </div>
                <div class="quickLinks__card">
                    <p class="quickLinks__card__title"><i class="fa-solid fa-building-flag"></i> Hub management</p>
                    <p class="quickLinks__card__description">Here you can manage the system's hubs.</p>
                    <a href="?router=hub" class="quickLinks__card__router"><i class="fa-solid fa-gear"></i> Config</a>
                </div>
                <div class="quickLinks__card">
                    <p class="quickLinks__card__title"><i class="fa-solid fa-user"></i> User management</p>
                    <p class="quickLinks__card__description">Here you can manage the system's users.</p>
                    <a href="?router=user" class="quickLinks__card__router"><i class="fa-solid fa-gear"></i> Config</a>
                </div>
            </section>
        </div>
    </div>
    <?php require '../components/footer.php' ?>
</body>
</html>