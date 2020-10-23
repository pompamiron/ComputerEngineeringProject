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
use model\model\Cow as ChildCow;
use model\model\CowQuery as ChildCowQuery;
use model\model\Map\CowTableMap;

/**
 * Base class that represents a query for the 'cow' table.
 *
 *
 *
 * @method     ChildCowQuery orderByCowid($order = Criteria::ASC) Order by the cowID column
 * @method     ChildCowQuery orderByFarmid($order = Criteria::ASC) Order by the farmID column
 * @method     ChildCowQuery orderByHwid1($order = Criteria::ASC) Order by the hwID1 column
 * @method     ChildCowQuery orderByHwid2($order = Criteria::ASC) Order by the hwID2 column
 * @method     ChildCowQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCowQuery orderByBirthdate($order = Criteria::ASC) Order by the birthDate column
 *
 * @method     ChildCowQuery groupByCowid() Group by the cowID column
 * @method     ChildCowQuery groupByFarmid() Group by the farmID column
 * @method     ChildCowQuery groupByHwid1() Group by the hwID1 column
 * @method     ChildCowQuery groupByHwid2() Group by the hwID2 column
 * @method     ChildCowQuery groupByName() Group by the name column
 * @method     ChildCowQuery groupByBirthdate() Group by the birthDate column
 *
 * @method     ChildCowQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCowQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCowQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCowQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCowQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCowQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCowQuery leftJoinFarm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Farm relation
 * @method     ChildCowQuery rightJoinFarm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Farm relation
 * @method     ChildCowQuery innerJoinFarm($relationAlias = null) Adds a INNER JOIN clause to the query using the Farm relation
 *
 * @method     ChildCowQuery joinWithFarm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Farm relation
 *
 * @method     ChildCowQuery leftJoinWithFarm() Adds a LEFT JOIN clause and with to the query using the Farm relation
 * @method     ChildCowQuery rightJoinWithFarm() Adds a RIGHT JOIN clause and with to the query using the Farm relation
 * @method     ChildCowQuery innerJoinWithFarm() Adds a INNER JOIN clause and with to the query using the Farm relation
 *
 * @method     ChildCowQuery leftJoinHardwareRelatedByHwid1($relationAlias = null) Adds a LEFT JOIN clause to the query using the HardwareRelatedByHwid1 relation
 * @method     ChildCowQuery rightJoinHardwareRelatedByHwid1($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HardwareRelatedByHwid1 relation
 * @method     ChildCowQuery innerJoinHardwareRelatedByHwid1($relationAlias = null) Adds a INNER JOIN clause to the query using the HardwareRelatedByHwid1 relation
 *
 * @method     ChildCowQuery joinWithHardwareRelatedByHwid1($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HardwareRelatedByHwid1 relation
 *
 * @method     ChildCowQuery leftJoinWithHardwareRelatedByHwid1() Adds a LEFT JOIN clause and with to the query using the HardwareRelatedByHwid1 relation
 * @method     ChildCowQuery rightJoinWithHardwareRelatedByHwid1() Adds a RIGHT JOIN clause and with to the query using the HardwareRelatedByHwid1 relation
 * @method     ChildCowQuery innerJoinWithHardwareRelatedByHwid1() Adds a INNER JOIN clause and with to the query using the HardwareRelatedByHwid1 relation
 *
 * @method     ChildCowQuery leftJoinHardwareRelatedByHwid2($relationAlias = null) Adds a LEFT JOIN clause to the query using the HardwareRelatedByHwid2 relation
 * @method     ChildCowQuery rightJoinHardwareRelatedByHwid2($relationAlias = null) Adds a RIGHT JOIN clause to the query using the HardwareRelatedByHwid2 relation
 * @method     ChildCowQuery innerJoinHardwareRelatedByHwid2($relationAlias = null) Adds a INNER JOIN clause to the query using the HardwareRelatedByHwid2 relation
 *
 * @method     ChildCowQuery joinWithHardwareRelatedByHwid2($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the HardwareRelatedByHwid2 relation
 *
 * @method     ChildCowQuery leftJoinWithHardwareRelatedByHwid2() Adds a LEFT JOIN clause and with to the query using the HardwareRelatedByHwid2 relation
 * @method     ChildCowQuery rightJoinWithHardwareRelatedByHwid2() Adds a RIGHT JOIN clause and with to the query using the HardwareRelatedByHwid2 relation
 * @method     ChildCowQuery innerJoinWithHardwareRelatedByHwid2() Adds a INNER JOIN clause and with to the query using the HardwareRelatedByHwid2 relation
 *
 * @method     ChildCowQuery leftJoinBehavior_data($relationAlias = null) Adds a LEFT JOIN clause to the query using the Behavior_data relation
 * @method     ChildCowQuery rightJoinBehavior_data($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Behavior_data relation
 * @method     ChildCowQuery innerJoinBehavior_data($relationAlias = null) Adds a INNER JOIN clause to the query using the Behavior_data relation
 *
 * @method     ChildCowQuery joinWithBehavior_data($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Behavior_data relation
 *
 * @method     ChildCowQuery leftJoinWithBehavior_data() Adds a LEFT JOIN clause and with to the query using the Behavior_data relation
 * @method     ChildCowQuery rightJoinWithBehavior_data() Adds a RIGHT JOIN clause and with to the query using the Behavior_data relation
 * @method     ChildCowQuery innerJoinWithBehavior_data() Adds a INNER JOIN clause and with to the query using the Behavior_data relation
 *
 * @method     ChildCowQuery leftJoinGeneral_data($relationAlias = null) Adds a LEFT JOIN clause to the query using the General_data relation
 * @method     ChildCowQuery rightJoinGeneral_data($relationAlias = null) Adds a RIGHT JOIN clause to the query using the General_data relation
 * @method     ChildCowQuery innerJoinGeneral_data($relationAlias = null) Adds a INNER JOIN clause to the query using the General_data relation
 *
 * @method     ChildCowQuery joinWithGeneral_data($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the General_data relation
 *
 * @method     ChildCowQuery leftJoinWithGeneral_data() Adds a LEFT JOIN clause and with to the query using the General_data relation
 * @method     ChildCowQuery rightJoinWithGeneral_data() Adds a RIGHT JOIN clause and with to the query using the General_data relation
 * @method     ChildCowQuery innerJoinWithGeneral_data() Adds a INNER JOIN clause and with to the query using the General_data relation
 *
 * @method     \model\model\FarmQuery|\model\model\HardwareQuery|\model\model\Behavior_dataQuery|\model\model\General_dataQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCow findOne(ConnectionInterface $con = null) Return the first ChildCow matching the query
 * @method     ChildCow findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCow matching the query, or a new ChildCow object populated from the query conditions when no match is found
 *
 * @method     ChildCow findOneByCowid(int $cowID) Return the first ChildCow filtered by the cowID column
 * @method     ChildCow findOneByFarmid(int $farmID) Return the first ChildCow filtered by the farmID column
 * @method     ChildCow findOneByHwid1(int $hwID1) Return the first ChildCow filtered by the hwID1 column
 * @method     ChildCow findOneByHwid2(int $hwID2) Return the first ChildCow filtered by the hwID2 column
 * @method     ChildCow findOneByName(string $name) Return the first ChildCow filtered by the name column
 * @method     ChildCow findOneByBirthdate(string $birthDate) Return the first ChildCow filtered by the birthDate column *

 * @method     ChildCow requirePk($key, ConnectionInterface $con = null) Return the ChildCow by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCow requireOne(ConnectionInterface $con = null) Return the first ChildCow matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCow requireOneByCowid(int $cowID) Return the first ChildCow filtered by the cowID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCow requireOneByFarmid(int $farmID) Return the first ChildCow filtered by the farmID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCow requireOneByHwid1(int $hwID1) Return the first ChildCow filtered by the hwID1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCow requireOneByHwid2(int $hwID2) Return the first ChildCow filtered by the hwID2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCow requireOneByName(string $name) Return the first ChildCow filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCow requireOneByBirthdate(string $birthDate) Return the first ChildCow filtered by the birthDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCow[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCow objects based on current ModelCriteria
 * @method     ChildCow[]|ObjectCollection findByCowid(int $cowID) Return ChildCow objects filtered by the cowID column
 * @method     ChildCow[]|ObjectCollection findByFarmid(int $farmID) Return ChildCow objects filtered by the farmID column
 * @method     ChildCow[]|ObjectCollection findByHwid1(int $hwID1) Return ChildCow objects filtered by the hwID1 column
 * @method     ChildCow[]|ObjectCollection findByHwid2(int $hwID2) Return ChildCow objects filtered by the hwID2 column
 * @method     ChildCow[]|ObjectCollection findByName(string $name) Return ChildCow objects filtered by the name column
 * @method     ChildCow[]|ObjectCollection findByBirthdate(string $birthDate) Return ChildCow objects filtered by the birthDate column
 * @method     ChildCow[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CowQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \model\model\Base\CowQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'smart_cattle', $modelName = '\\model\\model\\Cow', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCowQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCowQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCowQuery) {
            return $criteria;
        }
        $query = new ChildCowQuery();
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
     * @return ChildCow|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CowTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CowTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCow A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT cowID, farmID, hwID1, hwID2, name, birthDate FROM cow WHERE cowID = :p0';
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
            /** @var ChildCow $obj */
            $obj = new ChildCow();
            $obj->hydrate($row);
            CowTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCow|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CowTableMap::COL_COWID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CowTableMap::COL_COWID, $keys, Criteria::IN);
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
     * @param     mixed $cowid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByCowid($cowid = null, $comparison = null)
    {
        if (is_array($cowid)) {
            $useMinMax = false;
            if (isset($cowid['min'])) {
                $this->addUsingAlias(CowTableMap::COL_COWID, $cowid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cowid['max'])) {
                $this->addUsingAlias(CowTableMap::COL_COWID, $cowid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CowTableMap::COL_COWID, $cowid, $comparison);
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
     * @see       filterByFarm()
     *
     * @param     mixed $farmid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByFarmid($farmid = null, $comparison = null)
    {
        if (is_array($farmid)) {
            $useMinMax = false;
            if (isset($farmid['min'])) {
                $this->addUsingAlias(CowTableMap::COL_FARMID, $farmid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($farmid['max'])) {
                $this->addUsingAlias(CowTableMap::COL_FARMID, $farmid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CowTableMap::COL_FARMID, $farmid, $comparison);
    }

    /**
     * Filter the query on the hwID1 column
     *
     * Example usage:
     * <code>
     * $query->filterByHwid1(1234); // WHERE hwID1 = 1234
     * $query->filterByHwid1(array(12, 34)); // WHERE hwID1 IN (12, 34)
     * $query->filterByHwid1(array('min' => 12)); // WHERE hwID1 > 12
     * </code>
     *
     * @see       filterByHardwareRelatedByHwid1()
     *
     * @param     mixed $hwid1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByHwid1($hwid1 = null, $comparison = null)
    {
        if (is_array($hwid1)) {
            $useMinMax = false;
            if (isset($hwid1['min'])) {
                $this->addUsingAlias(CowTableMap::COL_HWID1, $hwid1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hwid1['max'])) {
                $this->addUsingAlias(CowTableMap::COL_HWID1, $hwid1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CowTableMap::COL_HWID1, $hwid1, $comparison);
    }

    /**
     * Filter the query on the hwID2 column
     *
     * Example usage:
     * <code>
     * $query->filterByHwid2(1234); // WHERE hwID2 = 1234
     * $query->filterByHwid2(array(12, 34)); // WHERE hwID2 IN (12, 34)
     * $query->filterByHwid2(array('min' => 12)); // WHERE hwID2 > 12
     * </code>
     *
     * @see       filterByHardwareRelatedByHwid2()
     *
     * @param     mixed $hwid2 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByHwid2($hwid2 = null, $comparison = null)
    {
        if (is_array($hwid2)) {
            $useMinMax = false;
            if (isset($hwid2['min'])) {
                $this->addUsingAlias(CowTableMap::COL_HWID2, $hwid2['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hwid2['max'])) {
                $this->addUsingAlias(CowTableMap::COL_HWID2, $hwid2['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CowTableMap::COL_HWID2, $hwid2, $comparison);
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
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CowTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the birthDate column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthdate('2011-03-14'); // WHERE birthDate = '2011-03-14'
     * $query->filterByBirthdate('now'); // WHERE birthDate = '2011-03-14'
     * $query->filterByBirthdate(array('max' => 'yesterday')); // WHERE birthDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $birthdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function filterByBirthdate($birthdate = null, $comparison = null)
    {
        if (is_array($birthdate)) {
            $useMinMax = false;
            if (isset($birthdate['min'])) {
                $this->addUsingAlias(CowTableMap::COL_BIRTHDATE, $birthdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($birthdate['max'])) {
                $this->addUsingAlias(CowTableMap::COL_BIRTHDATE, $birthdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CowTableMap::COL_BIRTHDATE, $birthdate, $comparison);
    }

    /**
     * Filter the query by a related \model\model\Farm object
     *
     * @param \model\model\Farm|ObjectCollection $farm The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCowQuery The current query, for fluid interface
     */
    public function filterByFarm($farm, $comparison = null)
    {
        if ($farm instanceof \model\model\Farm) {
            return $this
                ->addUsingAlias(CowTableMap::COL_FARMID, $farm->getFarmid(), $comparison);
        } elseif ($farm instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CowTableMap::COL_FARMID, $farm->toKeyValue('PrimaryKey', 'Farmid'), $comparison);
        } else {
            throw new PropelException('filterByFarm() only accepts arguments of type \model\model\Farm or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Farm relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function joinFarm($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Farm');

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
            $this->addJoinObject($join, 'Farm');
        }

        return $this;
    }

    /**
     * Use the Farm relation Farm object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\FarmQuery A secondary query class using the current class as primary query
     */
    public function useFarmQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinFarm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Farm', '\model\model\FarmQuery');
    }

    /**
     * Filter the query by a related \model\model\Hardware object
     *
     * @param \model\model\Hardware|ObjectCollection $hardware The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCowQuery The current query, for fluid interface
     */
    public function filterByHardwareRelatedByHwid1($hardware, $comparison = null)
    {
        if ($hardware instanceof \model\model\Hardware) {
            return $this
                ->addUsingAlias(CowTableMap::COL_HWID1, $hardware->getHwid(), $comparison);
        } elseif ($hardware instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CowTableMap::COL_HWID1, $hardware->toKeyValue('PrimaryKey', 'Hwid'), $comparison);
        } else {
            throw new PropelException('filterByHardwareRelatedByHwid1() only accepts arguments of type \model\model\Hardware or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HardwareRelatedByHwid1 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function joinHardwareRelatedByHwid1($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HardwareRelatedByHwid1');

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
            $this->addJoinObject($join, 'HardwareRelatedByHwid1');
        }

        return $this;
    }

    /**
     * Use the HardwareRelatedByHwid1 relation Hardware object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\HardwareQuery A secondary query class using the current class as primary query
     */
    public function useHardwareRelatedByHwid1Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHardwareRelatedByHwid1($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HardwareRelatedByHwid1', '\model\model\HardwareQuery');
    }

    /**
     * Filter the query by a related \model\model\Hardware object
     *
     * @param \model\model\Hardware|ObjectCollection $hardware The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCowQuery The current query, for fluid interface
     */
    public function filterByHardwareRelatedByHwid2($hardware, $comparison = null)
    {
        if ($hardware instanceof \model\model\Hardware) {
            return $this
                ->addUsingAlias(CowTableMap::COL_HWID2, $hardware->getHwid(), $comparison);
        } elseif ($hardware instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CowTableMap::COL_HWID2, $hardware->toKeyValue('PrimaryKey', 'Hwid'), $comparison);
        } else {
            throw new PropelException('filterByHardwareRelatedByHwid2() only accepts arguments of type \model\model\Hardware or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the HardwareRelatedByHwid2 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function joinHardwareRelatedByHwid2($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('HardwareRelatedByHwid2');

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
            $this->addJoinObject($join, 'HardwareRelatedByHwid2');
        }

        return $this;
    }

    /**
     * Use the HardwareRelatedByHwid2 relation Hardware object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\HardwareQuery A secondary query class using the current class as primary query
     */
    public function useHardwareRelatedByHwid2Query($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHardwareRelatedByHwid2($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'HardwareRelatedByHwid2', '\model\model\HardwareQuery');
    }

    /**
     * Filter the query by a related \model\model\Behavior_data object
     *
     * @param \model\model\Behavior_data|ObjectCollection $behavior_data the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCowQuery The current query, for fluid interface
     */
    public function filterByBehavior_data($behavior_data, $comparison = null)
    {
        if ($behavior_data instanceof \model\model\Behavior_data) {
            return $this
                ->addUsingAlias(CowTableMap::COL_COWID, $behavior_data->getCowid(), $comparison);
        } elseif ($behavior_data instanceof ObjectCollection) {
            return $this
                ->useBehavior_dataQuery()
                ->filterByPrimaryKeys($behavior_data->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBehavior_data() only accepts arguments of type \model\model\Behavior_data or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Behavior_data relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function joinBehavior_data($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Behavior_data');

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
            $this->addJoinObject($join, 'Behavior_data');
        }

        return $this;
    }

    /**
     * Use the Behavior_data relation Behavior_data object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\Behavior_dataQuery A secondary query class using the current class as primary query
     */
    public function useBehavior_dataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBehavior_data($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Behavior_data', '\model\model\Behavior_dataQuery');
    }

    /**
     * Filter the query by a related \model\model\General_data object
     *
     * @param \model\model\General_data|ObjectCollection $general_data the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCowQuery The current query, for fluid interface
     */
    public function filterByGeneral_data($general_data, $comparison = null)
    {
        if ($general_data instanceof \model\model\General_data) {
            return $this
                ->addUsingAlias(CowTableMap::COL_COWID, $general_data->getCowid(), $comparison);
        } elseif ($general_data instanceof ObjectCollection) {
            return $this
                ->useGeneral_dataQuery()
                ->filterByPrimaryKeys($general_data->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGeneral_data() only accepts arguments of type \model\model\General_data or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the General_data relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function joinGeneral_data($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('General_data');

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
            $this->addJoinObject($join, 'General_data');
        }

        return $this;
    }

    /**
     * Use the General_data relation General_data object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \model\model\General_dataQuery A secondary query class using the current class as primary query
     */
    public function useGeneral_dataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGeneral_data($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'General_data', '\model\model\General_dataQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCow $cow Object to remove from the list of results
     *
     * @return $this|ChildCowQuery The current query, for fluid interface
     */
    public function prune($cow = null)
    {
        if ($cow) {
            $this->addUsingAlias(CowTableMap::COL_COWID, $cow->getCowid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cow table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CowTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CowTableMap::clearInstancePool();
            CowTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CowTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CowTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CowTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CowTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CowQuery
