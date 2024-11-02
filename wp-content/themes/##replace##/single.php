<?php

use Staempfli\Objects\Recipe;
use Staempfli\Objects\Ingredient;
use Staempfli\Theme;

get_header();

$recipe = new Recipe($post);

?>

<main id="primary" class="site-main">
    <div class="container container-small">
        <div class="action-buttons flex">
                <?php Theme::includeTemplate('recipe/overview'); ?>
                <p class="button"><?php echo edit_post_link(__('Bearbeiten', 'tiptopf'), '', '', $recipe->post->ID); ?></p>
                <button onclick="window.print();"><?php _e('PDF', 'tiptopf'); ?></button>
        </div>
        <div class="section print-hide">
            <div class="stats-table">
                <div class="table-row"><div><?php _e('Rezepttyp:', 'tiptopf'); ?></div><div><?php echo $recipe->getRecipeType(); ?></div></div>
                <div class="table-row"><div><?php _e('Status:', 'tiptopf'); ?></div><div><?php echo $recipe->getState(); ?></div></div>
                <div class="table-row"><div><?php _e('Zeitaufwand:', 'tiptopf'); ?></div><div><?php echo $recipe->getPreparationTime(); ?><br><?php $recipe->printPreparationTimesForTable(); ?></div></div>
                <div class="table-row"><div><?php _e('Kategorien:', 'tiptopf'); ?></div><div><?php $recipe->printTermNames('category'); ?></div></div>
                <div class="table-row"><div><?php _e('Zubereitungsarten:', 'tiptopf'); ?></div><div><?php $recipe->printTermNames('preparation_method'); ?></div></div>
                <div class="table-row"><div><?php _e('Gerätschaften:', 'tiptopf'); ?></div><div><?php $recipe->printEquipmentNames(); ?></div></div>
                <div class="table-row"><div><?php _e('Ernährungsformen:', 'tiptopf'); ?></div><div><?php $recipe->printDiets(); ?></div></div>
                <div class="table-row"><div><?php _e('Region:', 'tiptopf'); ?></div><div><?php $recipe->printRegion(); ?></div></div>
                <?php if (!empty($recipe->getCanton())) : ?>
                    <div class="table-row"><div><?php _e('Kanton:', 'tiptopf'); ?></div><div><?php echo $recipe->getCanton()['label']; ?></div></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="print-only">
            <h4><?php the_title(); ?></h4>
        </div>

        <?php if ($recipe->post->post_parent) : ?>
            <div class="section recipe-variant">
                <?php _e('Das ist eine Rezeptvariante vom Rezept:', 'tiptopf'); ?><br>
                <a href="<?php echo get_permalink($recipe->post->ID); ?>"><?php echo get_the_title($recipe->post->ID); ?></a>
            </div>
        <?php endif; ?>

        <?php if ($recipe->getImage()) : ?>
            <div class="section print-hide">
                <img class="recipe-thumbnail" src="<?php echo $recipe->getImage('large'); ?>" loading="lazy">
            </div>
        <?php endif; ?>

        <div class="section">
            <div class="steps-table">
                <?php foreach($recipe->getSteps() as $stepData) : ?>
                    <div class="table-row">
                        <?php if(!empty($stepData['title'])) : ?>
                            <div class="title">
                                <strong><?php echo $stepData['title']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <?php if($stepData['mise_en_place']) : ?>
                            <div class="mise-en-place">
                                <span><?php _e('Mise en place', 'tiptopf'); ?></span>
                            </div>
                        <?php endif; ?>
                            <div class="content">
                                <div class="ingredients">
                                <?php if ($stepData['ingredients']) : ?>
                                    <?php foreach($stepData['ingredients'] as $ingredientData) : ?>
                                        <?php $ingredient = new Ingredient($ingredientData); ?>
                                        <div class="amounts">
                                            <div class="small-amount">
                                                <img src="https://dummyimage.com/250x50/dddddd/dddddd" class="background-eee">
                                                <?php $ingredient->printSmallAmount(); ?>
                                            </div>
                                            <div class="amount">
                                                <img src="https://dummyimage.com/250x50/cccccc/cccccc" class="background-eee">
                                                <?php $ingredient->printAmount(); ?>
                                            </div>
                                            <div class="ingredient">
                                                <img src="https://dummyimage.com/250x50/bbbbbb/bbbbbb" class="background-eee">
                                                <?php $ingredient->printIngredient(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="description">
                                <?php echo $stepData['description']; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="section">
            <?php if($recipe->getTips()) : ?>
                <h5><?php _e('Tipp', 'tiptopf'); ?></h5>
                <div class="tipp">
                    <?php echo $recipe->getTips(); ?>
                </div>
            <?php endif; ?>

            <?php if($recipe->getVegiTips()) : ?>
                <h5><?php _e('Vegitipp', 'tiptopf'); ?></h5>
                <div class="vegitipp">
                    <?php echo $recipe->getVegiTips(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_sidebar();
get_footer();