<?php
/**
 * extract-bundle.php
 *
 * Decodes the per-UUID asset manifest in a bundled deka-homepage-vN.html and
 * writes each asset to disk. Run via PHP CLI (no WordPress dependency):
 *
 *   php tools/extract-bundle.php /Users/bif/Desktop/deka-homepage-v2.html /tmp/bundle-v2/
 *
 * Outputs:
 *   /tmp/bundle-v2/manifest.json
 *   /tmp/bundle-v2/<uuid>.<ext>      (binary; one file per asset)
 */

if ( PHP_SAPI !== 'cli' ) {
	fwrite( STDERR, "must be run from the CLI\n" );
	exit( 1 );
}

$argv = $_SERVER['argv'];
if ( count( $argv ) < 3 ) {
	fwrite( STDERR, "usage: php extract-bundle.php <bundle.html> <out-dir>\n" );
	exit( 1 );
}

$src = $argv[1];
$out = rtrim( $argv[2], '/' );

if ( ! is_file( $src ) ) {
	fwrite( STDERR, "input not found: $src\n" );
	exit( 1 );
}
if ( ! is_dir( $out ) && ! mkdir( $out, 0777, true ) ) {
	fwrite( STDERR, "could not create out dir: $out\n" );
	exit( 1 );
}

$html = file_get_contents( $src );
if ( ! preg_match( '#<script type="__bundler/manifest">(.*?)</script>#s', $html, $m ) ) {
	fwrite( STDERR, "no __bundler/manifest in $src\n" );
	exit( 1 );
}

$manifest = json_decode( $m[1], true );
if ( ! is_array( $manifest ) ) {
	fwrite( STDERR, "manifest JSON invalid\n" );
	exit( 1 );
}

$mime_to_ext = array(
	'image/png'              => 'png',
	'image/jpeg'             => 'jpg',
	'image/jpg'              => 'jpg',
	'image/svg+xml'          => 'svg',
	'image/webp'             => 'webp',
	'image/gif'              => 'gif',
	'video/mp4'              => 'mp4',
	'font/woff2'             => 'woff2',
	'font/woff'              => 'woff',
	'application/font-woff2' => 'woff2',
);

$index = array();
foreach ( $manifest as $uuid => $entry ) {
	$mime  = isset( $entry['mime'] ) ? $entry['mime'] : 'application/octet-stream';
	$ext   = isset( $mime_to_ext[ $mime ] ) ? $mime_to_ext[ $mime ] : 'bin';
	$bytes = base64_decode( $entry['data'] );
	if ( ! empty( $entry['compressed'] ) ) {
		$decoded = @gzdecode( $bytes );
		if ( false !== $decoded ) {
			$bytes = $decoded;
		}
	}
	$path = $out . '/' . $uuid . '.' . $ext;
	file_put_contents( $path, $bytes );
	$index[ $uuid ] = array(
		'mime' => $mime,
		'ext'  => $ext,
		'file' => basename( $path ),
		'size' => strlen( $bytes ),
	);
}

file_put_contents( $out . '/manifest.json', json_encode( $index, JSON_PRETTY_PRINT ) );
echo "wrote " . count( $index ) . " assets to $out\n";
