<?php declare(strict_types=1);

namespace Hansel23\Storages\Models;

use Hansel23\Storages\Exceptions\ValueNotProvidedException;
use Hansel23\Storages\Interfaces\RepresentsFilter;
use Hansel23\Storages\Interfaces\RepresentsFilterValue;

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
