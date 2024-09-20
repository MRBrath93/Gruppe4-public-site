<?php
get_header();
sejr_davidsens_heroBanner();
custom_breadcrumbs();

// Henter den aktuelle side for pagination vha. en ternary operator. Hvis ingen side er angivet, sættes $paged til 1
// Dette er nødvendigt for at WP_Query kan hente de rigtige indlæg.
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

// Opretter en ny forespørgsel (WP_Query) for at hente indlæg af typen 'Hunde', pagineret, med 2 indlæg per side
$animals = new WP_Query(array(
    'posts_per_page' => 2,
    'post_type' => 'Hunde',
    'paged' => $paged
));
?>

<main>
    <!-- Filter og søgeområde (Ikke aktivt) -->
    <div class="filterSearch">
        <div class="filterButtons">
            <span class="material-symbols-outlined">tune</span>
            <a class="btn" href="#">Art</a>
            <a class="btn" href="#">Køn</a>
            <a class="btn" href="#">Internat</a>
        </div>
        <a class="btn" href="#">Søg</a>
    </div>

    <!-- Sektion der viser en gridvisning af hunde -->
    <section class="animalGrid">

        <?php
        // Looper gennem resultaterne af WP_Query (hunde-posts)
        while ($animals->have_posts()) {
            $animals->the_post();

            // Henter billedet af det enkelte dyr fra ACF-feltet
            $animalImage = get_field('billede_af_dyret');
        ?>
            <!-- Kort der viser information om hver hund -->
            <div class="animalCard">
                <a class="card-link" href="<?php the_permalink(); ?>">
                    <!-- Vi anvender esc for at vise dyrets billede og sikre at url'en er "ren" og ikke indeholder ondsindede scripts -->
                    <img src="<?php echo esc_url($animalImage['url']); ?>" alt="<?php echo esc_attr($animalImage['alt']); ?>">
                    <div class="Text--Content">
                        <p><strong>Navn: </strong><?php echo get_field('navn_pa_hund'); ?></p>
                        <p><strong>Alder: </strong><?php echo get_field('alder_pa_dyr'); ?> år</p>
                        <?php
                        // Henter og viser hundens race (kan have flere racer)
                        $races = get_field('race_pa_dyr');
                        foreach ($races as $race) {
                        ?>
                            <p><strong>Race: </strong><?php echo get_the_title($race); ?></p>
                        <?php
                        }
                        ?>
                        <!-- Viser en kort beskrivelse (20 ord) af dyret med link til at læse mere -->
                        <p><?php echo wp_trim_words(get_field('praesentation_af_dyr'), 20); ?> Læs mere</p>
                    </div>
                </a>
            </div>

        <?php
        }
        ?>
    </section>

    <!-- Pagination links for at navigere mellem sider -->
    <div class="paginateLinks">
        <?php
        // Viser links til pagination
        echo paginate_links(array(
            'total' => $animals->max_num_pages,
            'current' => $paged,
        ));
        ?>
    </div>

    <!-- Artikelsektion om adoptionsprocessen -->
    <article class="adoptionProcess">
        <h4>Adoptionsprocessen</h4>
        <div class="adoptionProcessContent">
            <div class="adoptionStep">
                <h5>1. Modtagelse af Hunden</h5>
                <p>Adoptionsprocessen begynder, når vi modtager hunden enten fra en tidligere ejer, eller som en del af en dyreværnssag. Vi sikrer, at hunden får en tryg start på sit nye liv hos os.</p>
            </div>
            <div class="adoptionStep">
                <h5>2. Sundhedstjek og Forberedelse til Adoption</h5>
                <p>Når hunden er ankommet, gennemgår den et grundigt sundhedstjek og får den nødvendige pleje.</p>
            </div>
            <div class="adoptionStep">
                <h5>3. Mød Din Potentielle Nye Hund</h5>
                <p>Når du har fundet en hund, du gerne vil adoptere, arrangerer vi et møde, hvor du kan lære hunden at kende.</p>
            </div>
            <div class="adoptionStep">
                <h5>4. Vurdering og Samtale</h5>
                <p>Efter jeres møde tager vi en snak med dig om dine indtryk og vurderer, om hunden passer godt ind i dit hjem.</p>
            </div>
            <div class="adoptionStep">
                <h5>5. Adoptionsaftale</h5>
                <p>Hvis alt går godt, og du beslutter dig for at adoptere, udarbejder vi en adoptionsaftale.</p>
            </div>
            <div class="adoptionStep">
                <h5>6. Opfølgning og Støtte</h5>
                <p>Efter adoptionen holder vi kontakt for at sikre, at alt går godt.</p>
            </div>
        </div>
    </article>

    <!-- Sektion med reklame for hundetræning -->
    <section class="brownCard">
        <img src="<?php echo get_theme_file_uri('./images/Dog_jumping_over_a_fence-1024x762.JPG') ?>" alt="Hund der springer over hegn til træning">
        <div class="brownCard-content">
            <h2 class="brownCard-title">Vil du give din nye hund den bedste start med hundetræning?</h2>
            <p class="brownCard-text">Hos Sejr & Davidsens Dyrepension tilbyder vi hundetræning. Find dit næste hold her.</p>
            <span class="brownCard-text"><a class="btn btn-brownCard" href="#">Find et træningshold</a></span>
        </div>
    </section>
</main>

<?php
get_footer();
?>