<?php declare(strict_types=1);

namespace Hansel23\Storages\Interfaces;

use Hansel23\Storages\Exceptions\ValueNotProvidedException;

interface RepresentsFilter
{
	public function getFilterId(): string;

	public function hasValue(): bool;

	/**
	 * @throws ValueNotProvidedException
	 */
	public function getValue(): ?string;
}
