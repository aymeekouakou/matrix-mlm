<?php

namespace MatrixMlm\Model;

class Commission implements ModelImpl {

	public $id;
	public $member_id;
	public $level_id;
	public $price;
	public $created;
	public $updated;
	public $options;
	public $table_name = 'commissions';

	function __construct(array... $args) {
		foreach ( $args as $key => $value ) {
			$this->options[$key] = $value;
		}
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 *
	 * @return Commission
	 */
	public function setId( $id ) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getMemberId() {
		return $this->member_id;
	}

	/**
	 * @param mixed $member_id
	 *
	 * @return Commission
	 */
	public function setMemberId( $member_id ) {
		$this->member_id = $member_id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLevelId() {
		return $this->level_id;
	}

	/**
	 * @param mixed $level_id
	 *
	 * @return Commission
	 */
	public function setLevelId( $level_id ) {
		$this->level_id = $level_id;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @param mixed $price
	 *
	 * @return Commission
	 */
	public function setPrice( $price ) {
		$this->price = $price;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * @param mixed $created
	 *
	 * @return Commission
	 */
	public function setCreated( $created ) {
		$this->created = $created;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUpdated() {
		return $this->updated;
	}

	/**
	 * @param mixed $updated
	 *
	 * @return Commission
	 */
	public function setUpdated( $updated ) {
		$this->updated = $updated;

		return $this;
	}

	/**
	 * @return array
	 */
	public function install(): array
	{
		return dbDelta($this->sql());
	}

    public function sql()
    {
        global $wpdb;

        if (!array_key_exists('prefix', $this->options)) {
            $this->options['prefix'] = $wpdb->prefix;
        }

        if (!array_key_exists('table', $this->options)) {
            $this->options['table'] = $this->table_name;
        }

        return "
			CREATE TABLE IF NOT EXISTS `{$this->options['table']}`.`{$this->options['prefix']}{$this->options['table']}` (
			  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
			  `member_id` INT(10) UNSIGNED NOT NULL,
			  `level_id` INT(10) UNSIGNED NOT NULL,
			  `price` DOUBLE NOT NULL,
			  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTsAMP,
			  `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`),
			  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
			  INDEX `fk_commissions_members_idx` (`member_id` ASC) VISIBLE,
			  INDEX `fk_commissions_levels_idx` (`level_id` ASC) VISIBLE,
			  CONSTRAINT `fk_commissions_members`
			    FOREIGN KEY (`member_id`)
			    REFERENCES `{$this->options['table']}`.`{$this->options['prefix']}members` (`id`)
			    ON DELETE CASCADE
			    ON UPDATE CASCADE,
			  CONSTRAINT `fk_commissions_levels`
			    FOREIGN KEY (`level_id`)
			    REFERENCES `{$this->options['table']}`.`{$this->options['prefix']}levels` (`id`)
			    ON DELETE CASCADE
			    ON UPDATE CASCADE)
			ENGINE = InnoDB
			{$wpdb->get_charset_collate()};
		";
    }
}
