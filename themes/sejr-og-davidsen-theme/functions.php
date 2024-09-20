<?php
// ---- FUNKTIONER ----

// Function for custom heroBanner til forsiden
// I funktionen hentes billedet fra ACF-feltet 'hero_banner_background_image' og viser det på siden hvor funktionen kaldes
function sejr_davidsens_heroBanner_Frontpage()
{
    $pageBanner = get_field('hero_banner_background_image');
?>
    <div class="heroBanner">
        <img src="<?php echo esc_url($pageBanner['url']) ?>" alt="<?php echo esc_attr($pageBanner['alt']) ?>">
        <div class="pageBanner-text-front">
            <h1 class="titleForFrontpage"><?php echo get_field('hero-banner-title'); ?></h1>
            <h2 class="subtitleForFrontpage"><?php echo get_field('hero_banner_subtitle'); ?></h2>
        </div>
    </div>
    <?php
}

// Funktion for custom heroBanner til øvrige sider
function sejr_davidsens_heroBanner()
{
    $pageBanner = get_field('hero_banner_background_image'); // Hent ACF feltet og gemme det i variablen $pageBanner

    // Tjek om billedet er sat i ACF-feltet
    if ($pageBanner) {
        // Hent billedets ID fra ACF-feltet og gem det i variablen $bannerImageID
        $bannerImageID = $pageBanner['ID'];

        // Vi laver en variabel $bannerImage. Heri gemmer vi ID'ets-billede-URL i den ønskede størrelse (bannerImage)
        $bannerImage = wp_get_attachment_image_src($bannerImageID, 'bannerImage');
    ?>
        <div class="heroBanner">
            <img src="<?php echo esc_url($bannerImage[0]); ?>" alt="<?php echo esc_attr($pageBanner['alt']); ?>">
            <div class="pageBanner-text">
                <h1 class="titleForPage"><?php echo esc_html(get_field('hero-banner-title')); ?></h1>
                <h2 class="subtitleForPage"><?php echo esc_html(get_field('hero_banner_subtitle')); ?></h2>
            </div>
        </div>
<?php
    }
}


// Function for stylesheets
function sejr_davidsens_files()
{
    wp_enqueue_script('sejr_davidsens_main_scripts', get_theme_file_uri('/script/main.js'), NULL, '1.0', true);
    wp_enqueue_style('sejr_davidsens_main_styles', get_theme_file_uri('/css/base.css'));
    wp_enqueue_style('font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', array(), NULL);
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Mina:wght@400;700&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', array(), NULL);
}


// FUNKTION TIL BREADCRUMBS

function custom_breadcrumbs()
{
    // Separator mellem brødkrumme links
    $separator = ' » ';

    // Array til at holde forældersider
    $parents = [];

    // gem ID for den nuværende post
    $current_post_id = get_the_ID();

    // Vi henter hierarki af forældersider vha. et while-loop 
    while ($current_post_id) {
        // Få forælder-ID for den nuværende post
        $parent_id = wp_get_post_parent_id($current_post_id);

        // Hvis der er en gyldig forælder, tilføj den til arrayet
        // Vi laver et if/else statement der undersøger om $parent_id er "true" og at $parent_id ikke er 0 eller det samme som den nuværende post
        // Hvis dette er tilfældet, tilføjes $parent_id til arrayet $parents
        if ($parent_id && $parent_id !== 0 && $parent_id !== $current_post_id) {
            $parents[] = $parent_id;
            // Sæt den aktuelle post til forælderens ID for at fortsætte op i hierarkiet
            $current_post_id = $parent_id;
        } else {
            // Stop hvis der ikke er flere forældre
            break;
        }
    }

    // Vis $parents ikke er tom, indsættes en div med brødkrummer
    if (!empty($parents)) {
        // Start brødkrumme-div
        echo '<div class="breadcrumbs">';

        // Vend forældre-arrayet så vi viser den øverste forælder først
        $parents = array_reverse($parents);

        // Vi laver et foreach-loop der kører gennem forældrene og opretter links
        foreach ($parents as $parent_id) {
            // Lav et link for hver forælderside med dens titel og separator
            echo '<a href="' . get_permalink($parent_id) . '">' . get_the_title($parent_id) . $separator . '</a>';
        }

        // Tilføj den nuværende post som sidste element i brødkrummestien
        echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';

        // Luk brødkrumme-div
        echo '</div>';
    }
}

// Function for title tag in browser 
function sejr_davidsens_features()
{
    add_theme_support('title-tag'); // administrere titel-tag i browser 
    add_image_size('bannerImage', 1920, 474, true); // Tilføjer en custom image size til bannerImage
}


// ---- ADD_ACTIONS -----

// Add stylesheets
add_action('wp_enqueue_scripts', 'sejr_davidsens_files');

// Add title tag via WordPress event
add_action('after_setup_theme', 'sejr_davidsens_features');

// Add custom post types
add_action('init', 'sejr_og_davidsen_posttypes');
