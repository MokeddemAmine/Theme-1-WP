<?php get_header() ?>

<div class="container">
    <h1 class="text-center my-3">Search Results for '<?php echo get_search_query(); ?>'</h1>
    <section class="row">
        <div class="col">
        <?php get_template_part('includes/section','searchresults'); ?>

        <?php previous_posts_link() ?>
        <?php next_posts_link(); ?>
        </div>
    </section>
</div>

<?php get_footer() ?>