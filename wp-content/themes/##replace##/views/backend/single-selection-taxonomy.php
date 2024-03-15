<?php

use Staempfli\Theme;

wp_nonce_field($taxonomy->getTaxonomy() . '_nonce', $taxonomy->getTaxonomy() . '_nonce');

?>

<p><strong><?php _e('Auswahl', Theme::TEXT_DOMAIN); ?></strong></p>

<select name="<?php echo $taxonomy->getTaxonomy(); ?>" id="<?php echo $taxonomy->getTaxonomy(); ?>" style="width: 100%;">
    <?php foreach($taxonomy->getAll() as $term): ?>
        <option value="<?php echo $term->term_id;?>"<?php echo ($term->term_id === $currentId ? ' selected="selected"' : ''); ?>><?php echo $term->name; ?></option>
    <?php endforeach; ?>
</select>
