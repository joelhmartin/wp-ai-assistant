<?php
/**
 * Section Registry — runtime registry of available section types.
 *
 * Merges the schema definitions with the theme's default props
 * to give a complete picture of what each section can do.
 *
 * @package Anchor_Page_Assistant
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class APA_Section_Registry {

    private static $instance = null;
    private $sections = null;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get all registered section types with schemas and defaults.
     */
    public function get_all() {
        if ( null !== $this->sections ) {
            return $this->sections;
        }

        $schemas  = APA_Section_Schema::get_all();
        $defaults = function_exists( 'anchor_get_all_section_defaults' )
            ? anchor_get_all_section_defaults()
            : [];

        $this->sections = [];

        foreach ( $schemas as $type => $schema ) {
            $this->sections[ $type ] = array_merge( $schema, [
                'type'     => $type,
                'defaults' => $defaults[ $type ] ?? [],
            ] );
        }

        return $this->sections;
    }

    /**
     * Get a single section type's schema.
     */
    public function get( $type ) {
        $all = $this->get_all();
        return $all[ $type ] ?? null;
    }

    /**
     * Get just the type labels for dropdown menus.
     */
    public function get_labels() {
        $labels = [];
        foreach ( $this->get_all() as $type => $schema ) {
            $labels[ $type ] = $schema['label'];
        }
        return $labels;
    }
}
