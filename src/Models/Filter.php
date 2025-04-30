<?php declare(strict_types=1);

namespace ComponoKit\Storages\Models;

use ComponoKit\Storages\Exceptions\ValueNotProvidedException;
use ComponoKit\Storages\Interfaces\RepresentsFilter;
use ComponoKit\Storages\Interfaces\RepresentsFilterValue;

class Filter implements RepresentsFilter
{
	public function __construct( private readonly string $filterId, private readonly ?RepresentsFilterValue $value = null )
	{
	}

	public function getFilterId(): string
	{
		return $this->filterId;
	}

	public function hasValue(): bool
	{
		return null !== $this->value;
	}

	public function getValue(): ?string
	{
		if ( null === $this->value )
		{
			throw new ValueNotProvidedException( 'Value not provided for filter with id ' . $this->filterId );
		}

		return $this->value->get();
	}
}
