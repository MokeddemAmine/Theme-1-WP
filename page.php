<?php get_header() ?>
<div class="container">
    <section class="row">

        <div class="col-lg-3">
            <?php
                if(is_active_sidebar('blog-sidebar')){
                    dynamic_sidebar('blog-sidebar');
                }
            ?>
        </div>
        <div class="col-lg-9 bg-light p-3">
        <h1><?php the_title(); ?></h1>
        <?php get_template_part('includes/section','content'); ?>
        </div>
        
    </section>


    
</div>
<?php get_footer() ?>