<?php declare(strict_types = 1);
abstract class Enum
{
    /** @var string */
    protected $value;
    /** @var Collection[] Always use values() to access. */
    private static $constants = [];
    /** @var Collection[] Always use all() to access. */
    private static $objects = [];

    public function __construct($value)
    {
        $value = $value instanceof static ? $value->getValue() : $value;

        $this->validate($value);

        $this->value = $value;
    }

    /**
     * Validate the value on construction. This method can be overridden.
     */
    protected function validate($value) : void
    {
        if ( ! self::values()->contains($value)) {
            throw InvalidEnumValue::forConstructor(__CLASS__, $value);
        }
    }

    public static function contains($value) : bool
    {
        return self::values()->contains($value);
    }

    /**
     * @return Collection|static[] $objects
     */
    public static function all() : Collection
    {
        if (empty(self::$objects[static::class])) {
            $collection = static::values()->mapInto(static::class);

            // If available put in specific EnumCollection class
            $collectionClass = static::class . 'Collection';
            if (class_exists($collectionClass)) {
                $collection = new $collectionClass($collection);
            }

            self::$objects[static::class] = $collection;
        }

        return self::$objects[static::class];
    }

    /**
     * @return Collection|string[] $constants
     */
    public static function values() : Collection
    {
        // We cache the results because reflection is expensive. We have to store per class, because otherwise
        // the first implementation of Enum will determine the constants for all Enum implementations.
        if (empty(self::$constants[static::class])) {
            self::$constants[static::class] = collect((new \ReflectionClass(static::class))->getConstants())->values();
        }

        return self::$constants[static::class];
    }

    public function getValue() : ?string
    {
        return $this->value;
    }

    public function toString() : string
    {
        return (string) $this->value;
    }

    /**
     * Magic method to check if the implementation is of a certain value: $status->isDraft()
     *
     * You have to method hint your Enum implementation in the class docblock: `@method bool isCompleted`.
     *
     * @return bool
     */
    public function __call($name, $params)
    {
        $const = strtoupper(substr(snake_case($name), 3));

        return $this->value == constant('static::' . $const);
    }

    /**
     * Magic constructor to create a new instance with the constant as method name: $status = Status::DRAFT();
     *
     * @noinspection PhpUndefinedClassInspection
     * You have to method hint your Enum implementation in the class docblock: `@method static YourClass COMPLETED()`.
     *
     * @return static
     */
    public static function __callStatic($name, $params)
    {
        if ( ! defined('static::' . $name)) {
            throw InvalidEnumValue::forMagicConstructor(__CLASS__, $name);
        }

        return new static(constant('static::' . $name));
    }
}
