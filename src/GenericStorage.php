<?php declare(strict_types=1);

namespace Hansel23\Storages;

use Hansel23\Storages\Exceptions\InvalidArgumentException;
use Hansel23\Storages\Exceptions\InvalidMethodNameException;
use Hansel23\Storages\Exceptions\MissingImplementationException;
use Hansel23\Storages\Exceptions\QueryNotFoundException;
use Hansel23\Storages\Interfaces\QueriesObjects;
use Hansel23\Storages\Interfaces\RepresentsQueryConstraints;

class GenericStorage
{
	/**
	 * @var array QueriesObjects[]
	 */
	private array $registeredQueries = [];

	/**
	 * @param QueriesObjects[] $queries
	 */
	public function __construct( array $queries )
	{
		$this->init( $queries );
	}

	/**
	 * @throws InvalidMethodNameException
	 * @throws MissingImplementationException
	 * @throws QueryNotFoundException
	 * @throws InvalidArgumentException
	 */
	public function __call( string $name, array $arguments )
	{
		if ( preg_match( '!\W+!', $name ) > 0 )
		{
			throw new InvalidMethodNameException( 'Method name contains invalid characters: ' . $name );
		}

		$pureClassName = ucfirst( $name ) . 'Query';
		if ( isset( $this->registeredQueries[ $pureClassName ] ) )
		{
			if ( !$this->registeredQueries[ $pureClassName ] instanceof QueriesObjects )
			{
				throw new MissingImplementationException( sprintf( 'Missing implementation of %s in class %s', QueriesObjects::class, $this->registeredQueries[ $pureClassName ]::class ) );
			}

			if ( !$arguments[0] instanceof RepresentsQueryConstraints )
			{
				throw new InvalidArgumentException( 'Invalid argument provided, must be of type ' . RepresentsQueryConstraints::class );
			}

			return $this->registeredQueries[ $pureClassName ]->find( $arguments[0] );
		}

		throw new QueryNotFoundException( 'Query not found: ' . $name );
	}

	/**
	 * @param QueriesObjects[] $queries
	 */
	private function init( array $queries ): void
	{
		foreach ( $queries as $query )
		{
			$this->registeredQueries[ (new \ReflectionClass( $query::class ))->getShortName() ] = $query;
		}
	}
}
