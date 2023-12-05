<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <h2 class="title">
            VISUAL HARMONY
        </h2>

        <div class="navbar">
            <a href="index.php" class="a-menu">STRONA GŁÓWNA</a>
            <a href="onas.php" title="Poznaj nas" class="a-menu">O NAS</a>
            <a href="logowanie.php" title="Przejdź do strony logowania" class="a-menu">LOGOWANIE</a>
        </div>
    </header>


    <section class="kontakt">
        Kontakt
    </section>

    <section class="kontakt-tresc">
        <h1>Kontakt</h1>
        <p> Witaj w Visual Harmony – Twojej przeglądarkowej oazie fotografii!
            <br>Cieszymy się, że jesteś z nami i chcielibyśmy mieć możliwość słyszenia od Ciebie.
            <br>Bez względu na to, czy masz pytania, sugestie, czy po prostu chcesz się z nami skontaktować, jesteśmy
            tu, aby odpowiedzieć na Twoje potrzeby.</p>
        <h1>E-mail</h1>
        <p>Jeśli wolisz wysłać nam bezpośrednią wiadomość e-mail, możesz skontaktować się z nami pod adresem:
            <br>contact@visualharmony.com.
            <br>Jesteśmy gotowi odpowiedzieć na wszelkie zapytania i uwagi.</p>
        <h1>Gdzie nas znaleźć?</h1>
        <p>Visual Harmony to miejsce, w którym pasja do fotografii spotyka się z technologią.
            <br>Nasza siedziba mieści się pod poniższym adresem:
            <br>Visual Harmony
            <br>ul. Fotograficzna 15
            <br>00-000 Miastopolis</p>
    </section>
    <br>
    <br>
    <br>
    <br>


    <section>
        <?php if(!empty($statusMsg)){ ?>
        <div class="status-msg <?php echo $status; ?>"><?php echo $statusMsg; ?></div>
        <?php } ?>

        <div class="container">
            <h1 class="contact-header">Formularz kontaktowy</h1>
            <br>
            <p>Skontaktuj się z nami już teraz!</p>
            <form action="submit_form.php" method="POST" class="form-contact">
                <label for="name" class="label-contact">Imię:</label>
                <input type="text" name="name" id="name" class="input-contact" required>
                <label for="email" class="label-contact">Email:</label>
                <input type="email" name="email" id="email" class="input-contact" required>
                <label for="subject" class="label-contact">Temat:</label>
                <input type="text" name="subject" id="subject" class="input-contact" required>
                <label for="message" class="label-contact">Wiadomość:</label>
                <textarea name="message" id="message" cols="30" rows="10" class="textarea-contact" required></textarea>
                <input type="submit" value="Wyślij" class="submit-contact">
            </form>
        </div>

        <footer>
            <div class="box">
                <div class="foot1">&copy; Copyright © 2023 Visual Harmony.
                    Created by: Natalia Jezusek, Nikola Niestrój,
                    Jacek Kozak, Daniel Łątkowski.</div>
                <div class="foot2">
                    <br>
                    <h2>VISUAL HARMONY</h2>
                    <br>
                </div>
                <div class="foot3">
                    <div class="bottom-icon">
                        <button class="regulations"><a href="regulamin.php" title="Zobacz nasz regulamin!"
                                class="footer-link">
                                <img src="img/regulations.png">
                        </button></a>
                        <h3><a href="regulamin.php" title="Zobacz nasz regulamin!" class="footer-link">Regulamin</a>
                        </h3>
                    </div>

                    <div class="bottom-icon">
                        <button class="facebook"><a href="https://www.facebook.com/profile.php?id=61553216010644"
                                class="footer-link">
                                <img src="img/facebook.png">
                        </button></a>
                        <h3><a href="https://www.facebook.com/profile.php?id=61553216010644"
                                class="footer-link">Facebook</a></h3>
                    </div>

                    <div class="bottom-icon">
                        <button class="instagram"><a href="https://www.instagram.com/harmony.visual/"
                                class="footer-link">
                                <img src="img/instagram.png">
                        </button></a>
                        <h3><a href="https://www.instagram.com/harmony.visual/" class="footer-link">Instagram</a></h3>
                    </div>
                </div>
        </footer>
</body>

</html>