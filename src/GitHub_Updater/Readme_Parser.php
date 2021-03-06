<?php
/**
 * GitHub Updater
 *
 * @package   GitHub_Updater
 * @author    Andy Fragen
 * @license   GPL-2.0+
 * @link      https://github.com/afragen/github-updater
 */

namespace Fragen\GitHub_Updater;

/*
 * Exit if called directly.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Readme_Parser
 *
 * @package Fragen\GitHub_Updater
 */
class Readme_Parser extends \Parser {

	/**
	 * Constructor.
	 *
	 * @param string $file_contents Contents of file.
	 */
	public function __construct( $file_contents ) {
		if ( $file_contents ) {
			$this->parse_readme( $file_contents );
		}
	}

	/**
	 * @param string $text
	 *
	 * @return string
	 */
	protected function parse_markdown( $text ) {
		static $markdown = null;

		if ( is_null( $markdown ) ) {
			$markdown = new \Parsedown();
		}

		return $markdown->text( $text );
	}

	/**
	 * @return array
	 */
	public function parse_data() {
		$data = array();
		foreach ( $this as $key => $value ) {
			$data[ $key ] = $value;
		}

		return $data;
	}

	/**
	 * @param array $users
	 *
	 * @return array
	 */
	protected function sanitize_contributors( $users ) {
		return $users;
	}

	/**
	 * @access protected
	 *
	 * @param string|array $text
	 *
	 * @return string
	 */
	protected function sanitize_text( $text ) { // not fancy
		if ( is_array( $text ) ) {
			$text = implode( "\n", $text );
		}
		$text = strip_tags( $text );
		$text = esc_html( $text );
		$text = trim( $text );

		return $text;
	}

}
