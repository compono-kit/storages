<?php declare(strict_types=1);

namespace Hansel23\Storages\Interfaces;

use Hansel23\Storages\Models\Types\SortDirection;

interface RepresentsSortBy
{
	public function getAttributeId(): string;

	public function getDirection(): SortDirection;
}
