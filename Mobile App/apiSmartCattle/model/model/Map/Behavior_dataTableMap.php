<?php

namespace model\model\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use model\model\Behavior_data;
use model\model\Behavior_dataQuery;


/**
 * This class defines the structure of the 'behavior_data' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class Behavior_dataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.model.Map.Behavior_dataTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'smart_cattle';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'behavior_data';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\model\\model\\Behavior_data';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'model.model.Behavior_data';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the ID field
     */
    const COL_ID = 'behavior_data.ID';

    /**
     * the column name for the cowID field
     */
    const COL_COWID = 'behavior_data.cowID';

    /**
     * the column name for the behavior field
     */
    const COL_BEHAVIOR = 'behavior_data.behavior';

    /**
     * the column name for the time field
     */
    const COL_TIME = 'behavior_data.time';

    /**
     * the column name for the duration field
     */
    const COL_DURATION = 'behavior_data.duration';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Cowid', 'Behavior', 'Time', 'Duration', ),
        self::TYPE_CAMELNAME     => array('id', 'cowid', 'behavior', 'time', 'duration', ),
        self::TYPE_COLNAME       => array(Behavior_dataTableMap::COL_ID, Behavior_dataTableMap::COL_COWID, Behavior_dataTableMap::COL_BEHAVIOR, Behavior_dataTableMap::COL_TIME, Behavior_dataTableMap::COL_DURATION, ),
        self::TYPE_FIELDNAME     => array('ID', 'cowID', 'behavior', 'time', 'duration', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Cowid' => 1, 'Behavior' => 2, 'Time' => 3, 'Duration' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'cowid' => 1, 'behavior' => 2, 'time' => 3, 'duration' => 4, ),
        self::TYPE_COLNAME       => array(Behavior_dataTableMap::COL_ID => 0, Behavior_dataTableMap::COL_COWID => 1, Behavior_dataTableMap::COL_BEHAVIOR => 2, Behavior_dataTableMap::COL_TIME => 3, Behavior_dataTableMap::COL_DURATION => 4, ),
        self::TYPE_FIELDNAME     => array('ID' => 0, 'cowID' => 1, 'behavior' => 2, 'time' => 3, 'duration' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('behavior_data');
        $this->setPhpName('Behavior_data');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\model\\model\\Behavior_data');
        $this->setPackage('model.model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('cowID', 'Cowid', 'INTEGER', 'cow', 'cowID', true, null, null);
        $this->addColumn('behavior', 'Behavior', 'VARCHAR', true, 100, null);
        $this->addColumn('time', 'Time', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('duration', 'Duration', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Cow', '\\model\\model\\Cow', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':cowID',
    1 => ':cowID',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? Behavior_dataTableMap::CLASS_DEFAULT : Behavior_dataTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Behavior_data object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = Behavior_dataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = Behavior_dataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + Behavior_dataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = Behavior_dataTableMap::OM_CLASS;
            /** @var Behavior_data $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            Behavior_dataTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = Behavior_dataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = Behavior_dataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Behavior_data $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                Behavior_dataTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(Behavior_dataTableMap::COL_ID);
            $criteria->addSelectColumn(Behavior_dataTableMap::COL_COWID);
            $criteria->addSelectColumn(Behavior_dataTableMap::COL_BEHAVIOR);
            $criteria->addSelectColumn(Behavior_dataTableMap::COL_TIME);
            $criteria->addSelectColumn(Behavior_dataTableMap::COL_DURATION);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.cowID');
            $criteria->addSelectColumn($alias . '.behavior');
            $criteria->addSelectColumn($alias . '.time');
            $criteria->addSelectColumn($alias . '.duration');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(Behavior_dataTableMap::DATABASE_NAME)->getTable(Behavior_dataTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(Behavior_dataTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(Behavior_dataTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new Behavior_dataTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Behavior_data or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Behavior_data object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(Behavior_dataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \model\model\Behavior_data) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(Behavior_dataTableMap::DATABASE_NAME);
            $criteria->add(Behavior_dataTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = Behavior_dataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            Behavior_dataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                Behavior_dataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the behavior_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return Behavior_dataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Behavior_data or Criteria object.
     *
     * @param mixed               $criteria Criteria or Behavior_data object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(Behavior_dataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Behavior_data object
        }

        if ($criteria->containsKey(Behavior_dataTableMap::COL_ID) && $criteria->keyContainsValue(Behavior_dataTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.Behavior_dataTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = Behavior_dataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // Behavior_dataTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
Behavior_dataTableMap::buildTableMap();
