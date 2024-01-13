<header>
    <h2 class="title">
        VISUAL HARMONY
    </h2>
    <div class="navbar">
        <a href="index.php" title="Strona główna" class="a-menu">STRONA<span class="invisible-space"></span>GŁÓWNA</a>
        <a href="onas.php" title="Poznaj nas" class="a-menu">O<span class="invisible-space"></span>NAS</a>
        <a href="kontakt.php" title="Skontaktuj się z nami" class="a-menu">KONTAKT</a>
        <?php if (!isset($_SESSION['loggedin'])) { ?>
        <a href="logowanie.php" title="Przejdź do strony logowania" class="a-menu">LOGOWANIE</a>
        <?php }else{ ?>
        <a href="scripts/logout.php" title="Wyloguj" class="a-menu">WYLOGUJ</a>
        <?php } ?>
    </div>
</header>
