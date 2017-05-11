<?php
namespace GARUNG;
/**
* Class Custom Post Type
*/
class CustomPostType 
{
	/**
	 * [$fields list parameters]
	 * @var array
	 * @version 1.0 [2017-05-08]
	 */
	private $fields;
	function __construct($fields)
	{
		$this->fields = $fields;
		if(empty($fields['label'])) {
			$this->fields['label'] = 'Category';
		}
		if(empty($fields['singular_label'])) {
			$this->fields['singular_label'] = 'Name Post Type';
		}
		if(empty($fields['orderby'])) {
			$this->fields['orderby'] = 'term_order';
		}
		$this->createTaxonomy();
		add_action('init', [$this, 'createPostType']);
		add_filter("manage_edit-security_columns", [$this, "security_edit_columns"]);
	}

	public function createTaxonomy() {
		$args = array(
		    "label" 						=> _x($this->fields['label'], 'category label', "garung"),
		    "singular_label" 				=> _x($this->fields['singular_label'], 'category singular label', "garung"),
		    'public'                        => true,
		    'hierarchical'                  => true,
		    'show_ui'                       => true,
		    'show_in_nav_menus'             => true,
		    'args'                          => array( 'orderby' => $this->fields['orderby'] ),
	        'rewrite'                       => array(
	                                            'slug' => $this->fields['slug_taxonomy'],
	                                            'with_front' => false ),
		    'query_var'                     => true
		);

		register_taxonomy( $this->fields['name_taxonomy'], $this->fields['alias_taxonomy'], $args );
	}

	public function createPostType() {
		$labels = array(
	        'name' => _x($this->fields['singular_label'], 'post type general name', "garung"),
	        'singular_name' => _x($this->fields['singular_label'], 'post type singular name', "garung"),
	        'add_new' => _x('Add New', 'job', "garung"),
	        'add_new_item' => __('Add New', "garung"),
	        'edit_item' => __('Edit', "garung"),
	        'new_item' => __('New', "garung"),
	        'view_item' => __('View', "garung"),
	        'search_items' => __('Search', "garung"),
	        'not_found' =>  __('No post have been added yet', "garung"),
	        'not_found_in_trash' => __('Nothing found in Trash', "garung"),
	        'parent_item_colon' => ''
	    );

	    $args = array(
	        'labels' => $labels,
	        'public' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => true,
            'rewrite' =>  array('slug' => $this->fields['slug_post_taxonomy'],'with_front' => false ),
	        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
	        'has_archive' => true,
	        'taxonomies' => array($this->fields['name_taxonomy'], 'post_tag',)
	       );

	    register_post_type( $this->fields['alias_taxonomy'] , $args );
	}

	function security_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "thumbnail" => "",
            "title" => __($this->fields['singular_label'], "coo-theme-admin"),
            "description" => __("Description", "coo-theme-admin"),
            "security-category" => __("Categories", "coo-theme-admin")
        );

        return $columns;
	}
}