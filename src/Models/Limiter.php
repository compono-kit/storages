<?php declare(strict_types=1);

namespace ComponoKit\Storages\Models;

use ComponoKit\Storages\Interfaces\LimitsResults;

class Limiter implements LimitsResults
{
	public function __construct( private readonly int $count, private readonly int $offset )
	{
	}

	public function getCount(): int
	{
		return $this->count;
	}

	public function getOffset(): int
	{
		return $this->offset;
	}
}
