<?php

namespace model\model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use model\model\Farm as ChildFarm;
use model\model\FarmQuery as ChildFarmQuery;
use model\model\Map\FarmTableMap;

/**
 * Base class that represents a query for the 'farm' table.
 *
 *
 *
 * @method     ChildFarmQuery orderByFarmid($order = Criteria::ASC) Order by the farmID column
 * @method     ChildFarmQuery orderByFarmname($order = Criteria::ASC) Order by the farmName column
 * @method     ChildFarmQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildFarmQuery orderByPassword($order = Criteria::ASC) Order by the password column
 *
 * @method     ChildFarmQuery groupByFarmid() Group by the farmID column
 * @method     ChildFarmQuery groupByFarmname() Group by the farmName column
 * @method     ChildFarmQuery groupByUsername() Group by the username column
 * @method     ChildFarmQuery groupByPassword() Group by the password column
 *
 * @method     ChildFarmQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFarmQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFarmQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFarmQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFarmQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFarmQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFarmQuery leftJoinCow($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cow relation
 * @method     ChildFarmQuery rightJoinCow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cow relation
 * @method     ChildFarmQuery innerJoinCow($relationAlias = null) Adds a INNER JOIN clause to the query using the Cow relation
 *
 * @method     ChildFarmQuery joinWithCow($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cow relation
 *
 * @method     ChildFarmQuery leftJoinWithCow() Adds a LEFT JOIN clause and with to the query using the Cow relation
 * @method     ChildFarmQuery rightJoinWithCow() Adds a RIGHT JOIN clause and with to the query using the Cow relation
 * @method     ChildFarmQuery innerJoinWithCow() Adds a INNER JOIN clause and with to the query using the Cow relation
 *
 * @method     \model\model\CowQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFarm findOne(ConnectionInterface $con = null) Return the first ChildFarm matching the query
 * @method     ChildFarm findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFarm matching the query, or a new ChildFarm object populated from the query conditions when no match is found
 *
 * @method     ChildFarm findOneByFarmid(int $farmID) Return the first ChildFarm filtered by the farmID column
 * @method     ChildFarm findOneByFarmname(string $farmName) Return the first ChildFarm filtered by the farmName column
 * @method     ChildFarm findOneByUsername(string $username) Return the first ChildFarm filtered by the username column
 * @method     ChildFarm findOneByPassword(string $password) Return the first ChildFarm filtered by the password column *

 * @method     ChildFarm requirePk($key, ConnectionInterface $con = null) Return the ChildFarm by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFarm requireOne(ConnectionInterface $con = null) Return the first ChildFarm matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFarm requireOneByFarmid(int $farmID) Return the first ChildFarm filtered by the farmID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFarm requireOneByFarmname(string $farmName) Return the first ChildFarm filtered by the farmName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFarm requireOneByUsername(string $username) Return the first ChildFarm filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFarm requireOneByPassword(string $password) Return the first ChildFarm filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFarm[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFarm objects based on current ModelCriteria
 * @method     ChildFarm[]|ObjectCollection findByFarmid(int $farmID) Return ChildFarm objects filtered by the farmID column
 * @method     ChildFarm[]|ObjectCollection findByFarmname(string $farmName) Return ChildFarm objects filtered by the farmName column
 * @method     ChildFarm[]|ObjectCollection findByUsername(string $username) Return ChildFarm objects filtered by the username column
 * @method     ChildFarm[]|ObjectCollection findByPassword(string $password) Return ChildFarm objects filtered by the password column
 * @method     ChildFarm[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FarmQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \model\model\Base\FarmQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'smart_cattle', $modelName = '\\model\\model\\Farm', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFarmQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFarmQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFarmQuery) {
            return $criteria;
        }
        $query = new ChildFarmQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFarm|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FarmTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FarmTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFarm A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT farmID, farmName, username, password FROM farm WHERE farmID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFarm $obj */
            $obj = new ChildFarm();
            $obj->hydrate($row);
            FarmTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildFarm|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FarmTableMap::COL_FARMID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FarmTableMap::COL_FARMID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the farmID column
     *
     * Example usage:
     * <code>
     * $query->filterByFarmid(1234); // WHERE farmID = 1234
     * $query->filterByFarmid(array(12, 34)); // WHERE farmID IN (12, 34)
     * $query->filterByFarmid(array('min' => 12)); // WHERE farmID > 12
     * </code>
     *
     * @param     mixed $farmid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function filterByFarmid($farmid = null, $comparison = null)
    {
        if (is_array($farmid)) {
            $useMinMax = false;
            if (isset($farmid['min'])) {
                $this->addUsingAlias(FarmTableMap::COL_FARMID, $farmid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($farmid['max'])) {
                $this->addUsingAlias(FarmTableMap::COL_FARMID, $farmid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FarmTableMap::COL_FARMID, $farmid, $comparison);
    }

    /**
     * Filter the query on the farmName column
     *
     * Example usage:
     * <code>
     * $query->filterByFarmname('fooValue');   // WHERE farmName = 'fooValue'
     * $query->filterByFarmname('%fooValue%', Criteria::LIKE); // WHERE farmName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $farmname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function filterByFarmname($farmname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($farmname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FarmTableMap::COL_FARMNAME, $farmname, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FarmTableMap::COL_USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FarmTableMap::COL_PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query by a related \model\model\Cow object
     *
     * @param \model\model\Cow|ObjectCollection $cow the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFarmQuery The current query, for fluid interface
     */
    public function filterByCow($cow, $comparison = null)
    {
        if ($cow instanceof \model\model\Cow) {
            return $this
                ->addUsingAlias(FarmTableMap::COL_FARMID, $cow->getFarmid(), $comparison);
        } elseif ($cow instanceof ObjectCollection) {
            return $this
                ->useCowQuery()
                ->filterByPrimaryKeys($cow->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCow() only accepts arguments of type \model\model\Cow or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cow relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function joinCow($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cow');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Cow');
        }

        return $this;
    }

    /**
     * Use the Cow relation Cow object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\CowQuery A secondary query class using the current class as primary query
     */
    public function useCowQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCow($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cow', '\model\model\CowQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFarm $farm Object to remove from the list of results
     *
     * @return $this|ChildFarmQuery The current query, for fluid interface
     */
    public function prune($farm = null)
    {
        if ($farm) {
            $this->addUsingAlias(FarmTableMap::COL_FARMID, $farm->getFarmid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the farm table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FarmTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FarmTableMap::clearInstancePool();
            FarmTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FarmTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FarmTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FarmTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FarmTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FarmQuery
