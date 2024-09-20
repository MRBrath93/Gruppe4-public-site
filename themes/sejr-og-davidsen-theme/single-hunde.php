<?php
get_header();
custom_breadcrumbs();


while (have_posts()) {
    the_post();
}
?>
<a class="returnBtn" href="<?php echo site_url('/internat-og-adoption/dyr-til-adoption') ?>">«<span class="material-symbols-outlined">
        home
    </span> Dyr til adoption</a>
<h1 class="mops"><?php echo get_field('navn_pa_hund'); // trækker værdien, som i dette tilfælde er, navn, fra et custom field som er lavet i acf 
                    ?></h1>
<section class="mops-present">
    <div>
        <h5 class="mops-h">Præsentation</h5>
        <div>
            <p><?php echo get_field('praesentation_af_dyr'); ?> </p>
            <section class="profile-details">
                <div class="details">
                    <p><strong>Alder:</strong> <?php echo get_field('alder_pa_dyr'); ?> år</p>
                    <?php
                    $races = get_field('race_pa_dyr'); // $races vil holde data fra det custom field det er lavet, som er en race liste
                    if ($races) { // Vi bruger en "if" statement til at tjekke om der er data i $races. Hvis statementet er sandt bliver efterfølgende linje kode udført.
                        foreach ($races as $race) { // Her går vi igennem loopet af $races vha. foreach. For hver enkelt race i vores liste af racer, vil vi udføre koden nedenfor.
                            echo '<p><strong>Race:</strong> ' . (get_the_title($race->ID)) . '</p>'; // Vi echoer en paragraph hvor vi viser titel fra den enkelte race ud fra dens ID.
                        }
                    }
                    ?>


                    <p><strong>Vægt:</strong> <?php echo get_field('vaegt_pa_dyr'); ?> kg</p>
                    <p><strong>Højde:</strong> <?php echo get_field('hojde_pa_dyr'); ?> cm</p>
                    <p><strong>Vaccineret:</strong> <?php echo get_field('er_dyret_vaccineret'); ?></p>
                    <p><strong>Chippet:</strong> <?php echo get_field('er_dyret_chippet'); ?></p>
                    <p><strong>FCI-Gruppe:</strong> <?php echo get_field('fci_gruppe'); ?></p>
                    <p><strong>Farve:</strong> <?php echo get_field('farve'); ?></p>

                    <?php
                    // Vi laver et if/else statement, som tjekker om der er en race tilknyttet hunden. 
                    // Hvis der er, så skifter vi til racen og viser dens data.
                    // Hvis der ikke er en race, så vises en besked om, at der ikke er en race tilknyttet hunden.
                    // Da vi ønsker at vise data fra to forskellige posttypes (hunde og racer), skal vi bruge setup_postdata() for at skifte posttype.
                    if ($races) {
                        foreach ($races as $single_race) {
                            $race_id = $single_race->ID; // Race-ID'et gemmes i en variabel, så det kan bruges senere
                            // Setup postdata for race-posten. Vi skifter posttype fra "hunde" til "racer" 
                            setup_postdata($single_race);

                            // Output racens data
                    ?>

                            <p><strong>Allergivenlig:</strong> <?php echo get_field('allergivenlig', $race_id) ?></p>
                            <p><strong>Gennemsnitlig levealder:</strong> <?php echo get_field('gennemsnits_levealder', $race_id) ?> år</p>

                    <?php
                        }
                    } else {
                        echo '<p>Ingen race tilknyttet denne hund.</p>';
                    }
                    ?>
                </div>
            </section>
            <a class="btn">Book videomøde</a>
            <a class="btn mops-btn">Book fysisk møde</a>
            <a class="btn">Kontakt os</a>
        </div>
    </div>

    <div class="front-mops">
        <!-- Billede af hunden
                 Vha. et if/else statement tjekker vi om der er et billede af dyret i WP, og hvis der er, så vises det. Hvis ikke, så vises et fallback-billede
                  -->
        <?php
        if (get_field('billede_af_dyret')) { // Tjekker om det er findes et billede, som er i et acf som hedder billede_af_dyret
            $animalImage = get_field('billede_af_dyret'); // Gemmer variabel af billedet, som så kan bruges senere
        ?>
            <img class="front-mops" src="<?php echo esc_url($animalImage['url']) ?>" alt="<?php echo esc_attr($animalImage['alt']) // Her udskriver vi billedets URL og alt-attribut ved at bruge variablen $animalImage, som indeholder information om billedet
                                                                                            ?>">
        <?php
        } else {
            // Fallback image, hvis der ikke er et billede
            echo '<img src="' . get_theme_file_uri('./images/fallback_image.jpg') . '" alt="Billede undervejs">';
        }
        ?>
    </div>
