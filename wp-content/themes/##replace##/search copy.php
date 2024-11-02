<?php

use Staempfli\Theme;

get_header();

?>
    <main id="primary" class="site-main">
        <div class="container">
            <?php if (empty($posts)) : ?>

                <p><?php _e('Es wurden keine Suchresultate gefunden', 'tiptopf'); ?></p>

            <?php else : ?>
                <table class="index-table">
                    <?php
                        foreach(Theme::getAllPostsLazy('any', 10, 'publish', ['s' => get_search_query()]) as $lazyPosts) {
                            foreach($lazyPosts as $post) {
                                Theme::includeTemplate('recipe/list-entry', ['recipe' => $post]);
                            }
                        }
                    ?>
                </table>
            <?php endif; ?>
        </div>
    </main>
<?php
get_sidebar();
get_footer();
