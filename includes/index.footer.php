<footer id="contact" class="footer" style="position: relative">
    <h2 class="contact-title">Contact me</h2>
    <div class="contact-container">
        <!-- <img src="./skills/contact_me-photo.png" alt="" class="img-contact" /> -->
        <div class="form_container">
            <form action="index.php" method="POST" class="form">
                <div class="phone_to_name">
                    <div class="form-control">
                        <label for="name" class="label zero">Name</label>
                        <input type="text" name="name" id="name" class="inputs">
                    </div>
                    <div class="form-control">
                        <label for="phone_number" class="one">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" class="inputs">
                    </div>
                </div>
                <div class="form-control">
                    <label for="email" class="two">Email</label>
                    <input type="email" name="email" id="email" class="inputs" required>
                </div>
                <div class="form-control form-relative">
                    <label for="contact_message" class="three">Your Message</label>
                    <textarea name="contact_message" id="contact_message" cols="40" rows="8" required></textarea>
                    <input type="submit" name="send" value="SEND" class="input-submit">
                </div>
                <span class="warning2"></span>
            </form>
        </div>
        <div class="contact-detail">
            <a href="tel:+251912035350"><i class="fa fa-phone"></i><strong>Phone</strong></a>
            <a href="mailto:ephrem5350@gmail.com" target="_blank"><i class="fa fa-envelope"></i><strong>Email</strong></a>
            <a href="https://t.me/tanchwedia" target="_blank"><i class="fa fa-telegram"></i><strong>Telegram</strong></a>
        </div>
    </div>
    <a href="__.pdf" download class="cv">Download CV <i class="fa fas fa-download"></i></a>
    <a href="#nav">
        <button class="up-arrow">
            <img src="up-arrow.png" style="width: 80%" /></button></a>
</footer>
<section class="copyright">
    <p>&copy; copyright <span>2023</span></p>
</section>
<script src="index.js"></script>
<script src="contact.js"></script>
<script src="theme.js"></script>
</body>

</html>