<?php

namespace MatrixMlm\Model;

class Level extends ModelBase implements ModelImpl {

	public $id;
	public $parent_id;
	public $percent;
	public $created;
	public $updated;

	function __construct(array... $args) {
		foreach ( $args as $key => $value ) {
			$this->options[$key] = $value;
		}

		$this->table_name = 'levels';
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
     * @return Level
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     * @return Level
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param mixed $percent
     * @return Level
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
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
     * @return Level
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
     * @return Level
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
        parent::install();

        return dbDelta(
            $this->sql()
        );
	}

    /**
     * @return array
     */
	public function update(): array
    {
        parent::update();

        return [];
    }

    /**
     * @return array
     */
    public function remove(): array
    {
        parent::remove();

        return dbDelta(
            "DROP TABLE `{$this->options['prefix']}{$this->options['table']}`"
        );
    }

    /**
     * @return string
     */
    public function sql(): string
    {
        global $wpdb;
        parent::install();

        return "
			CREATE TABLE IF NOT EXISTS `{$this->options['table']}`.`{$this->options['prefix']}{$this->options['table']}` (
			  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `parent_id` INT(10) UNSIGNED NULL DEFAULT NULL,
              `name` VARCHAR(45) NULL DEFAULT NULL,
              `percent` INT(11) NULL DEFAULT NULL,
              `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`))
			ENGINE = InnoDB
			{$wpdb->get_charset_collate()};
		";
    }

}
