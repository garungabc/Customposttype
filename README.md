# WP CUSTOM POST TYPE
Custom post type 

Description:
Create simple Custom Post Type for wordpress

Parameters:
<hr>
DEMO
</hr>
<pre>
/**
 * Class handle for Product Custom Post Type
 */
class ProductCustomPost
{
    public function __construct()
    {
        $fields = [
            'posttype'          => 'product',
            'posttype_label'    => 'Sản Phẩm',
            'posttype_singular' => 'Sản Phẩm',
            'posttype_slug'     => 'product',
            'taxonomy_type'      => 'category-product',
            'taxonomy_label'     => 'Categories',
            'taxonomy_singular'  => 'Product Category',
            'taxonomy_slug'      => 'category-product',
        ];
        new CustomPost($fields);
    }
}
<h3>Note important: After create custom post type successful, you need update permalink by: Setting => permalink</h3>
</pre>


