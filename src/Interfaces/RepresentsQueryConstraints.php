<?php declare(strict_types=1);

namespace Hansel23\Storages\Interfaces;

interface RepresentsQueryConstraints
{
	/**
	 * @return RepresentsFilter[]
	 */
	public function getFilters(): array;

	/**
	 * @return RepresentsSortBy[]
	 */
	public function getSortByList(): array;

	public function getLimiter(): ?LimitsResults;
}
