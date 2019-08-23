<?php
/**
 * Plugin Name: Worksim - Email Notify On Publish
 */


/**
 * WP_Post Object ( [ID] => 26 [post_author] => 1 [post_date] => 2019-08-23 11:28:10 [post_date_gmt] => 2019-08-23 11:28:10 [post_content] => [post_title] => Hello again [post_excerpt] => [post_status] => publish [comment_status] => closed [ping_status] => closed [post_password] => [post_name] => hello-again [to_ping] => [pinged] => [post_modified] => 2019-08-23 11:28:10 [post_modified_gmt] => 2019-08-23 11:28:10 [post_content_filtered] => [post_parent] => 0 [guid] => http://localhost/?page_id=26 [menu_order] => 0 [post_type] => page [post_mime_type] => [comment_count] => 0 [filter] => raw )
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

		// Just in case...
		if (!$post || !$post_id) {
			return;
		}

		$authorName = get_the_author($post->post_author);

		$title = sprintf(
			'Review new %s from %s',
			$post->post_type,
			$authorName
		);

		$post = sprintf(
			'%s has published a new %s: %s <a href="%s">View it here</a>',
			$authorName,
			$post->post_type,
			$post->title,
			$post->guid
		);
		wp_mail('test@test.com', esc_textarea($title), esc_html($post), array('Content-Type: text/html; charset=UTF-8'));
	}

}

$notifyPlugin = new WorksimNotifyOnPublish;
$notifyPlugin->init();
