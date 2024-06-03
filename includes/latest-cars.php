<?php
    $args = [
        'post_type'     => 'cars',
        // 'meta_key'      => 'color',
        // 'meta_value'    => 'black',
        'posts_per_page'=> 2,    
    ];

    $query = new WP_Query($args);
?>

<?php 
    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();
    ?>
    <div class="card mb-3">
        <div class="card-body">
            <h3><?php the_title() ?></h3>
            <?php the_field('registration'); ?>
        </div>
    </div>
    <?php
        }
    }
?>