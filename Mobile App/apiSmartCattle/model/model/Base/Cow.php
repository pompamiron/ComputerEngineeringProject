<?php

namespace model\model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use model\model\Behavior_data as ChildBehavior_data;
use model\model\Behavior_dataQuery as ChildBehavior_dataQuery;
use model\model\Cow as ChildCow;
use model\model\CowQuery as ChildCowQuery;
use model\model\Farm as ChildFarm;
use model\model\FarmQuery as ChildFarmQuery;
use model\model\General_data as ChildGeneral_data;
use model\model\General_dataQuery as ChildGeneral_dataQuery;
use model\model\Hardware as ChildHardware;
use model\model\HardwareQuery as ChildHardwareQuery;
use model\model\Map\Behavior_dataTableMap;
use model\model\Map\CowTableMap;
use model\model\Map\General_dataTableMap;

/**
 * Base class that represents a row from the 'cow' table.
 *
 *
 *
 * @package    propel.generator.model.model.Base
 */
abstract class Cow implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\model\\model\\Map\\CowTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the cowid field.
     *
     * @var        int
     */
    protected $cowid;

    /**
     * The value for the farmid field.
     *
     * @var        int
     */
    protected $farmid;

    /**
     * The value for the hwid1 field.
     *
     * @var        int
     */
    protected $hwid1;

    /**
     * The value for the hwid2 field.
     *
     * @var        int
     */
    protected $hwid2;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the birthdate field.
     *
     * @var        DateTime
     */
    protected $birthdate;

    /**
     * @var        ChildFarm
     */
    protected $aFarm;

    /**
     * @var        ChildHardware
     */
    protected $aHardwareRelatedByHwid1;

    /**
     * @var        ChildHardware
     */
    protected $aHardwareRelatedByHwid2;

    /**
     * @var        ObjectCollection|ChildBehavior_data[] Collection to store aggregation of ChildBehavior_data objects.
     */
    protected $collBehavior_datas;
    protected $collBehavior_datasPartial;

    /**
     * @var        ObjectCollection|ChildGeneral_data[] Collection to store aggregation of ChildGeneral_data objects.
     */
    protected $collGeneral_datas;
    protected $collGeneral_datasPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBehavior_data[]
     */
    protected $behavior_datasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildGeneral_data[]
     */
    protected $general_datasScheduledForDeletion = null;

    /**
     * Initializes internal state of model\model\Base\Cow object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Cow</code> instance.  If
     * <code>obj</code> is an instance of <code>Cow</code>, delegates to
     * <code>equals(Cow)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Cow The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [cowid] column value.
     *
     * @return int
     */
    public function getCowid()
    {
        return $this->cowid;
    }

    /**
     * Get the [farmid] column value.
     *
     * @return int
     */
    public function getFarmid()
    {
        return $this->farmid;
    }

    /**
     * Get the [hwid1] column value.
     *
     * @return int
     */
    public function getHwid1()
    {
        return $this->hwid1;
    }

    /**
     * Get the [hwid2] column value.
     *
     * @return int
     */
    public function getHwid2()
    {
        return $this->hwid2;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [optionally formatted] temporal [birthdate] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getBirthdate($format = NULL)
    {
        if ($format === null) {
            return $this->birthdate;
        } else {
            return $this->birthdate instanceof \DateTimeInterface ? $this->birthdate->format($format) : null;
        }
    }

    /**
     * Set the value of [cowid] column.
     *
     * @param int $v new value
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function setCowid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cowid !== $v) {
            $this->cowid = $v;
            $this->modifiedColumns[CowTableMap::COL_COWID] = true;
        }

        return $this;
    } // setCowid()

    /**
     * Set the value of [farmid] column.
     *
     * @param int $v new value
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function setFarmid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->farmid !== $v) {
            $this->farmid = $v;
            $this->modifiedColumns[CowTableMap::COL_FARMID] = true;
        }

        if ($this->aFarm !== null && $this->aFarm->getFarmid() !== $v) {
            $this->aFarm = null;
        }

        return $this;
    } // setFarmid()

    /**
     * Set the value of [hwid1] column.
     *
     * @param int $v new value
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function setHwid1($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->hwid1 !== $v) {
            $this->hwid1 = $v;
            $this->modifiedColumns[CowTableMap::COL_HWID1] = true;
        }

        if ($this->aHardwareRelatedByHwid1 !== null && $this->aHardwareRelatedByHwid1->getHwid() !== $v) {
            $this->aHardwareRelatedByHwid1 = null;
        }

        return $this;
    } // setHwid1()

    /**
     * Set the value of [hwid2] column.
     *
     * @param int $v new value
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function setHwid2($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->hwid2 !== $v) {
            $this->hwid2 = $v;
            $this->modifiedColumns[CowTableMap::COL_HWID2] = true;
        }

        if ($this->aHardwareRelatedByHwid2 !== null && $this->aHardwareRelatedByHwid2->getHwid() !== $v) {
            $this->aHardwareRelatedByHwid2 = null;
        }

        return $this;
    } // setHwid2()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[CowTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Sets the value of [birthdate] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function setBirthdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->birthdate !== null || $dt !== null) {
            if ($this->birthdate === null || $dt === null || $dt->format("Y-m-d") !== $this->birthdate->format("Y-m-d")) {
                $this->birthdate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CowTableMap::COL_BIRTHDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setBirthdate()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CowTableMap::translateFieldName('Cowid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cowid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CowTableMap::translateFieldName('Farmid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->farmid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CowTableMap::translateFieldName('Hwid1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hwid1 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CowTableMap::translateFieldName('Hwid2', TableMap::TYPE_PHPNAME, $indexType)];
            $this->hwid2 = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CowTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CowTableMap::translateFieldName('Birthdate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->birthdate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 6; // 6 = CowTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\model\\model\\Cow'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aFarm !== null && $this->farmid !== $this->aFarm->getFarmid()) {
            $this->aFarm = null;
        }
        if ($this->aHardwareRelatedByHwid1 !== null && $this->hwid1 !== $this->aHardwareRelatedByHwid1->getHwid()) {
            $this->aHardwareRelatedByHwid1 = null;
        }
        if ($this->aHardwareRelatedByHwid2 !== null && $this->hwid2 !== $this->aHardwareRelatedByHwid2->getHwid()) {
            $this->aHardwareRelatedByHwid2 = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CowTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCowQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aFarm = null;
            $this->aHardwareRelatedByHwid1 = null;
            $this->aHardwareRelatedByHwid2 = null;
            $this->collBehavior_datas = null;

            $this->collGeneral_datas = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Cow::setDeleted()
     * @see Cow::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CowTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCowQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CowTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CowTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aFarm !== null) {
                if ($this->aFarm->isModified() || $this->aFarm->isNew()) {
                    $affectedRows += $this->aFarm->save($con);
                }
                $this->setFarm($this->aFarm);
            }

            if ($this->aHardwareRelatedByHwid1 !== null) {
                if ($this->aHardwareRelatedByHwid1->isModified() || $this->aHardwareRelatedByHwid1->isNew()) {
                    $affectedRows += $this->aHardwareRelatedByHwid1->save($con);
                }
                $this->setHardwareRelatedByHwid1($this->aHardwareRelatedByHwid1);
            }

            if ($this->aHardwareRelatedByHwid2 !== null) {
                if ($this->aHardwareRelatedByHwid2->isModified() || $this->aHardwareRelatedByHwid2->isNew()) {
                    $affectedRows += $this->aHardwareRelatedByHwid2->save($con);
                }
                $this->setHardwareRelatedByHwid2($this->aHardwareRelatedByHwid2);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->behavior_datasScheduledForDeletion !== null) {
                if (!$this->behavior_datasScheduledForDeletion->isEmpty()) {
                    \model\model\Behavior_dataQuery::create()
                        ->filterByPrimaryKeys($this->behavior_datasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->behavior_datasScheduledForDeletion = null;
                }
            }

            if ($this->collBehavior_datas !== null) {
                foreach ($this->collBehavior_datas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->general_datasScheduledForDeletion !== null) {
                if (!$this->general_datasScheduledForDeletion->isEmpty()) {
                    \model\model\General_dataQuery::create()
                        ->filterByPrimaryKeys($this->general_datasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->general_datasScheduledForDeletion = null;
                }
            }

            if ($this->collGeneral_datas !== null) {
                foreach ($this->collGeneral_datas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[CowTableMap::COL_COWID] = true;
        if (null !== $this->cowid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CowTableMap::COL_COWID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CowTableMap::COL_COWID)) {
            $modifiedColumns[':p' . $index++]  = 'cowID';
        }
        if ($this->isColumnModified(CowTableMap::COL_FARMID)) {
            $modifiedColumns[':p' . $index++]  = 'farmID';
        }
        if ($this->isColumnModified(CowTableMap::COL_HWID1)) {
            $modifiedColumns[':p' . $index++]  = 'hwID1';
        }
        if ($this->isColumnModified(CowTableMap::COL_HWID2)) {
            $modifiedColumns[':p' . $index++]  = 'hwID2';
        }
        if ($this->isColumnModified(CowTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(CowTableMap::COL_BIRTHDATE)) {
            $modifiedColumns[':p' . $index++]  = 'birthDate';
        }

        $sql = sprintf(
            'INSERT INTO cow (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'cowID':
                        $stmt->bindValue($identifier, $this->cowid, PDO::PARAM_INT);
                        break;
                    case 'farmID':
                        $stmt->bindValue($identifier, $this->farmid, PDO::PARAM_INT);
                        break;
                    case 'hwID1':
                        $stmt->bindValue($identifier, $this->hwid1, PDO::PARAM_INT);
                        break;
                    case 'hwID2':
                        $stmt->bindValue($identifier, $this->hwid2, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'birthDate':
                        $stmt->bindValue($identifier, $this->birthdate ? $this->birthdate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setCowid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CowTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getCowid();
                break;
            case 1:
                return $this->getFarmid();
                break;
            case 2:
                return $this->getHwid1();
                break;
            case 3:
                return $this->getHwid2();
                break;
            case 4:
                return $this->getName();
                break;
            case 5:
                return $this->getBirthdate();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Cow'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Cow'][$this->hashCode()] = true;
        $keys = CowTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCowid(),
            $keys[1] => $this->getFarmid(),
            $keys[2] => $this->getHwid1(),
            $keys[3] => $this->getHwid2(),
            $keys[4] => $this->getName(),
            $keys[5] => $this->getBirthdate(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aFarm) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'farm';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'farm';
                        break;
                    default:
                        $key = 'Farm';
                }

                $result[$key] = $this->aFarm->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aHardwareRelatedByHwid1) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hardware';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hardware';
                        break;
                    default:
                        $key = 'Hardware';
                }

                $result[$key] = $this->aHardwareRelatedByHwid1->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aHardwareRelatedByHwid2) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'hardware';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'hardware';
                        break;
                    default:
                        $key = 'Hardware';
                }

                $result[$key] = $this->aHardwareRelatedByHwid2->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBehavior_datas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'behavior_datas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'behavior_datas';
                        break;
                    default:
                        $key = 'Behavior_datas';
                }

                $result[$key] = $this->collBehavior_datas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collGeneral_datas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'general_datas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'general_datas';
                        break;
                    default:
                        $key = 'General_datas';
                }

                $result[$key] = $this->collGeneral_datas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\model\model\Cow
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CowTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\model\model\Cow
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCowid($value);
                break;
            case 1:
                $this->setFarmid($value);
                break;
            case 2:
                $this->setHwid1($value);
                break;
            case 3:
                $this->setHwid2($value);
                break;
            case 4:
                $this->setName($value);
                break;
            case 5:
                $this->setBirthdate($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CowTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCowid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setFarmid($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setHwid1($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setHwid2($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setName($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBirthdate($arr[$keys[5]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\model\model\Cow The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CowTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CowTableMap::COL_COWID)) {
            $criteria->add(CowTableMap::COL_COWID, $this->cowid);
        }
        if ($this->isColumnModified(CowTableMap::COL_FARMID)) {
            $criteria->add(CowTableMap::COL_FARMID, $this->farmid);
        }
        if ($this->isColumnModified(CowTableMap::COL_HWID1)) {
            $criteria->add(CowTableMap::COL_HWID1, $this->hwid1);
        }
        if ($this->isColumnModified(CowTableMap::COL_HWID2)) {
            $criteria->add(CowTableMap::COL_HWID2, $this->hwid2);
        }
        if ($this->isColumnModified(CowTableMap::COL_NAME)) {
            $criteria->add(CowTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(CowTableMap::COL_BIRTHDATE)) {
            $criteria->add(CowTableMap::COL_BIRTHDATE, $this->birthdate);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildCowQuery::create();
        $criteria->add(CowTableMap::COL_COWID, $this->cowid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getCowid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getCowid();
    }

    /**
     * Generic method to set the primary key (cowid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCowid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCowid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \model\model\Cow (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFarmid($this->getFarmid());
        $copyObj->setHwid1($this->getHwid1());
        $copyObj->setHwid2($this->getHwid2());
        $copyObj->setName($this->getName());
        $copyObj->setBirthdate($this->getBirthdate());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBehavior_datas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBehavior_data($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getGeneral_datas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGeneral_data($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCowid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \model\model\Cow Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildFarm object.
     *
     * @param  ChildFarm $v
     * @return $this|\model\model\Cow The current object (for fluent API support)
     * @throws PropelException
     */
    public function setFarm(ChildFarm $v = null)
    {
        if ($v === null) {
            $this->setFarmid(NULL);
        } else {
            $this->setFarmid($v->getFarmid());
        }

        $this->aFarm = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildFarm object, it will not be re-added.
        if ($v !== null) {
            $v->addCow($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildFarm object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildFarm The associated ChildFarm object.
     * @throws PropelException
     */
    public function getFarm(ConnectionInterface $con = null)
    {
        if ($this->aFarm === null && ($this->farmid != 0)) {
            $this->aFarm = ChildFarmQuery::create()->findPk($this->farmid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aFarm->addCows($this);
             */
        }

        return $this->aFarm;
    }

    /**
     * Declares an association between this object and a ChildHardware object.
     *
     * @param  ChildHardware $v
     * @return $this|\model\model\Cow The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHardwareRelatedByHwid1(ChildHardware $v = null)
    {
        if ($v === null) {
            $this->setHwid1(NULL);
        } else {
            $this->setHwid1($v->getHwid());
        }

        $this->aHardwareRelatedByHwid1 = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHardware object, it will not be re-added.
        if ($v !== null) {
            $v->addCowRelatedByHwid1($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHardware object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHardware The associated ChildHardware object.
     * @throws PropelException
     */
    public function getHardwareRelatedByHwid1(ConnectionInterface $con = null)
    {
        if ($this->aHardwareRelatedByHwid1 === null && ($this->hwid1 != 0)) {
            $this->aHardwareRelatedByHwid1 = ChildHardwareQuery::create()->findPk($this->hwid1, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHardwareRelatedByHwid1->addCowsRelatedByHwid1($this);
             */
        }

        return $this->aHardwareRelatedByHwid1;
    }

    /**
     * Declares an association between this object and a ChildHardware object.
     *
     * @param  ChildHardware $v
     * @return $this|\model\model\Cow The current object (for fluent API support)
     * @throws PropelException
     */
    public function setHardwareRelatedByHwid2(ChildHardware $v = null)
    {
        if ($v === null) {
            $this->setHwid2(NULL);
        } else {
            $this->setHwid2($v->getHwid());
        }

        $this->aHardwareRelatedByHwid2 = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildHardware object, it will not be re-added.
        if ($v !== null) {
            $v->addCowRelatedByHwid2($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildHardware object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildHardware The associated ChildHardware object.
     * @throws PropelException
     */
    public function getHardwareRelatedByHwid2(ConnectionInterface $con = null)
    {
        if ($this->aHardwareRelatedByHwid2 === null && ($this->hwid2 != 0)) {
            $this->aHardwareRelatedByHwid2 = ChildHardwareQuery::create()->findPk($this->hwid2, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aHardwareRelatedByHwid2->addCowsRelatedByHwid2($this);
             */
        }

        return $this->aHardwareRelatedByHwid2;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Behavior_data' == $relationName) {
            $this->initBehavior_datas();
            return;
        }
        if ('General_data' == $relationName) {
            $this->initGeneral_datas();
            return;
        }
    }

    /**
     * Clears out the collBehavior_datas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBehavior_datas()
     */
    public function clearBehavior_datas()
    {
        $this->collBehavior_datas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBehavior_datas collection loaded partially.
     */
    public function resetPartialBehavior_datas($v = true)
    {
        $this->collBehavior_datasPartial = $v;
    }

    /**
     * Initializes the collBehavior_datas collection.
     *
     * By default this just sets the collBehavior_datas collection to an empty array (like clearcollBehavior_datas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBehavior_datas($overrideExisting = true)
    {
        if (null !== $this->collBehavior_datas && !$overrideExisting) {
            return;
        }

        $collectionClassName = Behavior_dataTableMap::getTableMap()->getCollectionClassName();

        $this->collBehavior_datas = new $collectionClassName;
        $this->collBehavior_datas->setModel('\model\model\Behavior_data');
    }

    /**
     * Gets an array of ChildBehavior_data objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCow is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBehavior_data[] List of ChildBehavior_data objects
     * @throws PropelException
     */
    public function getBehavior_datas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBehavior_datasPartial && !$this->isNew();
        if (null === $this->collBehavior_datas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBehavior_datas) {
                // return empty collection
                $this->initBehavior_datas();
            } else {
                $collBehavior_datas = ChildBehavior_dataQuery::create(null, $criteria)
                    ->filterByCow($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBehavior_datasPartial && count($collBehavior_datas)) {
                        $this->initBehavior_datas(false);

                        foreach ($collBehavior_datas as $obj) {
                            if (false == $this->collBehavior_datas->contains($obj)) {
                                $this->collBehavior_datas->append($obj);
                            }
                        }

                        $this->collBehavior_datasPartial = true;
                    }

                    return $collBehavior_datas;
                }

                if ($partial && $this->collBehavior_datas) {
                    foreach ($this->collBehavior_datas as $obj) {
                        if ($obj->isNew()) {
                            $collBehavior_datas[] = $obj;
                        }
                    }
                }

                $this->collBehavior_datas = $collBehavior_datas;
                $this->collBehavior_datasPartial = false;
            }
        }

        return $this->collBehavior_datas;
    }

    /**
     * Sets a collection of ChildBehavior_data objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $behavior_datas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCow The current object (for fluent API support)
     */
    public function setBehavior_datas(Collection $behavior_datas, ConnectionInterface $con = null)
    {
        /** @var ChildBehavior_data[] $behavior_datasToDelete */
        $behavior_datasToDelete = $this->getBehavior_datas(new Criteria(), $con)->diff($behavior_datas);


        $this->behavior_datasScheduledForDeletion = $behavior_datasToDelete;

        foreach ($behavior_datasToDelete as $behavior_dataRemoved) {
            $behavior_dataRemoved->setCow(null);
        }

        $this->collBehavior_datas = null;
        foreach ($behavior_datas as $behavior_data) {
            $this->addBehavior_data($behavior_data);
        }

        $this->collBehavior_datas = $behavior_datas;
        $this->collBehavior_datasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Behavior_data objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Behavior_data objects.
     * @throws PropelException
     */
    public function countBehavior_datas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBehavior_datasPartial && !$this->isNew();
        if (null === $this->collBehavior_datas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBehavior_datas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBehavior_datas());
            }

            $query = ChildBehavior_dataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCow($this)
                ->count($con);
        }

        return count($this->collBehavior_datas);
    }

    /**
     * Method called to associate a ChildBehavior_data object to this object
     * through the ChildBehavior_data foreign key attribute.
     *
     * @param  ChildBehavior_data $l ChildBehavior_data
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function addBehavior_data(ChildBehavior_data $l)
    {
        if ($this->collBehavior_datas === null) {
            $this->initBehavior_datas();
            $this->collBehavior_datasPartial = true;
        }

        if (!$this->collBehavior_datas->contains($l)) {
            $this->doAddBehavior_data($l);

            if ($this->behavior_datasScheduledForDeletion and $this->behavior_datasScheduledForDeletion->contains($l)) {
                $this->behavior_datasScheduledForDeletion->remove($this->behavior_datasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBehavior_data $behavior_data The ChildBehavior_data object to add.
     */
    protected function doAddBehavior_data(ChildBehavior_data $behavior_data)
    {
        $this->collBehavior_datas[]= $behavior_data;
        $behavior_data->setCow($this);
    }

    /**
     * @param  ChildBehavior_data $behavior_data The ChildBehavior_data object to remove.
     * @return $this|ChildCow The current object (for fluent API support)
     */
    public function removeBehavior_data(ChildBehavior_data $behavior_data)
    {
        if ($this->getBehavior_datas()->contains($behavior_data)) {
            $pos = $this->collBehavior_datas->search($behavior_data);
            $this->collBehavior_datas->remove($pos);
            if (null === $this->behavior_datasScheduledForDeletion) {
                $this->behavior_datasScheduledForDeletion = clone $this->collBehavior_datas;
                $this->behavior_datasScheduledForDeletion->clear();
            }
            $this->behavior_datasScheduledForDeletion[]= clone $behavior_data;
            $behavior_data->setCow(null);
        }

        return $this;
    }

    /**
     * Clears out the collGeneral_datas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addGeneral_datas()
     */
    public function clearGeneral_datas()
    {
        $this->collGeneral_datas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collGeneral_datas collection loaded partially.
     */
    public function resetPartialGeneral_datas($v = true)
    {
        $this->collGeneral_datasPartial = $v;
    }

    /**
     * Initializes the collGeneral_datas collection.
     *
     * By default this just sets the collGeneral_datas collection to an empty array (like clearcollGeneral_datas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGeneral_datas($overrideExisting = true)
    {
        if (null !== $this->collGeneral_datas && !$overrideExisting) {
            return;
        }

        $collectionClassName = General_dataTableMap::getTableMap()->getCollectionClassName();

        $this->collGeneral_datas = new $collectionClassName;
        $this->collGeneral_datas->setModel('\model\model\General_data');
    }

    /**
     * Gets an array of ChildGeneral_data objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCow is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildGeneral_data[] List of ChildGeneral_data objects
     * @throws PropelException
     */
    public function getGeneral_datas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collGeneral_datasPartial && !$this->isNew();
        if (null === $this->collGeneral_datas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGeneral_datas) {
                // return empty collection
                $this->initGeneral_datas();
            } else {
                $collGeneral_datas = ChildGeneral_dataQuery::create(null, $criteria)
                    ->filterByCow($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collGeneral_datasPartial && count($collGeneral_datas)) {
                        $this->initGeneral_datas(false);

                        foreach ($collGeneral_datas as $obj) {
                            if (false == $this->collGeneral_datas->contains($obj)) {
                                $this->collGeneral_datas->append($obj);
                            }
                        }

                        $this->collGeneral_datasPartial = true;
                    }

                    return $collGeneral_datas;
                }

                if ($partial && $this->collGeneral_datas) {
                    foreach ($this->collGeneral_datas as $obj) {
                        if ($obj->isNew()) {
                            $collGeneral_datas[] = $obj;
                        }
                    }
                }

                $this->collGeneral_datas = $collGeneral_datas;
                $this->collGeneral_datasPartial = false;
            }
        }

        return $this->collGeneral_datas;
    }

    /**
     * Sets a collection of ChildGeneral_data objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $general_datas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCow The current object (for fluent API support)
     */
    public function setGeneral_datas(Collection $general_datas, ConnectionInterface $con = null)
    {
        /** @var ChildGeneral_data[] $general_datasToDelete */
        $general_datasToDelete = $this->getGeneral_datas(new Criteria(), $con)->diff($general_datas);


        $this->general_datasScheduledForDeletion = $general_datasToDelete;

        foreach ($general_datasToDelete as $general_dataRemoved) {
            $general_dataRemoved->setCow(null);
        }

        $this->collGeneral_datas = null;
        foreach ($general_datas as $general_data) {
            $this->addGeneral_data($general_data);
        }

        $this->collGeneral_datas = $general_datas;
        $this->collGeneral_datasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related General_data objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related General_data objects.
     * @throws PropelException
     */
    public function countGeneral_datas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collGeneral_datasPartial && !$this->isNew();
        if (null === $this->collGeneral_datas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGeneral_datas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getGeneral_datas());
            }

            $query = ChildGeneral_dataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCow($this)
                ->count($con);
        }

        return count($this->collGeneral_datas);
    }

    /**
     * Method called to associate a ChildGeneral_data object to this object
     * through the ChildGeneral_data foreign key attribute.
     *
     * @param  ChildGeneral_data $l ChildGeneral_data
     * @return $this|\model\model\Cow The current object (for fluent API support)
     */
    public function addGeneral_data(ChildGeneral_data $l)
    {
        if ($this->collGeneral_datas === null) {
            $this->initGeneral_datas();
            $this->collGeneral_datasPartial = true;
        }

        if (!$this->collGeneral_datas->contains($l)) {
            $this->doAddGeneral_data($l);

            if ($this->general_datasScheduledForDeletion and $this->general_datasScheduledForDeletion->contains($l)) {
                $this->general_datasScheduledForDeletion->remove($this->general_datasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildGeneral_data $general_data The ChildGeneral_data object to add.
     */
    protected function doAddGeneral_data(ChildGeneral_data $general_data)
    {
        $this->collGeneral_datas[]= $general_data;
        $general_data->setCow($this);
    }

    /**
     * @param  ChildGeneral_data $general_data The ChildGeneral_data object to remove.
     * @return $this|ChildCow The current object (for fluent API support)
     */
    public function removeGeneral_data(ChildGeneral_data $general_data)
    {
        if ($this->getGeneral_datas()->contains($general_data)) {
            $pos = $this->collGeneral_datas->search($general_data);
            $this->collGeneral_datas->remove($pos);
            if (null === $this->general_datasScheduledForDeletion) {
                $this->general_datasScheduledForDeletion = clone $this->collGeneral_datas;
                $this->general_datasScheduledForDeletion->clear();
            }
            $this->general_datasScheduledForDeletion[]= clone $general_data;
            $general_data->setCow(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aFarm) {
            $this->aFarm->removeCow($this);
        }
        if (null !== $this->aHardwareRelatedByHwid1) {
            $this->aHardwareRelatedByHwid1->removeCowRelatedByHwid1($this);
        }
        if (null !== $this->aHardwareRelatedByHwid2) {
            $this->aHardwareRelatedByHwid2->removeCowRelatedByHwid2($this);
        }
        $this->cowid = null;
        $this->farmid = null;
        $this->hwid1 = null;
        $this->hwid2 = null;
        $this->name = null;
        $this->birthdate = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collBehavior_datas) {
                foreach ($this->collBehavior_datas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collGeneral_datas) {
                foreach ($this->collGeneral_datas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBehavior_datas = null;
        $this->collGeneral_datas = null;
        $this->aFarm = null;
        $this->aHardwareRelatedByHwid1 = null;
        $this->aHardwareRelatedByHwid2 = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CowTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
