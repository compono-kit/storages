<?php declare(strict_types=1);

namespace Hansel23\Storages\Interfaces;

interface RepresentsFilterValue
{
	public function get(): ?string;
}
