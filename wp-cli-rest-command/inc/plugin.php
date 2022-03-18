<?php
use WP_CLI;
namespace Wp_Cli_Rest_Command;

class Fetch{
    
	public $DEFAULT_PER_PAGE = 10;
	public $DEFAULT_PAGED = 1;

    /**
	 * To sync the post on site from Rest API WP cli
	 */
	public function post( $args, $assoc_args ) {
		$from = $assoc_args['from'] ? $assoc_args['from']: '';
		$per_page = $assoc_args['per_page'] ? intval($assoc_args['per_page']): $this->DEFAULT_PER_PAGE;
		$paged = $assoc_args['paged'] ? intval($assoc_args['paged']): $this->DEFAULT_PAGED;
		
		if ( $body = $this->get_posts( $from, $per_page, $paged ) ) {
			if ( $this->insert_posts( $body ) ) {
				\WP_CLI::success( var_export( 'posts successfully synced!' ) );
			} else {
				\WP_CLI::error('something went wrong');
			}
		} else {
			\WP_CLI::error('Please pass --from=https://website.com parameter, example: wp sync post --from=https://rtcamp.com');
		}
	}

	/**
	 * get post from the website URL provided
	 *
	 * @param String $from { URL of the website that have wp rest API enabled  }
	 * @return {json} $body
	 */
	private function get_posts( $from, $per_page, $paged ){
		/** @var array|WP_Error $response */
		$response = wp_remote_get( $from.'/wp-json/wp/v2/posts?per_page='.$per_page.'&paged='.$paged );
		
		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			$body    = $response['body']; // use the content
			$body 	 = json_decode($body);
			return $body;
		}
		return false;
	}
	/**
	 * Insert Post based on data retrieved from Site WP-json api
	 *
	 * @param [WP_Rest_Response] $body
	 * @return void
	 */
	private function insert_posts($body) {
		
		if(! is_array($body)){
			return false;
		}
		$count_post = count($body);
		$progress = \WP_CLI\Utils\make_progress_bar( 'Generating Posts', $count_post );

		foreach( $body as $post ){
			$my_post = array(
				'post_title'    => wp_strip_all_tags( $post->title->rendered ),
				'post_content'  => $post->content->rendered,
				'post_status'   => 'draft',
				'post_author'   => 1,
				'post_category' => ''
			  );
			  
			  // Insert the post into the database
			  wp_insert_post( $my_post );
			  $progress->tick();
		}

		$progress->finish();

		return true;

	}

}