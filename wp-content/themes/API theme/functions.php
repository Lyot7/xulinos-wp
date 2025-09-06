<?php




add_action('admin_menu', 'remove_posts_menu');
function remove_posts_menu()
{
    remove_menu_page('edit.php');
}



//Cache les versions des plugins dans code source
function vc_remove_wp_ver_css_js($src)
{
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'vc_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'vc_remove_wp_ver_css_js', 9999);



//Cache la version de wordpress dans code source
remove_action('wp_head', 'wp_generator');

add_filter('xmlrpc_enabled', '__return_false');


//Dégage Gutemberg
add_filter('use_block_editor_for_post', '__return_false', 10);

//Ajoute l'image à la une
add_theme_support('post-thumbnails');

add_filter('wp_sitemaps_enabled', '__return_false');




function couteaux()
{
    // set up product labels
    $labels = array(
        'name' => 'couteaux',
        'singular_name' => 'couteau',
        'add_new' => 'Ajouter une couteau',
        'add_new_item' => 'Ajouter une couteau',
        'edit_item' => 'Modifier une couteau',
        'new_item' => 'Nouvelle couteau',
        'all_items' => 'Toutes les couteaux',
        'view_item' => 'Voir les couteaux',
        'search_items' => 'Search couteau',
        'not_found' =>  "Pas d'couteau",
        'not_found_in_trash' => "Pas d'couteau' dans la poubelle",
        'parent_item_colon' => '',
        'menu_name' => 'Nos couteaux',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'couteaux'),
        'query_var' => true,
        'menu_icon' => 'dashicons-filter',
        'menu_position' => 4,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes'
        )
    );
    register_post_type('couteaux', $args);

    // register category
    register_taxonomy('couteaux_category', 'couteaux', array('hierarchical' => true, 'label' => 'Categorie', 'query_var' => true, 'rewrite' => array('slug' => 'couteaux-category')));

    // register étiquette
    register_taxonomy('couteaux_tag', 'couteaux', array('hierarchical' => true, 'label' => 'Etiquette', 'query_var' => true, 'rewrite' => array('slug' => 'couteaux-tag')));
}
add_action('init', 'couteaux');


function acf_remplacer_ids_images_par_urls($response, $post, $request) {
    $acf = get_fields($post->ID);

    if (!$acf) {
        return $response;
    }

    // Convertit récursivement tous les champs image ACF en URLs
    $acf = acf_convert_images_recursive($acf);

    // Injecte les données modifiées dans la réponse REST
    $response->data['acf'] = $acf;

    return $response;
}

function acf_convert_images_recursive($fields) {
    foreach ($fields as $key => $value) {
        // Cas 1 : ID numérique d’image
        if (is_numeric($value) && get_post_mime_type($value)) {
            $fields[$key] = wp_get_attachment_url($value);
        }

        // Cas 2 : champ image retourné sous forme de tableau (array)
        elseif (is_array($value) && isset($value['ID']) && get_post_mime_type($value['ID'])) {
            $fields[$key]['url'] = wp_get_attachment_url($value['ID']);
        }

        // Cas 3 : tableau imbriqué → traiter récursivement
        elseif (is_array($value)) {
            $fields[$key] = acf_convert_images_recursive($value);
        }
    }

    return $fields;
}

// Cible uniquement les pages (dans l’API REST, c’est le type "page")
add_filter('rest_prepare_page', 'acf_remplacer_ids_images_par_urls', 10, 3);