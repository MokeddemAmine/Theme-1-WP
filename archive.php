<?php get_header() ?>
<div class="container">
    <section class="row">
        <div class="col-lg-3">
            <?php
                if(is_active_sidebar('main-sidebar')){
                    dynamic_sidebar('main-sidebar');
                }
            ?>
        </div>
        <div class="col-lg-9">
        <?php get_template_part('includes/section','archive'); ?>

        <?php previous_posts_link() ?>
        <?php next_posts_link(); ?>
        </div>
    </section>
    
    
    <!-- <?php
    global $wp_query ;
    $big = 9999999;
    echo paginate_links(array(
        'base'      => get_pagenum_link().'%_%',
        'format'    => 'page/%#%',
        'current'   => max(1,get_query_var('paged')),
        'total'     => $wp_query->max_num_pages
    ));
    ?> -->
</div>
<?php get_footer() ?>