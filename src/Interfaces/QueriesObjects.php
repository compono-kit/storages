<?php declare(strict_types=1);

namespace ComponoKit\Storages\Interfaces;

interface QueriesObjects
{
	public function find( RepresentsQueryConstraints $queryConstraints ): mixed;
}
