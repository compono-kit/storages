<?php declare(strict_types=1);

namespace ComponoKit\Storages\Interfaces;

use ComponoKit\Storages\Models\Types\SortDirection;

interface RepresentsSortBy
{
	public function getAttributeId(): string;

	public function getDirection(): SortDirection;
}
