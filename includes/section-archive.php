<?php
    if(have_posts()){
        while(have_posts()){
            the_post();?>
    <div class="card my-3">
        <div class="card-body d-flex justify-content-center align-items-center">
            <?php if(has_post_thumbnail()){ ?>
                <img src="<?php the_post_thumbnail_url('blog-small'); ?>" alt="<?php the_title() ?>" class="img-responsive img-thumbnail w-50 me-4">
            <?php } ?>
            <div class="blog-content">
                <h3><?php the_title() ?></h3>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink() ?>" class="text-capitalize btn btn-warning btn-sm fw-bold">read more</a>
            </div>
        </div>
    </div>
    
<?php
        }
    }