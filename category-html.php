<?php get_header() ?>
<div class="container">

    <h1 class="text-center text-warning my-3"><?php single_cat_title() ?></h1>

    <?php get_template_part('includes/section','archive'); ?>
    
    <?php
    global $wp_query ;
    $big = 9999999;
    echo paginate_links(array(
        'base'      => get_pagenum_link().'%_%',
        'format'    => 'page/%#%',
        'current'   => max(1,get_query_var('paged')),
        'total'     => $wp_query->max_num_pages
    ));
    ?>
</div>
<?php get_footer() ?>