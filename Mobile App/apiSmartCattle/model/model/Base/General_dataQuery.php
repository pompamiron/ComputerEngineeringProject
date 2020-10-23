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
use model\model\General_data as ChildGeneral_data;
use model\model\General_dataQuery as ChildGeneral_dataQuery;
use model\model\Map\General_dataTableMap;

/**
 * Base class that represents a query for the 'general_data' table.
 *
 *
 *
 * @method     ChildGeneral_dataQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildGeneral_dataQuery orderByCowid($order = Criteria::ASC) Order by the cowID column
 * @method     ChildGeneral_dataQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method     ChildGeneral_dataQuery orderByTime($order = Criteria::ASC) Order by the time column
 *
 * @method     ChildGeneral_dataQuery groupById() Group by the ID column
 * @method     ChildGeneral_dataQuery groupByCowid() Group by the cowID column
 * @method     ChildGeneral_dataQuery groupByAction() Group by the action column
 * @method     ChildGeneral_dataQuery groupByTime() Group by the time column
 *
 * @method     ChildGeneral_dataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGeneral_dataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGeneral_dataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGeneral_dataQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGeneral_dataQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGeneral_dataQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGeneral_dataQuery leftJoinCow($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cow relation
 * @method     ChildGeneral_dataQuery rightJoinCow($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cow relation
 * @method     ChildGeneral_dataQuery innerJoinCow($relationAlias = null) Adds a INNER JOIN clause to the query using the Cow relation
 *
 * @method     ChildGeneral_dataQuery joinWithCow($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cow relation
 *
 * @method     ChildGeneral_dataQuery leftJoinWithCow() Adds a LEFT JOIN clause and with to the query using the Cow relation
 * @method     ChildGeneral_dataQuery rightJoinWithCow() Adds a RIGHT JOIN clause and with to the query using the Cow relation
 * @method     ChildGeneral_dataQuery innerJoinWithCow() Adds a INNER JOIN clause and with to the query using the Cow relation
 *
 * @method     \model\model\CowQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGeneral_data findOne(ConnectionInterface $con = null) Return the first ChildGeneral_data matching the query
 * @method     ChildGeneral_data findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGeneral_data matching the query, or a new ChildGeneral_data object populated from the query conditions when no match is found
 *
 * @method     ChildGeneral_data findOneById(int $ID) Return the first ChildGeneral_data filtered by the ID column
 * @method     ChildGeneral_data findOneByCowid(int $cowID) Return the first ChildGeneral_data filtered by the cowID column
 * @method     ChildGeneral_data findOneByAction(string $action) Return the first ChildGeneral_data filtered by the action column
 * @method     ChildGeneral_data findOneByTime(string $time) Return the first ChildGeneral_data filtered by the time column *

 * @method     ChildGeneral_data requirePk($key, ConnectionInterface $con = null) Return the ChildGeneral_data by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeneral_data requireOne(ConnectionInterface $con = null) Return the first ChildGeneral_data matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeneral_data requireOneById(int $ID) Return the first ChildGeneral_data filtered by the ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeneral_data requireOneByCowid(int $cowID) Return the first ChildGeneral_data filtered by the cowID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeneral_data requireOneByAction(string $action) Return the first ChildGeneral_data filtered by the action column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGeneral_data requireOneByTime(string $time) Return the first ChildGeneral_data filtered by the time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGeneral_data[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGeneral_data objects based on current ModelCriteria
 * @method     ChildGeneral_data[]|ObjectCollection findById(int $ID) Return ChildGeneral_data objects filtered by the ID column
 * @method     ChildGeneral_data[]|ObjectCollection findByCowid(int $cowID) Return ChildGeneral_data objects filtered by the cowID column
 * @method     ChildGeneral_data[]|ObjectCollection findByAction(string $action) Return ChildGeneral_data objects filtered by the action column
 * @method     ChildGeneral_data[]|ObjectCollection findByTime(string $time) Return ChildGeneral_data objects filtered by the time column
 * @method     ChildGeneral_data[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class General_dataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \model\model\Base\General_dataQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'smart_cattle', $modelName = '\\model\\model\\General_data', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGeneral_dataQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGeneral_dataQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGeneral_dataQuery) {
            return $criteria;
        }
        $query = new ChildGeneral_dataQuery();
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
     * @return ChildGeneral_data|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(General_dataTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = General_dataTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGeneral_data A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, cowID, action, time FROM general_data WHERE ID = :p0';
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
            /** @var ChildGeneral_data $obj */
            $obj = new ChildGeneral_data();
            $obj->hydrate($row);
            General_dataTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGeneral_data|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(General_dataTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(General_dataTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(General_dataTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(General_dataTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(General_dataTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the cowID column
     *
     * Example usage:
     * <code>
     * $query->filterByCowid(1234); // WHERE cowID = 1234
     * $query->filterByCowid(array(12, 34)); // WHERE cowID IN (12, 34)
     * $query->filterByCowid(array('min' => 12)); // WHERE cowID > 12
     * </code>
     *
     * @see       filterByCow()
     *
     * @param     mixed $cowid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function filterByCowid($cowid = null, $comparison = null)
    {
        if (is_array($cowid)) {
            $useMinMax = false;
            if (isset($cowid['min'])) {
                $this->addUsingAlias(General_dataTableMap::COL_COWID, $cowid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cowid['max'])) {
                $this->addUsingAlias(General_dataTableMap::COL_COWID, $cowid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(General_dataTableMap::COL_COWID, $cowid, $comparison);
    }

    /**
     * Filter the query on the action column
     *
     * Example usage:
     * <code>
     * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
     * $query->filterByAction('%fooValue%', Criteria::LIKE); // WHERE action LIKE '%fooValue%'
     * </code>
     *
     * @param     string $action The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function filterByAction($action = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($action)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(General_dataTableMap::COL_ACTION, $action, $comparison);
    }

    /**
     * Filter the query on the time column
     *
     * Example usage:
     * <code>
     * $query->filterByTime('2011-03-14'); // WHERE time = '2011-03-14'
     * $query->filterByTime('now'); // WHERE time = '2011-03-14'
     * $query->filterByTime(array('max' => 'yesterday')); // WHERE time > '2011-03-13'
     * </code>
     *
     * @param     mixed $time The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function filterByTime($time = null, $comparison = null)
    {
        if (is_array($time)) {
            $useMinMax = false;
            if (isset($time['min'])) {
                $this->addUsingAlias(General_dataTableMap::COL_TIME, $time['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($time['max'])) {
                $this->addUsingAlias(General_dataTableMap::COL_TIME, $time['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(General_dataTableMap::COL_TIME, $time, $comparison);
    }

    /**
     * Filter the query by a related \model\model\Cow object
     *
     * @param \model\model\Cow|ObjectCollection $cow The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function filterByCow($cow, $comparison = null)
    {
        if ($cow instanceof \model\model\Cow) {
            return $this
                ->addUsingAlias(General_dataTableMap::COL_COWID, $cow->getCowid(), $comparison);
        } elseif ($cow instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(General_dataTableMap::COL_COWID, $cow->toKeyValue('PrimaryKey', 'Cowid'), $comparison);
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
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
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
     * @param   ChildGeneral_data $general_data Object to remove from the list of results
     *
     * @return $this|ChildGeneral_dataQuery The current query, for fluid interface
     */
    public function prune($general_data = null)
    {
        if ($general_data) {
            $this->addUsingAlias(General_dataTableMap::COL_ID, $general_data->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the general_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(General_dataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            General_dataTableMap::clearInstancePool();
            General_dataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(General_dataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(General_dataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            General_dataTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            General_dataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // General_dataQuery
