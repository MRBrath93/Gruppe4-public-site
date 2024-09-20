<!-- ARKIVSIDE - INDEHOLDER ALLE ARTIKLER-->
<?php
get_header();
sejr_davidsens_heroBanner();

?>
<main>
    <h1 class="titleForPage archiveTitle">Arkiv: Alle Artikler</h1>
    <?php

    // Vi laver et WP_Query, som henter alle artikler fra kategorien 'alle_artikler' i vores custom-post-type 'nyheder'. 
    // Vi skriver et array, som henter 4 artikler ad gangen, og sortere dem efter dato i stigende rækkefølge
    $articles = new WP_Query(
        array(
            'category_name' => 'alle_artikler',
            'post_type' => 'nyheder',
            'posts_per_page' => 4,
            'orderby' => 'date',
            'order' => 'ASC',
        )
    );
    // Vi laver en while-loop, som kører igennem alle artiklerne fra ovenstående, og henter for hver artikel: billede, forfatter, dato, kategori, titel og indhold (trimmet til 25 tegn)
    while ($articles->have_posts()) {
        $articles->the_post();
        $image_url = get_field('billede')['url'];
        $image_alt = get_field('billede')['alt'];
    ?>
        <div class="introText flex-item">
            <div>
                <img class="article-img" src="<?php echo esc_url($image_url) ?>" alt="<?php echo $image_alt; ?>"
                    loading="lazy">
            </div>
            <div class="random-news-section">
                <p class="article-styling">Skrevet af <span class="bold-styling"><?php the_author_posts_link(); ?></span> d. <?php the_time('n.j.y'); ?>
                    i <span class="bold-styling"><?php echo get_the_category_list(','); ?></span>
                </p>

                <h5 class="news-black-text"><?php the_title(); ?></h5>
                <div class="dogtype-styling">
                    <p><?php echo wp_trim_words(get_field('indhold'), 25); ?></p>
                    <a class="readmore-link" href="<?php the_permalink(); ?>">Læs mere</a>
                </div>
                <hr class="section-break">
            </div>
        </div>


    <?php
    }
    echo paginate_links();

    wp_reset_postdata();
    ?>
    <div class="archive-container">
        <h5 class="news-black-text">Gå tilbage til:</h5>
        <a href="<?php echo site_url() ?>" class="btn">Forside</a>
    </div>


</main>

<?php
get_footer();
?>