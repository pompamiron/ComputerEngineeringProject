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
use model\model\Cow;
use model\model\CowQuery;


/**
 * This class defines the structure of the 'cow' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CowTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.model.Map.CowTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'smart_cattle';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'cow';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\model\\model\\Cow';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'model.model.Cow';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the cowID field
     */
    const COL_COWID = 'cow.cowID';

    /**
     * the column name for the farmID field
     */
    const COL_FARMID = 'cow.farmID';

    /**
     * the column name for the hwID1 field
     */
    const COL_HWID1 = 'cow.hwID1';

    /**
     * the column name for the hwID2 field
     */
    const COL_HWID2 = 'cow.hwID2';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'cow.name';

    /**
     * the column name for the birthDate field
     */
    const COL_BIRTHDATE = 'cow.birthDate';

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
        self::TYPE_PHPNAME       => array('Cowid', 'Farmid', 'Hwid1', 'Hwid2', 'Name', 'Birthdate', ),
        self::TYPE_CAMELNAME     => array('cowid', 'farmid', 'hwid1', 'hwid2', 'name', 'birthdate', ),
        self::TYPE_COLNAME       => array(CowTableMap::COL_COWID, CowTableMap::COL_FARMID, CowTableMap::COL_HWID1, CowTableMap::COL_HWID2, CowTableMap::COL_NAME, CowTableMap::COL_BIRTHDATE, ),
        self::TYPE_FIELDNAME     => array('cowID', 'farmID', 'hwID1', 'hwID2', 'name', 'birthDate', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Cowid' => 0, 'Farmid' => 1, 'Hwid1' => 2, 'Hwid2' => 3, 'Name' => 4, 'Birthdate' => 5, ),
        self::TYPE_CAMELNAME     => array('cowid' => 0, 'farmid' => 1, 'hwid1' => 2, 'hwid2' => 3, 'name' => 4, 'birthdate' => 5, ),
        self::TYPE_COLNAME       => array(CowTableMap::COL_COWID => 0, CowTableMap::COL_FARMID => 1, CowTableMap::COL_HWID1 => 2, CowTableMap::COL_HWID2 => 3, CowTableMap::COL_NAME => 4, CowTableMap::COL_BIRTHDATE => 5, ),
        self::TYPE_FIELDNAME     => array('cowID' => 0, 'farmID' => 1, 'hwID1' => 2, 'hwID2' => 3, 'name' => 4, 'birthDate' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('cow');
        $this->setPhpName('Cow');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\model\\model\\Cow');
        $this->setPackage('model.model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('cowID', 'Cowid', 'INTEGER', true, null, null);
        $this->addForeignKey('farmID', 'Farmid', 'INTEGER', 'farm', 'farmID', true, null, null);
        $this->addForeignKey('hwID1', 'Hwid1', 'INTEGER', 'hardware', 'hwID', true, null, null);
        $this->addForeignKey('hwID2', 'Hwid2', 'INTEGER', 'hardware', 'hwID', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('birthDate', 'Birthdate', 'DATE', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Farm', '\\model\\model\\Farm', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':farmID',
    1 => ':farmID',
  ),
), null, null, null, false);
        $this->addRelation('HardwareRelatedByHwid1', '\\model\\model\\Hardware', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':hwID1',
    1 => ':hwID',
  ),
), null, null, null, false);
        $this->addRelation('HardwareRelatedByHwid2', '\\model\\model\\Hardware', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':hwID2',
    1 => ':hwID',
  ),
), null, null, null, false);
        $this->addRelation('Behavior_data', '\\model\\model\\Behavior_data', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':cowID',
    1 => ':cowID',
  ),
), null, null, 'Behavior_datas', false);
        $this->addRelation('General_data', '\\model\\model\\General_data', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':cowID',
    1 => ':cowID',
  ),
), null, null, 'General_datas', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CowTableMap::CLASS_DEFAULT : CowTableMap::OM_CLASS;
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
     * @return array           (Cow object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CowTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CowTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CowTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CowTableMap::OM_CLASS;
            /** @var Cow $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CowTableMap::addInstanceToPool($obj, $key);
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
            $key = CowTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CowTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Cow $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CowTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CowTableMap::COL_COWID);
            $criteria->addSelectColumn(CowTableMap::COL_FARMID);
            $criteria->addSelectColumn(CowTableMap::COL_HWID1);
            $criteria->addSelectColumn(CowTableMap::COL_HWID2);
            $criteria->addSelectColumn(CowTableMap::COL_NAME);
            $criteria->addSelectColumn(CowTableMap::COL_BIRTHDATE);
        } else {
            $criteria->addSelectColumn($alias . '.cowID');
            $criteria->addSelectColumn($alias . '.farmID');
            $criteria->addSelectColumn($alias . '.hwID1');
            $criteria->addSelectColumn($alias . '.hwID2');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.birthDate');
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
        return Propel::getServiceContainer()->getDatabaseMap(CowTableMap::DATABASE_NAME)->getTable(CowTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CowTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CowTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CowTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Cow or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Cow object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CowTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \model\model\Cow) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CowTableMap::DATABASE_NAME);
            $criteria->add(CowTableMap::COL_COWID, (array) $values, Criteria::IN);
        }

        $query = CowQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CowTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CowTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cow table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CowQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Cow or Criteria object.
     *
     * @param mixed               $criteria Criteria or Cow object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CowTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Cow object
        }

        if ($criteria->containsKey(CowTableMap::COL_COWID) && $criteria->keyContainsValue(CowTableMap::COL_COWID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CowTableMap::COL_COWID.')');
        }


        // Set the correct dbName
        $query = CowQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CowTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CowTableMap::buildTableMap();
