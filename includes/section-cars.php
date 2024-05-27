<?php
    if(have_posts()){
        while(have_posts()){
            the_post();?>

        <div>
            <i class="fa-regular fa-calendar"></i>
            <?php echo get_the_date() ?>
        </div>
        <?php the_content() ?>

        <?php
        $fname = get_the_author_meta('first_name');
        $lname = get_the_author_meta('last_name');
        ?>
        <p>Posted by <?php echo $fname.' '.$lname; ?></p>
        <?php
        $tags = get_the_tags();
        if($tags){
        foreach($tags as $tag){?>
            <a href="<?php echo get_tag_link($tag->term_id); ?>" class="badge badge text-bg-warning">
                <?php echo $tag->name; ?>
            </a>
        <?php }} ?>

        <div class="my-3">
        <?php 
        $categories = get_the_category();
        foreach($categories as $category){?>
            <a href="<?php echo get_category_link($category->term_id) ?>" class="badge text-bg-danger">
                <?php echo $category->name ?>
            </a>
        <?php } ?>
        </div>

        <?php comments_template(); ?>
<?php
        }
    }