</section>

<div class="dog-container">
    <div class="left-column">
        <!-- Her får vi udskrevet nogen specifikke felter for en bestem race ved hjælp af acf og $race_id  -->
        <h3>Racebeskrivelse</h3>
        <p> <?php echo get_field('racebeskrivelse', $race_id); ?></p>

        <h4>Plejeniveau</h4>
        <p><?php echo get_field('plejebeskrivelse', $race_id); ?></p>

        <h4>Aktivitetsniveau</h4>
        <p><?php echo get_field('aktivitetsbeskrivelse', $race_id); ?></p>

        <h4>Lydighedsniveau</h4>
        <p><?php echo get_field('lydighedsbeskrivelse', $race_id); ?></p>
    </div>
    <div class="right-column">
        <div class="gridForScales">
            <div class="info-box">
                <p>Familievenlig:</p>
                <div class="box-container">
                    <?php
                    // variablen familievenlig repræsenterer en værdi mellem 1-5, som er hentet fra ACF-feltet "familievenlig" på racen.
                    $familievenlig = get_field('familievenlig', $race_id);

                    // For-loop med et if/else der udskriver ratingen (i form af udfyldte og tomme bokse) for familievenlighed
                    // Loopet er nødvendigt for at omstille værdien fra WP til en visuel skala i HTML
                    for ($i = 1; $i <= 5; $i++) { // loopet kører 5 gange og starter ved 1, og for hver gang den kører, skal den ligge én til værdien af $i
                        if ($i <= $familievenlig) { // tjekker vi om $i er mindre end eller lig med værdien af $familievenlig, så indsættes én fyldt boks pr. gang koden kører.
                            echo '<div class="box filled"></div>';
                        } else {
                            echo '<div class="box"></div>'; // hvis betingelserne ikke er opfyldt så indsættes en tom boks pr. gang koden kører.
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="info-box">
                <p>Pelspleje:</p>
                <div class="box-container">
                    <?php
                    $pelspleje = get_field('pelspleje', $race_id);

                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $pelspleje) {
                            echo '<div class="box filled"></div>';
                        } else {
                            echo '<div class="box"></div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="info-box">
                <p>Aktivitetsniveau:</p>
                <div class="box-container">
                    <?php
                    $aktivitetsniveau = get_field('aktivitetsniveau', $race_id);

                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $aktivitetsniveau) {
                            echo '<div class="box filled"></div>';
                        } else {
                            echo '<div class="box"></div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="info-box">
                <p>Temperament:</p>
                <div class="box-container">
                    <?php
                    $temperament = get_field('temperament', $race_id);

                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $temperament) {
                            echo '<div class="box filled"></div>';
                        } else {
                            echo '<div class="box"></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="race-mops">
            <?php
            $raceImage = get_field('billede_af_dyret', $race_id);
            ?>
            <img class="front-mops img" src="<?php echo esc_url($raceImage['url']) ?>" alt="<?php echo esc_attr($raceImage['alt']) ?>">
        </div>
    </div>

</div>

<?php
wp_reset_postdata();
?>



<section class="image-box">
    <h2>Læs om de andre dyr på vores internat</h2>
    <div class="image-container">

        <?php
        // en WP_Query der henter de seneste 4 posts(hunde) fra databasen
        $recent_posts_query = new WP_Query(array(
            'posts_per_page' => 4, // Antallet af posts
            'post_type' => 'Hunde', // Posttypen (her standard "post")
            'orderby' => 'date', // Sortér efter dato
            'order' => 'DESC' // Sortér i faldende rækkefølge (nyeste først)
        ));

        while ($recent_posts_query->have_posts()) { // tjekker om det er posts, som vi laver fra vores custom query som har variabel navn $recent_post_query og køre så længe det er posts
            $recent_posts_query->the_post(); // Henter information fra det næste indlæg som skal hentes.
            $recent_postsImage = get_field('billede_af_dyret') ?> <!-- Her henter vi værdien af et felt i acf som har navnet billdet_af_dyret-->
            <a href="<?php echo get_permalink(); ?>"> <!-- Her echo vi, til at udskrive URL'en til det aktuelle indlæg ved hjælp af WordPress-funktionen get_permalink() -->
                <img src="<?php echo esc_url($recent_postsImage['url']) ?>" alt="<?php echo esc_attr($recent_postsImage['alt']) ?>">
                <h5><?php echo get_field('navn_pa_hund'); ?></h5>
            </a>
        <?php
        }
        ?>

    </div>

</section>

<?php get_footer(); ?>