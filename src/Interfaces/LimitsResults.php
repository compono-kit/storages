<?php declare(strict_types=1);

namespace ComponoKit\Storages\Interfaces;

interface LimitsResults
{
	public function getCount(): int;

	public function getOffset(): int;
}
