<?php declare(strict_types=1);

namespace Hansel23\Storages\Models;

use Hansel23\Storages\Interfaces\RepresentsFilterValue;

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
