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

		// Section template: GET + POST.
		register_rest_route(
			$this->namespace,
			'/files/section/(?P<type>[a-z0-9_]+)',
			[
				[
					'methods'             => 'GET',
					'callback'            => [ $this, 'get_section_file' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'save_section_file' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
			]
		);

		// CSS file: GET + POST (child-theme allowlist).
		register_rest_route(
			$this->namespace,
			'/files/css/(?P<filename>[a-z0-9_-]+\.css)',
			[
				[
					'methods'             => 'GET',
					'callback'            => [ $this, 'get_css_file' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
				[
					'methods'             => 'POST',
					'callback'            => [ $this, 'save_css_file' ],
					'permission_callback' => [ $this, 'check_permission' ],
				],
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

	// ─── Section template ─────────────────────────────────────────────

	public function get_section_file( $request ) {
		$type     = (string) $request['type'];
		$filename = str_replace( '_', '-', $type ) . '.php';
		$path     = trailingslashit( get_template_directory() ) . 'template-parts/sections/' . $filename;

		if ( ! file_exists( $path ) ) {
			return new WP_REST_Response( [ 'exists' => false, 'contents' => '', 'path' => str_replace( ABSPATH, '', $path ) ], 200 );
		}

		$contents = file_get_contents( $path );
		if ( false === $contents ) {
			return new WP_REST_Response( [ 'error' => 'Could not read file.' ], 500 );
		}

		return rest_ensure_response( [
			'exists'   => true,
			'contents' => $contents,
			'path'     => str_replace( ABSPATH, '', $path ),
			'readonly' => false,
		] );
	}

	public function save_section_file( $request ) {
		$type     = (string) $request['type'];
		$filename = str_replace( '_', '-', $type ) . '.php';
		$path     = trailingslashit( get_template_directory() ) . 'template-parts/sections/' . $filename;

		if ( ! file_exists( $path ) ) {
			return new WP_REST_Response( [ 'error' => 'Section template not found: ' . $filename ], 404 );
		}

		$params   = $request->get_json_params();
		$contents = isset( $params['contents'] ) ? (string) $params['contents'] : null;
		if ( null === $contents ) {
			return new WP_REST_Response( [ 'error' => 'Missing "contents".' ], 400 );
		}

		// PHP syntax check before writing.
		$tmp     = $path . '.tmp';
		$written = file_put_contents( $tmp, $contents );
		if ( false === $written ) {
			return new WP_REST_Response( [ 'error' => 'Could not write temp file.', 'code' => 'write_failed' ], 500 );
		}

		$lint_error = APA_File_Writer::lint_php( $tmp );
		if ( is_wp_error( $lint_error ) ) {
			@unlink( $tmp );
			return new WP_REST_Response( [ 'error' => $lint_error->get_error_message(), 'code' => 'syntax_error' ], 422 );
		}

		// Atomic rename.
		if ( ! rename( $tmp, $path ) ) {
			@unlink( $tmp );
			return new WP_REST_Response( [ 'error' => 'Could not finalize write.', 'code' => 'rename_failed' ], 500 );
		}

		return rest_ensure_response( [ 'success' => true, 'path' => str_replace( ABSPATH, '', $path ) ] );
	}

	// ─── CSS file ─────────────────────────────────────────────────────

	private static $css_allowlist = [ 'deka-home.css', 'client-overrides.css', 'client-tokens.css', 'deka-shop.css' ];

	public function get_css_file( $request ) {
		$filename = (string) $request['filename'];
		if ( ! in_array( $filename, self::$css_allowlist, true ) ) {
			return new WP_REST_Response( [ 'error' => 'File not in allowlist.' ], 403 );
		}

		$path = trailingslashit( get_stylesheet_directory() ) . 'assets/css/' . $filename;

		if ( ! file_exists( $path ) ) {
			return new WP_REST_Response( [ 'exists' => false, 'contents' => '', 'path' => str_replace( ABSPATH, '', $path ) ], 200 );
		}

		$contents = file_get_contents( $path );
		if ( false === $contents ) {
			return new WP_REST_Response( [ 'error' => 'Could not read file.' ], 500 );
		}

		return rest_ensure_response( [
			'exists'   => true,
			'contents' => $contents,
			'path'     => str_replace( ABSPATH, '', $path ),
		] );
	}

	public function save_css_file( $request ) {
		$filename = (string) $request['filename'];
		if ( ! in_array( $filename, self::$css_allowlist, true ) ) {
			return new WP_REST_Response( [ 'error' => 'File not in allowlist.' ], 403 );
		}

		$params   = $request->get_json_params();
		$contents = isset( $params['contents'] ) ? (string) $params['contents'] : null;
		if ( null === $contents ) {
			return new WP_REST_Response( [ 'error' => 'Missing "contents".' ], 400 );
		}

		$path = trailingslashit( get_stylesheet_directory() ) . 'assets/css/' . $filename;
		file_put_contents( $path, $contents );
		return rest_ensure_response( [ 'success' => true, 'path' => str_replace( ABSPATH, '', $path ) ] );
	}
}
