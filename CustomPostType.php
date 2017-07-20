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
     * @version 1.1 [2017-07-20]
     */
    private $fields;
    public function __construct($fields)
    {
        $this->fields = $fields;
        if (empty($fields['taxonomy_label'])) {
            $this->fields['taxonomy_label'] = 'Category';
        }
        if (empty($fields['posttype_label'])) {
            $this->fields['posttype_label'] = 'Name Post Type';
        }
        if (empty($fields['orderby'])) {
            $this->fields['orderby'] = 'term_order';
        }

        add_action('init', [$this, 'createPostType']);
        add_action('init', [$this, 'createTaxonomy']);
        add_filter("manage_edit-security_columns", [$this, "security_edit_columns"]);
    }

    public function createTaxonomy()
    {
        $labels = [
            'name'               => $this->fields['taxonomy_label'],
            'singular_name'      => $this->fields['taxonomy_singular'],
            'add_new'            => sprintf(_x('Add New %s', 'Thêm mới %s', "garung"), $this->fields['taxonomy_singular']),
            'add_new_item'       => sprintf(_x('Add New %s', "Thêm mới %s", "garung"), $this->fields['taxonomy_singular']),
            'edit_item'          => sprintf(_x('Edit %s', "Chỉnh sửa %s" , "garung"), $this->fields['taxonomy_singular']),
            'new_item'           => sprintf(_x('New %s', "Mới %s", "garung"), $this->fields['taxonomy_singular']),
            'view_item'          => sprintf(_x('View %s', "Xem", "garung"), $this->fields['taxonomy_singular']),
            'search_items'       => sprintf(_x('Search %s', "Tìm kiếm","garung"), $this->fields['taxonomy_singular']),
            'not_found'          => sprintf(_x('No %s have been added yet', "Không có %s nào được thêm vào", "garung"), $this->fields['taxonomy_singular']),
            'not_found_in_trash' => sprintf(_x('No %s found in Trash', "Không có %s nào trong thùng rác", "garung"), $this->fields['taxonomy_singular']),
            'parent_item_colon'  => '',
        ];

        $args = [
            "labels"             => $labels,
            'public'            => true,
            'hierarchical'      => true,
            'show_ui'           => true,
            'show_in_nav_menus' => true,
            'rewrite'           => [
                'slug'       => $this->fields['taxonomy_slug'],
                'with_front' => false],
            'query_var'         => true,
        ];

        register_taxonomy($this->fields['taxonomy_type'], $this->fields['posttype'], $args);
    }

    public function createPostType($fields)
    {
        $labels = [
            'name'               => $this->fields['posttype_label'],
            'singular_name'      => $this->fields['posttype_singular'],
            'add_new'            => sprintf(_x('Add New %s', 'Thêm mới %s', "garung"), $this->fields['posttype_singular']),
            'add_new_item'       => sprintf(_x('Add New %s', "Thêm mới %s" , "garung"), $this->fields['posttype_singular']),
            'edit_item'          => sprintf(_x('Edit %s', "Chỉnh sửa %s" ,"garung"), $this->fields['posttype_singular']),
            'new_item'           => sprintf(_x('New %s', "Mới %s","garung"), $this->fields['posttype_singular']),
            'view_item'          => sprintf(_x('View %s', "Xem %s", "garung"), $this->fields['posttype_singular']),
            'search_items'       => sprintf(_x('Search %s', "Tìm kiếm %s","garung"), $this->fields['posttype_singular']),
            'not_found'          => sprintf(_x('No %s have been added yet', "Không có %s nào được tìm thấy","garung"), $this->fields['posttype_singular']),
            'not_found_in_trash' => sprintf(_x('No %s found in Trash', "Không có gì trong thùng rác","garung"), $this->fields['posttype_singular']),
            'parent_item_colon'  => '',
        ];

        $args = [
            'labels'            => $labels,
            'public'            => true,
            'show_ui'           => true,
            'show_in_menu'      => true,
            'show_in_nav_menus' => true,
            'rewrite'           => [
                'slug'       => $this->fields['posttype_slug'],
                'with_front' => false],
            'supports'          => ['title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes', 'custom-fields'],
            'has_archive'       => true,
            'taxonomies'        => [$this->fields['taxonomy_type'], 'post_tag'],
        ];

        register_post_type($this->fields['posttype'], $args);
    }

    public function security_edit_columns($columns)
    {
        $columns = [
            "cb"                => "<input type=\"checkbox\" />",
            "thumbnail"         => "",
            "title"             => __($this->fields['singular_label'], "coo-theme-admin"),
            "description"       => __("Description", "coo-theme-admin"),
            "security-category" => __("Categories", "coo-theme-admin"),
        ];

        return $columns;
    }
}