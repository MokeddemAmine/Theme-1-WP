<?php
/*
Template Name: Car Search
*/
$brands = get_terms([
    'taxonomy'      => 'brands',
    'hide_empty'    => false,
]);

$is_search = count($_GET);
?>

<?php get_header(); ?>

<section class="page-wrap">
    <div class="container my-3">
        <div class="card">
            <div class="card-body">
                <form action="<?php echo home_url('/car-search') ?>">
                    <div class="form-group my-3">
                        <label class="mb-2">Type a keyword</label>
                        <input 
                            type="text" 
                            name="keyword" 
                            placeholder="Type a keyword" 
                            class="form-control"
                            value="<?php if(isset($_GET['keyword'])) echo $_GET['keyword']; ?>"
                        />
                    </div>
                    <div class="form-group my-3">
                        <label class="mb-2">Chose a brand</label>
                        <select name="brand" class="form-select">
                            <option value="">None</option>
                            <?php foreach($brands as $brand){ ?>
                                    <option 
                                        <?php if(isset($_GET['brand']) && $_GET['brand'] == $brand->slug){ ?>
                                                selected
                                        <?php } ?>
                                        value="<?php echo $brand->slug ?>">
                                        <?php echo $brand->name; ?>
                                    </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group row my-3">
                        <div class="col-lg-6">
                            <label>From price</label>
                            <select name="price_above" class="form-select">
                                <?php for($i = 0; $i <= 50000 ; $i+=2000){ ?>
                                        <option value="<?php echo $i ?>"
                                            <?php if(isset($_GET['price_above']) && !empty($_GET['price_above']) && $_GET['price_above'] == $i){ echo 'selected'; }  ?>
                                        >
                                            <?php echo '$'.number_format($i) ?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label>To price</label>
                            <select name="price_below" class="form-select">
                                <?php for($i = 0; $i <= 50000 ; $i+=2000){ ?>
                                        <option value="<?php echo $i ?>"
                                        <?php if(isset($_GET['price_below']) && !empty($_GET['price_below']) && $_GET['price_below'] == $i){ echo 'selected'; }elseif($i == 50000) echo 'selected'  ?>
                                        >
                                            <?php echo '$'.number_format($i) ?>
                                        </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                    <a href="<?php echo home_url('/car-search') ?>" class="text-capitalize d-inline-block mt-3">reset search</a>
                </form>
            </div>
        </div>

        <?php
        
        if($is_search){

            $query = search_query();
             
            if($query->have_posts()){
                while($query->have_posts()){
                    $query->the_post();
                    the_title();
                    echo '<br>';
                }
                wp_reset_postdata();
            }else{?>
                <div class="alert alert-warning my-3 fw-bold">There are no results</div>
            <?php }
        }
        ?>
    </div>
</section>

<?php get_footer(); ?>