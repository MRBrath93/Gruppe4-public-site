<footer>
    <div class="footer-info">
        <a href="<?php echo site_url() ?>">
            <h1 class="logo">Sejr & Davidsens</h1>
            <h1 class="logo">Dyrepension og Internat</h1>
        </a>
        <div class="contact-item">
            <div class="footer-contact-title">
                <span class="material-symbols-outlined">location_on</span>
            </div>
            <div>
                <p>Hundeallé 1</p>
                <p>9000 Aalborg</p>
            </div>
        </div>
        <div class="contact-item">
            <div class="footer-contact-title">
                <span class="material-symbols-outlined">phone_iphone</span>
            </div>
            <div>
                <p>Ring til os på</p>
                <p>36 23 89 08</p>
            </div>
        </div>
        <div class="contact-item">
            <div class="footer-contact-title">
                <span class="material-symbols-outlined">mail</span>
            </div>
            <div>
                <p>sejrogdavidsen@gmail.com</p>
            </div>
        </div>
    </div>

    <div class="footer-links">
        <div>
            <a class="hover-styling" href="<?php the_permalink(); ?>"><span class="material-symbols-outlined">book_online</span>Book ophold i hundepension</a>
        </div>
        <div>
            <a class="hover-styling" href="<?php the_permalink(); ?>"><span class="material-symbols-outlined">sports</span>Book hundetræning</a>
        </div>
        <div>
            <a class="hover-styling" href="<?php the_permalink(71); ?>"><span class="material-symbols-outlined">pets</span>Adoptér en hund</a>
        </div>
        <div>
            <a class="hover-styling" href="<?php the_permalink(); ?>"><span class="material-symbols-outlined">sound_detection_dog_barking</span>Kontakt internat</a>
        </div>
    </div>

    <div class="footer-hours">
        <div class="footer-hours-title">
            <p>Åbningstider <span class="material-symbols-outlined">schedule</span></p>
        </div>
        <ul>
            <li>Mandag 8:00-21:00</li>
            <li>Tirsdag 8:00-21:00</li>
            <li>Onsdag 8:00-21:00</li>
            <li>Torsdag 8:00-21:00</li>
            <li>Fredag 8:00-22:00</li>
            <li>Lørdag 8:00-22:00</li>
            <li>Søndag 7:00-21:00</li>
        </ul>
    </div>

    <div class="footer-sponsors">
        <div class="footer-sponsors-title">
            <p>Sponsorer</p>
        </div>
        <img src="<?php echo get_theme_file_uri('./images/PetShop_logo-150x150.jpg') ?>" alt="sponsor1" loading="lazy">
        <img src="<?php echo get_theme_file_uri('./images/sponsor2-150x150.jpg') ?>" alt="sponsor2" loading="lazy">
    </div>

</footer>
<!-- call function that loads wp-admin bar at the top of the page -->
<?php wp_footer(); ?>

</body>

</html>