<?php declare(strict_types=1);

namespace ComponoKit\Storages\Models;

use ComponoKit\Storages\Interfaces\RepresentsSortBy;
use ComponoKit\Storages\Models\Types\SortDirection;

class SortBy implements RepresentsSortBy
{
	public function __construct( private readonly string $attributeId, private readonly SortDirection $direction )
	{
	}

	public function getAttributeId(): string
	{
		return $this->attributeId;
	}

	public function getDirection(): SortDirection
	{
		return $this->direction;
	}
}
