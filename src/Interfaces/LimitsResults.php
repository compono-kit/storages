<?php declare(strict_types=1);

namespace Hansel23\Storages\Interfaces;

interface LimitsResults
{
	public function getCount(): int;

	public function getOffset(): int;
}
