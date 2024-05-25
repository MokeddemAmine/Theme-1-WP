<?php get_header() ?>
<div class="container my-4">

    <h1><?php the_title(); ?></h1>

    <?php get_template_part('includes/section','content'); ?>

    <?php get_search_form(); ?>

</div>
<?php get_footer() ?>