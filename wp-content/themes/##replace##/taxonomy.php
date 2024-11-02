<?php

use Staempfli\Theme;

$additionalArgs = [];
$additionalArgs['tax_query'] = [
    [
        'taxonomy' => get_queried_object()->taxonomy,
        'field'    => 'term_id',
        'terms'    => [get_queried_object()->term_id],
        'compare' => 'IN'
    ]
];

get_header();

?>
    <main id="primary" class="site-main">
        <div class="container">
            <?php Theme::includeTemplate('recipe/overview'); ?>
            <div class="section filter-sort">
                <?php Theme::includeTemplate('recipe/sort'); ?>
                <?php Theme::includeTemplate('recipe/filter'); ?>
                
            </div>
            <table class="index-table">
                <?php
                    foreach(Theme::getAllPostsLazy('post', 10, 'publish', $additionalArgs) as $lazyPosts) {
                        foreach($lazyPosts as $post) {
                            Theme::includeTemplate('recipe/list-entry', ['recipe' => $post]);
                        }
                    }
                ?>
            </table>
        </div>
    </main>
<?php
get_sidebar();
get_footer();