<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = 'Home'; require '../components/customHead.php'; ?>
<body>
    <?php require '../components/nav.php' ?>
    <div class="container">
        <h1>Home</h1>
        <section class="quickLinks">
            <div class="quickLinks__card">
                <p class="quickLinks__card__title">Professor management</p>
                <p class="quickLinks__card__description">Lorem ipsum dolor.</p>
                <a href="?router=professor" class="quickLinks__card__router">Config</a>
            </div>
            <div class="quickLinks__card">
                <p class="quickLinks__card__title">User management</p>
                <p class="quickLinks__card__description">Lorem ipsum dolor.</p>
                <a href="?router=user" class="quickLinks__card__router">Config</a>
            </div>
        </section>
    </div>
</body>
</html>