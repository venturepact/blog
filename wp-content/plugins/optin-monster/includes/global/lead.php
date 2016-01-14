<?php

/**
 * Class Optin_Monster_Lead
 *
 * A nice container for lead information
 *
 * @package Optin_Monster
 * @author  J. Aaron Eaton <aaron@awesomemotive.com>
 * @since   2.2.0
 */
class Optin_Monster_Lead {

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $email;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $optin;

	/**
	 * @var string
	 */
	protected $post;

	/**
	 * @var string
	 */
	protected $referrer;

	/**
	 * Returns the lead ID
	 *
	 * @since 2.2.0
	 *
	 * @return int
	 */
	public function get_id() {

		return $this->id;

	}

	/**
	 * Sets the ID cast as an integer
	 *
	 * @since 2.2.0
	 *
	 * @param int $id
	 */
	public function set_id( $id ) {

		$this->id = (int) $id;

	}

	/**
	 * Returns the lead email
	 *
	 * @since 2.2.0
	 *
	 * @return string
	 */
	public function get_email() {

		return $this->email;

	}

	/**
	 * Sets the lead email
	 *
	 * @since 2.2.0
	 *
	 * @param string $email
	 */
	public function set_email( $email ) {

		$this->email = $email;

	}

	/**
	 * Returns the lead name
	 *
	 * @since 2.2.0
	 *
	 * @return string
	 */
	public function get_name() {

		return empty( $this->name ) ? __( 'No Name Given', 'optin-monster-leads' ) : $this->name;

	}

	/**
	 * Sets the lead name
	 *
	 * @since 2.2.0
	 *
	 * @param string $name
	 */
	public function set_name( $name ) {

		$this->name = $name;

	}

	/**
	 * Returns the originating optin info
	 *
	 * @since 2.2.0
	 *
	 * @return array
	 */
	public function get_optin() {

		return $this->optin;

	}

	/**
	 * Sets the originating optin info
	 *
	 * @since 2.2.0
	 *
	 * @param int $id
	 */
	public function set_optin( $id ) {

		$this->optin = $id;

	}

	/**
	 * Returns the originating post info
	 *
	 * @since 2.2.0
	 *
	 * @return array
	 */
	public function get_post() {

		return $this->post;

	}

	/**
	 * Sets the originating post info
	 *
	 * @since 2.2.0
	 *
	 * @param string $post
	 */
	public function set_post( $post ) {

		$this->post = $post;

	}

	/**
	 * Returns the referrer URL
	 *
	 * @since 2.2.0
	 *
	 * @return string
	 */
	public function get_referrer() {

		return $this->referrer;

	}

	/**
	 * Sets the referrer URL
	 *
	 * @since 2.2.0
	 *
	 * @param string $referrer
	 */
	public function set_referrer( $referrer ) {

		$this->referrer = $referrer;

	}

} 