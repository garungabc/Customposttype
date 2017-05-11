# WP CUSTOM POST TYPE
Custom post type 

Description:
Create simple Custom Post Type for wordpress

Parameters:
<hr>
<pre>
$fields
	1. label (string): 
			(required): Label for category of a Custom Post Type
	2. singular_label (<span style="color: #52A6E7">string</span>): 
			(<span style="color: red;">required</span>): Name display into Admin Dashboard of a Custom Post Type
	3. slug_taxonomy (<span style="color: #52A6E7">string</span>): 
			(<span style="color: red;">required</span>): Slug display on url when view a Category
	4. slug_post_taxonomy (<span style="color: #52A6E7">string</span>): 
			(<span style="color: red;">required</span>): Slug display on url when view a post of a category
	5. alias_taxonomy (<span style="color: #52A6E7">string</span>): 
			(<span style="color: red;">required</span>): other name of toxonomy into source code 
	6. name_taxonomy (<span style="color: #52A6E7">string</span>): 
			(<span style="color: red;">required</span>) : name of taxonomy
	7. orderby (<span style="color: #52A6E7">string</span>): 
			(option): order CPT, default is 'term_order'

</pre>
DEMO
</hr>
<pre>
	$fields = [
		'label' => 'Name Category',
		'singular_label' => 'Name Post Type',
		'orderby' => 'term_order',
		'slug_taxonomy' => 'slug_taxonomy_abc',
		'slug_post_taxonomy' => 'slug_post_taxonomy_abc',
		'alias_taxonomy' => 'taxonomy-display',
		'name_taxonomy' => 'taxonomy-of-post-type'
	];
	<h3>new CustomPostType($fields);</h3>
</pre>

Note important: After create custom post type successful, you need update permalink by: Setting -> permalink

