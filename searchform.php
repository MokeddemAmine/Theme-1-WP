<form action="/" method="get">

    <label for="search">search</label>
    <input type="hidden" name="cat" value="15">
    <input type="text" name="s" value="<?php the_search_query() ?>" id="search" required />
    <button type="submit">Search</button>

</form>