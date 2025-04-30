# Storages

## Docker

**Initial:**
* If it does not yet exist, add the network `shared-network`:
    * `docker network create shared-network`
* `docker-compose build --build-arg GITHUB_TOKEN="{TOKEN}"` (Use your GitHub token instead of `{TOKEN}`)
* `docker-compose up -d`

**Start development environment:**

* `docker-compose up -d`

**Update composer dependencies**

* `docker-compose run storages_lib composer update -vvv`

-----

## Usage

### Creating queries

Examples:

```PHP
class FetchFulfillmentQuery implements QueriesObjects
{
	public function find( RepresentsQueryConstraints $queryConstraints ): mixed
	{
		return (new FulfillmentEntity())->withId( 'f-111'); //Of course, you can add access to your injected database manager (e.g. pdo) here instead
	}
}

class FetchFulfillmentsQuery implements QueriesObjects
{
	public function find( RepresentsQueryConstraints $queryConstraints ): mixed
	{
	    //Of course, you can add access to your injected database manager (e.g. pdo) here instead
		yield (new FulfillmentEntity())->withId( 'f-112');
		yield (new FulfillmentEntity())->withId( 'f-113');
		yield (new FulfillmentEntity())->withId( 'f-114');
	}
}
```
If you use GenericStorage, you can simply transfer these queries.
They should correspond to the following convention:
* UpperCamelCase
* {METHOD_NAME}Query whereby {METHOD_NAME} stands for the method name that you want to call via GenericStorage

### GenericStorage

```PHP
interface FetchesFulfillments // interface is not necessary, recommended practice only
{
	public function fetchFulfillment( RepresentsQueryConstraints $queryConstraints ):FulfillmentEntity;

	/**
	 * @param RepresentsQueryConstraints $queryConstraints
	 *
	 * @return \Iterator<int, FulfillmentEntity>
	 */
	public function fetchFulfillments( RepresentsQueryConstraints $queryConstraints ):\Iterator;
}

class FulfillmentRepo
{
    /**
	 * @param GenericStorage|FetchesFulfillments $storage
	 */
	public function __construct(private GenericStorage $storage)
	{
	}

	public function fetchFulfillment( RepresentsQueryConstraints $queryConstraints ): Fulfillment
	{
		return $this->storage->fetchFulfillment($queryConstraints);
	}

	/**
	 * @param RepresentsQueryConstraints $queryConstraints
	 *
	 * @return \Iterator<int, Fulfillment>
	 */
	public function fetchFulfillments( RepresentsQueryConstraints $queryConstraints ): \Iterator
	{
		yield from $this->storage->fetchFulfillments($queryConstraints);
	}
}

$repo = new FulfillmentRepo(new GenericStorage([ new FetchFulfillmentQuery(), new FetchFulfillmentsQuery()]));
```

## Own specific storages

Instead of GenericStorage, you can also use your own storages and integrate the queries there

```PHP
class FulfillmentStorage
{
	public function fetchFulfillment( RepresentsQueryConstraints $queryConstraints ): FulfillmentEntity
	{
		return (new FetchFulfillmentQuery())->find( $queryConstraints );
	}

    /**
     * @param RepresentsQueryConstraints $queryConstraints
     * @return Iterator<int, FulfillmentEntity>
     */
	public function fetchFulfillments( RepresentsQueryConstraints $queryConstraints ): \Iterator
	{
		return (new FetchFulfillmentsQuery())->find( $queryConstraints );
	}
}

class FulfillmentRepo
{
	public function __construct( private FulfillmentStorage $storage, private HydratesFulfillments $fulfillmentHydrator )
	{
	}

	public function fetchFulfillment( RepresentsQueryConstraints $queryConstraints ): Fulfillment
	{
	    $entity = $this->storage->fetchFulfillment( $queryConstraints );
	    if( null !== $entity )
	    {
		    return $this->fulfillmentHydrator->hydrate( $this->storage->fetchFulfillment( $queryConstraints ) );
	    }
	    
	    throw new NotFoundException( 'Fulfillment not found' );
	}

	/**
	 * @param RepresentsQueryConstraints $queryConstraints
	 *
	 * @return \Iterator<int, Fulfillment>
	 */
	public function fetchFulfillments( RepresentsQueryConstraints $queryConstraints ): \Iterator
	{
		foreach( $this->storage->fetchFulfillments( $queryConstraints ) as $entity)
		{
		    yield $this->fulfillmentHydrator->hydrate( $entity );
		}
	}
}

$repo = new FulfillmentRepo(new FulfillmentStorage());
```
