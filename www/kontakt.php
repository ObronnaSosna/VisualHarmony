<!DOCTYPE html>
<html lang="pl">
<?php require_once(__DIR__.'/frame/head.php'); ?>
<?php require_once(__DIR__.'/frame/topBar.php'); ?>
<body>
    <section class="kontakt">
        Kontakt
    </section>

    <section class="kontakt-tresc">
        <h1>Kontakt</h1>
        <p class="p-kontakt"></p> Witaj w Visual Harmony – Twojej przeglądarkowej oazie fotografii!
            <br>Cieszymy się, że jesteś z nami i chcielibyśmy mieć możliwość słyszenia od Ciebie.
            <br>Bez względu na to, czy masz pytania, sugestie, czy po prostu chcesz się z nami skontaktować, jesteśmy
            tu, aby odpowiedzieć na Twoje potrzeby.</p>
        <h1>E-mail</h1>
        <p>Jeśli wolisz wysłać nam bezpośrednią wiadomość e-mail, możesz skontaktować się z nami pod adresem:
            <br>contact@visualharmony.com.
            <br>Jesteśmy gotowi odpowiedzieć na wszelkie zapytania i uwagi.</p>
        <h1>Gdzie nas znaleźć?</h1>
        <p class="p-kontakt"></p>Visual Harmony to miejsce, w którym pasja do fotografii spotyka się z technologią.
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
            <p class="p-kontakt">Skontaktuj się z nami już teraz!</p>
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
</body>
<?php require_once(__DIR__.'/frame/footer.php'); ?>
</html>
