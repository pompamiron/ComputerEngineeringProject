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
use model\model\Hardware as ChildHardware;
use model\model\HardwareQuery as ChildHardwareQuery;
use model\model\Map\HardwareTableMap;

/**
 * Base class that represents a query for the 'hardware' table.
 *
 *
 *
 * @method     ChildHardwareQuery orderByHwid($order = Criteria::ASC) Order by the hwID column
 * @method     ChildHardwareQuery orderByInstallpath($order = Criteria::ASC) Order by the installPath column
 * @method     ChildHardwareQuery orderByName($order = Criteria::ASC) Order by the name column
 *
 * @method     ChildHardwareQuery groupByHwid() Group by the hwID column
 * @method     ChildHardwareQuery groupByInstallpath() Group by the installPath column
 * @method     ChildHardwareQuery groupByName() Group by the name column
 *
 * @method     ChildHardwareQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildHardwareQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildHardwareQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildHardwareQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildHardwareQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildHardwareQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildHardwareQuery leftJoinCowRelatedByHwid1($relationAlias = null) Adds a LEFT JOIN clause to the query using the CowRelatedByHwid1 relation
 * @method     ChildHardwareQuery rightJoinCowRelatedByHwid1($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CowRelatedByHwid1 relation
 * @method     ChildHardwareQuery innerJoinCowRelatedByHwid1($relationAlias = null) Adds a INNER JOIN clause to the query using the CowRelatedByHwid1 relation
 *
 * @method     ChildHardwareQuery joinWithCowRelatedByHwid1($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CowRelatedByHwid1 relation
 *
 * @method     ChildHardwareQuery leftJoinWithCowRelatedByHwid1() Adds a LEFT JOIN clause and with to the query using the CowRelatedByHwid1 relation
 * @method     ChildHardwareQuery rightJoinWithCowRelatedByHwid1() Adds a RIGHT JOIN clause and with to the query using the CowRelatedByHwid1 relation
 * @method     ChildHardwareQuery innerJoinWithCowRelatedByHwid1() Adds a INNER JOIN clause and with to the query using the CowRelatedByHwid1 relation
 *
 * @method     ChildHardwareQuery leftJoinCowRelatedByHwid2($relationAlias = null) Adds a LEFT JOIN clause to the query using the CowRelatedByHwid2 relation
 * @method     ChildHardwareQuery rightJoinCowRelatedByHwid2($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CowRelatedByHwid2 relation
 * @method     ChildHardwareQuery innerJoinCowRelatedByHwid2($relationAlias = null) Adds a INNER JOIN clause to the query using the CowRelatedByHwid2 relation
 *
 * @method     ChildHardwareQuery joinWithCowRelatedByHwid2($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CowRelatedByHwid2 relation
 *
 * @method     ChildHardwareQuery leftJoinWithCowRelatedByHwid2() Adds a LEFT JOIN clause and with to the query using the CowRelatedByHwid2 relation
 * @method     ChildHardwareQuery rightJoinWithCowRelatedByHwid2() Adds a RIGHT JOIN clause and with to the query using the CowRelatedByHwid2 relation
 * @method     ChildHardwareQuery innerJoinWithCowRelatedByHwid2() Adds a INNER JOIN clause and with to the query using the CowRelatedByHwid2 relation
 *
 * @method     \model\model\CowQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildHardware findOne(ConnectionInterface $con = null) Return the first ChildHardware matching the query
 * @method     ChildHardware findOneOrCreate(ConnectionInterface $con = null) Return the first ChildHardware matching the query, or a new ChildHardware object populated from the query conditions when no match is found
 *
 * @method     ChildHardware findOneByHwid(int $hwID) Return the first ChildHardware filtered by the hwID column
 * @method     ChildHardware findOneByInstallpath(string $installPath) Return the first ChildHardware filtered by the installPath column
 * @method     ChildHardware findOneByName(string $name) Return the first ChildHardware filtered by the name column *

 * @method     ChildHardware requirePk($key, ConnectionInterface $con = null) Return the ChildHardware by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHardware requireOne(ConnectionInterface $con = null) Return the first ChildHardware matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHardware requireOneByHwid(int $hwID) Return the first ChildHardware filtered by the hwID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHardware requireOneByInstallpath(string $installPath) Return the first ChildHardware filtered by the installPath column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildHardware requireOneByName(string $name) Return the first ChildHardware filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildHardware[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildHardware objects based on current ModelCriteria
 * @method     ChildHardware[]|ObjectCollection findByHwid(int $hwID) Return ChildHardware objects filtered by the hwID column
 * @method     ChildHardware[]|ObjectCollection findByInstallpath(string $installPath) Return ChildHardware objects filtered by the installPath column
 * @method     ChildHardware[]|ObjectCollection findByName(string $name) Return ChildHardware objects filtered by the name column
 * @method     ChildHardware[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class HardwareQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \model\model\Base\HardwareQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'smart_cattle', $modelName = '\\model\\model\\Hardware', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildHardwareQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildHardwareQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildHardwareQuery) {
            return $criteria;
        }
        $query = new ChildHardwareQuery();
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
     * @return ChildHardware|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(HardwareTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = HardwareTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildHardware A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT hwID, installPath, name FROM hardware WHERE hwID = :p0';
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
            /** @var ChildHardware $obj */
            $obj = new ChildHardware();
            $obj->hydrate($row);
            HardwareTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildHardware|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(HardwareTableMap::COL_HWID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(HardwareTableMap::COL_HWID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the hwID column
     *
     * Example usage:
     * <code>
     * $query->filterByHwid(1234); // WHERE hwID = 1234
     * $query->filterByHwid(array(12, 34)); // WHERE hwID IN (12, 34)
     * $query->filterByHwid(array('min' => 12)); // WHERE hwID > 12
     * </code>
     *
     * @param     mixed $hwid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function filterByHwid($hwid = null, $comparison = null)
    {
        if (is_array($hwid)) {
            $useMinMax = false;
            if (isset($hwid['min'])) {
                $this->addUsingAlias(HardwareTableMap::COL_HWID, $hwid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hwid['max'])) {
                $this->addUsingAlias(HardwareTableMap::COL_HWID, $hwid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HardwareTableMap::COL_HWID, $hwid, $comparison);
    }

    /**
     * Filter the query on the installPath column
     *
     * Example usage:
     * <code>
     * $query->filterByInstallpath('fooValue');   // WHERE installPath = 'fooValue'
     * $query->filterByInstallpath('%fooValue%', Criteria::LIKE); // WHERE installPath LIKE '%fooValue%'
     * </code>
     *
     * @param     string $installpath The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function filterByInstallpath($installpath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($installpath)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HardwareTableMap::COL_INSTALLPATH, $installpath, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(HardwareTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query by a related \model\model\Cow object
     *
     * @param \model\model\Cow|ObjectCollection $cow the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHardwareQuery The current query, for fluid interface
     */
    public function filterByCowRelatedByHwid1($cow, $comparison = null)
    {
        if ($cow instanceof \model\model\Cow) {
            return $this
                ->addUsingAlias(HardwareTableMap::COL_HWID, $cow->getHwid1(), $comparison);
        } elseif ($cow instanceof ObjectCollection) {
            return $this
                ->useCowRelatedByHwid1Query()
                ->filterByPrimaryKeys($cow->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCowRelatedByHwid1() only accepts arguments of type \model\model\Cow or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CowRelatedByHwid1 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function joinCowRelatedByHwid1($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CowRelatedByHwid1');

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
            $this->addJoinObject($join, 'CowRelatedByHwid1');
        }

        return $this;
    }

    /**
     * Use the CowRelatedByHwid1 relation Cow object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\CowQuery A secondary query class using the current class as primary query
     */
    public function useCowRelatedByHwid1Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCowRelatedByHwid1($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CowRelatedByHwid1', '\model\model\CowQuery');
    }

    /**
     * Filter the query by a related \model\model\Cow object
     *
     * @param \model\model\Cow|ObjectCollection $cow the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildHardwareQuery The current query, for fluid interface
     */
    public function filterByCowRelatedByHwid2($cow, $comparison = null)
    {
        if ($cow instanceof \model\model\Cow) {
            return $this
                ->addUsingAlias(HardwareTableMap::COL_HWID, $cow->getHwid2(), $comparison);
        } elseif ($cow instanceof ObjectCollection) {
            return $this
                ->useCowRelatedByHwid2Query()
                ->filterByPrimaryKeys($cow->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCowRelatedByHwid2() only accepts arguments of type \model\model\Cow or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CowRelatedByHwid2 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function joinCowRelatedByHwid2($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CowRelatedByHwid2');

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
            $this->addJoinObject($join, 'CowRelatedByHwid2');
        }

        return $this;
    }

    /**
     * Use the CowRelatedByHwid2 relation Cow object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\CowQuery A secondary query class using the current class as primary query
     */
    public function useCowRelatedByHwid2Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCowRelatedByHwid2($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CowRelatedByHwid2', '\model\model\CowQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildHardware $hardware Object to remove from the list of results
     *
     * @return $this|ChildHardwareQuery The current query, for fluid interface
     */
    public function prune($hardware = null)
    {
        if ($hardware) {
            $this->addUsingAlias(HardwareTableMap::COL_HWID, $hardware->getHwid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the hardware table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(HardwareTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            HardwareTableMap::clearInstancePool();
            HardwareTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(HardwareTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(HardwareTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            HardwareTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            HardwareTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // HardwareQuery
