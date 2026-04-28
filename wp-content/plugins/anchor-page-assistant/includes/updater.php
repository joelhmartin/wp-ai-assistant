<?php
/**
 * Anchor Page Assistant — GitHub Updater
 *
 * Wires up plugin-update-checker so the WordPress admin sees update
 * notifications when a new release is published on GitHub.
 *
 * Repo: https://github.com/joelhmartin/anchor-page-assistant
 *
 * For private repositories, define ANCHOR_PAGE_ASSISTANT_GH_TOKEN in
 * wp-config.php with a GitHub Personal Access Token that has `repo` scope.
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once APA_PLUGIN_DIR . 'vendor/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if ( ! function_exists( 'anchor_page_assistant_bootstrap_updater' ) ) {
	function anchor_page_assistant_bootstrap_updater() {
		$plugin_file = APA_PLUGIN_DIR . 'anchor-page-assistant.php';

		$updater = PucFactory::buildUpdateChecker(
			'https://github.com/joelhmartin/anchor-page-assistant/',
			$plugin_file,
			'anchor-page-assistant'
		);

		$updater->setBranch( 'main' );

		$vcs_api = $updater->getVcsApi();
		if ( method_exists( $vcs_api, 'enableReleaseAssets' ) ) {
			$vcs_api->enableReleaseAssets();
		}

		if ( defined( 'ANCHOR_PAGE_ASSISTANT_GH_TOKEN' ) && ANCHOR_PAGE_ASSISTANT_GH_TOKEN ) {
			$updater->setAuthentication( ANCHOR_PAGE_ASSISTANT_GH_TOKEN );
		}
	}
}

anchor_page_assistant_bootstrap_updater();
