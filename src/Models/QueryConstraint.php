<?php declare(strict_types=1);

namespace ComponoKit\Storages\Models;

use ComponoKit\Storages\Interfaces\LimitsResults;
use ComponoKit\Storages\Interfaces\RepresentsFilter;
use ComponoKit\Storages\Interfaces\RepresentsQueryConstraints;
use ComponoKit\Storages\Interfaces\RepresentsSortBy;

class QueryConstraint implements RepresentsQueryConstraints
{
	/**
	 * @param RepresentsFilter[] $filters
	 * @param LimitsResults|null $limiter
	 * @param RepresentsSortBy[] $sortByList
	 */
	public function __construct( private readonly array $filters = [], private readonly ?LimitsResults $limiter = null, private readonly array $sortByList = [] )
	{
	}

	/**
	 * @return RepresentsFilter[]
	 */
	public function getFilters(): array
	{
		return $this->filters;
	}

	/**
	 * @return RepresentsSortBy[]
	 */
	public function getSortByList(): array
	{
		return $this->sortByList;
	}

	public function getLimiter(): ?LimitsResults
	{
		return $this->limiter;
	}
}
