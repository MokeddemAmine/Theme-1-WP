<?php get_header() ?>

<div class="container my-4">

    <h1><?php the_title(); ?></h1>
    
    <?php if(has_post_thumbnail()){ ?>
        <img src="<?php the_post_thumbnail_url('blog-large'); ?>" alt="<?php the_title() ?>" class="img-responsive img-thumbnail">
    <?php } ?>

    

    <?php get_template_part('includes/section','cars'); ?>
    <?php wp_link_pages(); ?>
    <ul>
        <?php if(get_post_meta($post->ID,'color',true)){ ?>
            <li>
                Color:
                <?php echo get_post_meta($post->ID,'color',true) ?>
            </li>
        <?php } ?>
        
        <?php if(get_post_meta($post->ID,'registration',true)){ ?>
            <?php the_field('registration'); ?>
            <li>
                Registration:
                <?php echo get_post_meta($post->ID,'registration',true) ?>
            </li>
        <?php } ?>
    </ul>

    <div>
        <?php get_template_part('includes/form','enquiry'); ?>
    </div>

    
</div>

<?php get_footer() ?>