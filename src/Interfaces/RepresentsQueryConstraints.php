<?php declare(strict_types=1);

namespace ComponoKit\Storages\Interfaces;

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
