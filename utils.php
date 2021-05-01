<?php
function gc_get_category_index($cat){
    $index = -1;
    $saved_categories = gc_get_saved_categories();
    for($i = 0; $i < count(gc_get_saved_categories()); $i++){
        if($saved_categories[$i][CATEGORY_NAME_KEY] === $cat){
            $index = $i;
        }
    }
    return $index;
}

function gc_get_saved_categories(){
    $saved_categories = get_site_meta(get_current_blog_id(), CATEGORIES_META_KEY);
    return $saved_categories;
}