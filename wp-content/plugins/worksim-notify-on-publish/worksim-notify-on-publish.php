<?php
/**
 * Plugin Name: Worksim - Email Notify On Publish
 */

/**
 * Class WorksimNotifyOnPublish
 */
class WorksimNotifyOnPublish {

	/**
	 * Bootstrap actions
	 */
	public function init() {
		add_action('publish_post', [$this, 'onPublish'], 10,  2);
		add_action('publish_page', [$this, 'onPublish'], 10, 2);
	}

	/**
	 * Send notification email
	 *
	 * @param $post_id number
	 * @param $post WP_Object
	 */
	public function onPublish( $post_id, $post ){

		// TODO: Filter these to only the newly published posts, instead of including updated

		// Just in case...
		if (!$post || !$post_id) {
			return;
		}

		$admin_email = get_option('admin_email', 'help@dxw.com'); // TODO: Add a proper fallback strategy

		$authorName = get_the_author_meta('display_name', $post->post_author);

		$title = wp_sprintf(
			'Review new %s from %s',
			$post->post_type,
			$authorName
		);

		$link = wp_sprintf(
			'<a href="%s">View it here</a>',
			esc_url($post->guid)
		);

		$body = wp_sprintf(
			'%s has published a new %s: %s %s',
			esc_html($authorName),
			esc_html($post->post_type),
			esc_html($post->title),
			$link
		);

		wp_mail(
			sanitize_email($admin_email), // admin email
			esc_textarea($title), // email title
			$body, // email body
			['Content-Type: text/html; charset=UTF-8'] // headers
		);
	}

}

$notifyPlugin = new WorksimNotifyOnPublish;
$notifyPlugin->init();
