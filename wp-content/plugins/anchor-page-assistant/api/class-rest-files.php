<?php
/**
 * REST API — Direct-PHP page file read/write endpoints.
 *
 * Exposes:
 *   GET  /files/page/{slug}   → raw contents of page-content/{slug}.php
 *   POST /files/page/{slug}   → write raw contents (validated by APA_File_Writer)
 *   GET  /files/partials      → list of available partials for AI prompts
 *
 * Authentication: manage_options (same as the rest of the plugin).
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class APA_REST_Files {

	private static $instance = null;
	private $namespace       = 'anchor-assistant/v1';

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->init();
		}
		return self::$instance;
	}

	private function init() {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	public function register_routes() {
		// Page file: GET + POST at a nested slug (allow letters, digits, dash,
		// underscore, and forward slash for nested pages).
		register_rest_route(
			$this->namespace,
			'/files/page/(?P<slug>[A-Za-z0-9_\-/]+)',
			[
				[
					'methods'             => 'GET',
					'callback'            => [ $this, 'get_page_file' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'save_page_file' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
			]
		);

		// List partials the AI can reference.
		register_rest_route(
			$this->namespace,
			'/files/partials',
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'list_partials' ],
				'permission_callback' => [ $this, 'check_permission' ],
			]
		);
	}

	public function check_permission() {
		return current_user_can( 'manage_options' );
	}

	public function get_page_file( $request ) {
		$slug   = (string) $request['slug'];
		$result = APA_File_Writer::read_page( $slug );

		if ( is_wp_error( $result ) ) {
			return new WP_REST_Response(
				[ 'error' => $result->get_error_message() ],
				400
			);
		}

		return rest_ensure_response( $result );
	}

	public function save_page_file( $request ) {
		$slug   = (string) $request['slug'];
		$params = $request->get_json_params();
		if ( ! is_array( $params ) ) {
			$params = [];
		}

		$contents = isset( $params['contents'] ) ? (string) $params['contents'] : null;
		if ( null === $contents ) {
			return new WP_REST_Response( [ 'error' => 'Missing "contents".' ], 400 );
		}

		$result = APA_File_Writer::write_page( $slug, $contents );
		if ( is_wp_error( $result ) ) {
			$code   = $result->get_error_code();
			$status = 'syntax_error' === $code ? 422 : 400;
			return new WP_REST_Response(
				[
					'error' => $result->get_error_message(),
					'code'  => $code,
				],
				$status
			);
		}

		return rest_ensure_response(
			[
				'success' => true,
				'slug'    => $slug,
				'path'    => $result['path'],
			]
		);
	}

	public function list_partials() {
		return rest_ensure_response( APA_File_Writer::list_partials() );
	}
}
