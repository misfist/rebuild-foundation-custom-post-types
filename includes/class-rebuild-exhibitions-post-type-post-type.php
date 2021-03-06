<?php
/**
 * Rebuild Exhibitions Post Type
 *
 * @author    Pea
 * @license   GPL-2.0+
 * @link      http://misfist.com
 * @since     1.0.0
 * @package   Rebuild_Foundation_Custom_Post_Types
 */

class Rebuild_Exhibitions_Post_Type_Post_Type extends Gamajo_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'rebuild_exhibitions';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'               => __( 'Exhibitions', 'rebuild-foundation-cpt' ),
			'singular_name'      => __( 'Exhibition Item', 'rebuild-foundation-cpt' ),
			'menu_name'          => _x( 'Exhibitions', 'admin menu', 'rebuild-foundation-cpt' ),
			'name_admin_bar'     => _x( 'Exhibition Item', 'add new on admin bar', 'rebuild-foundation-cpt' ),
			'add_new'            => __( 'Add New Item', 'rebuild-foundation-cpt' ),
			'add_new_item'       => __( 'Add New Exhibition Item', 'rebuild-foundation-cpt' ),
			'new_item'           => __( 'Add New Exhibition Item', 'rebuild-foundation-cpt' ),
			'edit_item'          => __( 'Edit Exhibition Item', 'rebuild-foundation-cpt' ),
			'view_item'          => __( 'View Item', 'rebuild-foundation-cpt' ),
			'all_items'          => __( 'All Exhibition Items', 'rebuild-foundation-cpt' ),
			'search_items'       => __( 'Search Exhibition', 'rebuild-foundation-cpt' ),
			'parent_item_colon'  => __( 'Parent Exhibition Item:', 'rebuild-foundation-cpt' ),
			'not_found'          => __( 'No exhibition items found', 'rebuild-foundation-cpt' ),
			'not_found_in_trash' => __( 'No exhibition items found in trash', 'rebuild-foundation-cpt' ),
		);

		$supports = array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'comments',
			'author',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'taxonomies'      => array( 'category', 'post_tag' ),
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'exhibitions', ), // Permalinks format
			'menu_position'   => 5,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '4.3.1', '>=' ) ) ? 'dashicons-nametag' : false ,
			'has_archive'     => true,
		);

		return apply_filters( 'rebuild_exhibitions_post_type_args', $args );
	}

	/**
	 * Return post type updated messages.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type updated messages.
	 */
	public function messages() {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Exhibition item updated.', 'rebuild-foundation-cpt' ),
			2  => __( 'Custom field updated.', 'rebuild-foundation-cpt' ),
			3  => __( 'Custom field deleted.', 'rebuild-foundation-cpt' ),
			4  => __( 'Exhibition item updated.', 'rebuild-foundation-cpt' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Exhibition item restored to revision from %s', 'rebuild-foundation-cpt' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Exhibtion item published.', 'rebuild-foundation-cpt' ),
			7  => __( 'Exhibtion item saved.', 'rebuild-foundation-cpt' ),
			8  => __( 'Exhibtion item submitted.', 'rebuild-foundation-cpt' ),
			9  => sprintf(
				__( 'Exhibtion item scheduled for: <strong>%1$s</strong>.', 'rebuild-foundation-cpt' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'rebuild-foundation-cpt' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Exhibtion item draft updated.', 'rebuild-foundation-cpt' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View exhibition item', 'rebuild-foundation-cpt' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview exhibition item', 'rebuild-foundation-cpt' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
