<?php declare(strict_types=1);

namespace ComponoKit\Storages\Models;

use ComponoKit\Storages\Interfaces\RepresentsFilterValue;

class FilterValue implements RepresentsFilterValue
{
	public function __construct( private readonly ?string $value )
	{
	}

	public function get(): ?string
	{
		return $this->value;
	}
}
