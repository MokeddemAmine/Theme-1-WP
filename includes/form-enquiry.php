
<div id="success_message" class="alert alert-success" ></div>

<form id="enquiry">
    <h2 class="text-capitalize">send and enquiry about <?php the_title() ?></h2>


    <input type="hidden" name="registration" value="<?php echo get_post_meta($post->ID,'Registration',true) ?>">

    <div class="form-group row my-3">
        <div class="col-lg-6">
            <input type="text" name="fname" placeholder="First Name" class="form-control" />
        </div>
        <div class="col-lg-6">
            <input type="text" name="lname" placeholder="last Name" class="form-control" />
        </div>
    </div>

    <div class="form-group row my-3">
        <div class="col-lg-6">
            <input type="email" name="email" placeholder="Email" class="form-control">
        </div>
        <div class="col-lg-6">
            <input type="tel" name="phone" placeholder="Phone Number" class="form-control">
        </div>
    </div>

    <div class="form-group my-3">
        <textarea name="enquiry" class="form-control" placeholder="Your comment here"></textarea>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-dark">Send your enquiry</button>
    </div>


</form>

<script>
    var endpoint = '<?php echo admin_url('admin-ajax.php'); ?>';
    var ajax_nonce = '<?php echo wp_create_nonce('ajax-nonce'); ?>'
</script>