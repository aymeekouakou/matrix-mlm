<?php

namespace MatrixMlm\Model;

class Member {

	public $id;
	public $user_id;
	public $parrain_id;
	public $code;
	public $created;
	public $updated;
	public $options;
	public $table_name = 'members';

	function __construct(array... $args) {
		foreach ( $args as $key => $value ) {
			$this->options[$key] = $value;
		}
	}

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Member
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     * @return Member
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParrainId()
    {
        return $this->parrain_id;
    }

    /**
     * @param mixed $parrain_id
     * @return Member
     */
    public function setParrainId($parrain_id)
    {
        $this->parrain_id = $parrain_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return Member
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return Member
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     * @return Member
     */
    public function setUpdated($updated)
    {
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

    private function sql(): string
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
			  `id` INT(10) UNSIGNED NOT NULL,
              `user_id` BIGINT(20) UNSIGNED NOT NULL,
              `parrain_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
              `code` VARCHAR(45) NOT NULL,
              `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`),
              UNIQUE INDEX `code_UNIQUE` (`code` ASC) VISIBLE,
              UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
              INDEX `fk_members_users_idx` (`user_id` ASC) VISIBLE,
			  CONSTRAINT `fk_members_users`
                FOREIGN KEY (`user_id`)
			    REFERENCES `{$this->options['table']}`.`{$this->options['prefix']}users` (`ID`)
			    ON DELETE CASCADE
			    ON UPDATE CASCADE)
			ENGINE = InnoDB
			{$wpdb->get_charset_collate()};
		";
    }

}
