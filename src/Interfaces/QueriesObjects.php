<?php declare(strict_types=1);

namespace Hansel23\Storages\Interfaces;

interface QueriesObjects
{
	public function find( RepresentsQueryConstraints $queryConstraints ): mixed;
}
