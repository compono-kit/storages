<?php declare(strict_types=1);

namespace ComponoKit\Storages\Interfaces;

interface RepresentsFilterValue
{
	public function get(): ?string;
}
