<?php declare(strict_types=1);

namespace ComponoKit\Storages\Interfaces;

use ComponoKit\Storages\Exceptions\ValueNotProvidedException;

interface RepresentsFilter
{
	public function getFilterId(): string;

	public function hasValue(): bool;

	/**
	 * @throws ValueNotProvidedException
	 */
	public function getValue(): ?string;
}
