<?php declare(strict_types=1);

namespace Hansel23\Storages\Models;

use Hansel23\Storages\Interfaces\RepresentsSortBy;
use Hansel23\Storages\Models\Types\SortDirection;

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
