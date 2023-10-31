<?php

namespace Illuminate\Tests\Integration\Database\MySql;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsEnumArrayObject;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;

class EloquentJsonCastTest extends MySqlTestCase
{
    protected $driver = 'mysql';

    protected function defineDatabaseMigrationsAfterDatabaseRefreshed()
    {
        Schema::create('test_json_cast', function ($table) {
            $table->id();
            $table->json('json');
        });
    }

    protected function destroyDatabaseMigrations()
    {
        Schema::drop('test_json_cast');
    }

    /**
     * Test if attribute with "array" cast is casted as "array"
     */
    public function testAttributeWithArrayCastIsCastedAsArray(): void
    {
        $model = TestModelWithArrayCast::create();
        $this->assertIsArray($model->json);
    }

    /**
     * Test if a not modified attribute with "array" cast is clean
     */
    public function testNotModifiedAttributeWithArrayCastIsClean(): void
    {
        $model = TestModelWithArrayCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with "array" cast is clean
     */
    public function testModifiedButEqualAttributeWithArrayCastIsClean(): void
    {
        $model = TestModelWithArrayCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "array" cast is dirty
     */
    public function testModifiedAttributeWithArrayCastIsDirty(): void
    {
        $model = TestModelWithArrayCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "json" cast is casted as "array"
     */
    public function testAttributeWithJsonCastIsCastedAsArray(): void
    {
        $model = TestModelWithJsonCast::create();
        $this->assertIsArray($model->json);
    }

    /**
     * Test if a not modified attribute with "json" cast is clean
     */
    public function testNotModifiedAttributeWithJsonCastIsClean(): void
    {
        $model = TestModelWithJsonCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with "json" cast is clean
     */
    public function testModifiedButEqualAttributeWithJsonCastIsClean(): void
    {
        $model = TestModelWithJsonCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "json" cast is dirty
     */
    public function testModifiedAttributeWithJsonCastIsDirty(): void
    {
        $model = TestModelWithJsonCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "collection" cast is casted as "collection"
     */
    public function testAttributeWithCollectionCastIsCastedAsCollection(): void
    {
        $model = TestModelWithCollectionCast::create();
        $this->assertInstanceOf(Collection::class, $model->json);
    }

    /**
     * Test if a not modified attribute with "collection" cast is clean
     */
    public function testNotModifiedAttributeWithCollectionCastIsClean(): void
    {
        $model = TestModelWithCollectionCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with "collection" cast is clean
     */
    public function testModifiedButEqualAttributeWithCollectionCastIsClean(): void
    {
        $model = TestModelWithCollectionCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "collection" cast is dirty
     */
    public function testModifiedAttributeWithCollectionCastIsDirty(): void
    {
        $model = TestModelWithCollectionCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "object" cast is casted as "object"
     */
    public function testAttributeWithObjectCastIsCastedAsObject(): void
    {
        $model = TestModelWithObjectCast::create();
        $this->assertInstanceOf(\stdClass::class, $model->json);
    }

    /**
     * Test if a not modified attribute with "object" cast is clean
     */
    public function testNotModifiedAttributeWithObjectCastIsClean(): void
    {
        $model = TestModelWithObjectCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with "object" cast is clean
     */
    public function testModifiedButEqualAttributeWithObjectCastIsClean(): void
    {
        $model = TestModelWithObjectCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "object" cast is dirty
     */
    public function testModifiedAttributeWithObjectCastIsDirty(): void
    {
        $model = TestModelWithObjectCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "AsArrayObject::class" cast is casted as "ArrayObject::class"
     */
    public function testAttributeWithAsArrayObjectCastIsCastedAsObject(): void
    {
        $model = TestModelWithAsArrayObjectCast::create();
        $this->assertInstanceOf(ArrayObject::class, $model->json);
    }

    /**
     * Test if a not modified attribute with "AsArrayObject::class" cast is clean
     */
    public function testNotModifiedAttributeWithAsArrayObjectCastIsClean(): void
    {
        $model = TestModelWithAsArrayObjectCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with "AsArrayObject::class" cast is clean
     */
    public function testModifiedButEqualAttributeWithAsArrayObjectCastIsClean(): void
    {
        $model = TestModelWithAsArrayObjectCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "AsArrayObject::class" cast is dirty
     */
    public function testModifiedAttributeWithAsArrayObjectCastIsDirty(): void
    {
        $model = TestModelWithAsArrayObjectCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "AsCollection::class" cast is casted as "Collection::class"
     */
    public function testAttributeWithAsCollectionCastIsCastedAsObject(): void
    {
        $model = TestModelWithAsCollectionCast::create();
        $this->assertInstanceOf(Collection::class, $model->json);
    }

    /**
     * Test if a not modified attribute with "AsCollection::class" cast is clean
     */
    public function testNotModifiedAttributeWithAsCollectionCastIsClean(): void
    {
        $model = TestModelWithAsCollectionCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with "AsCollection::class" cast is clean
     */
    public function testModifiedButEqualAttributeWithAsCollectionCastIsClean(): void
    {
        $model = TestModelWithAsCollectionCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "AsCollection::class" cast is dirty
     */
    public function testModifiedAttributeWithAsCollectionCastIsDirty(): void
    {
        $model = TestModelWithAsCollectionCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "AsCustomJson::class" cast is casted as array
     */
    public function testAttributeWithCustomJsonCastIsCastedAsArray(): void
    {
        $model = TestModelWithCustomJsonCast::create();
        $this->assertIsArray($model->json);
    }

    /**
     * Test if a not modified attribute with "AsCustomJson::class" cast is clean
     */
    public function testNotModifiedAttributeWithCustomJsonCastIsClean(): void
    {
        $model = TestModelWithCustomJsonCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with "AsCustomJson::class" cast is clean
     */
    public function testModifiedButEqualAttributeWithCustomJsonCastIsClean(): void
    {
        $model = TestModelWithCustomJsonCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "AsCustomJson::class" cast is dirty
     */
    public function testModifiedAttributeWithCustomJsonCastIsDirty(): void
    {
        $model = TestModelWithCustomJsonCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with accessor and mutator method is accessible as array
     */
    public function testAttributeWithAccessorAndMutatorMethodIsCastedAsArray(): void
    {
        $model = TestModelWithAccessorAndMutatorMethod::create();
        $this->assertIsArray($model->json);
    }

    /**
     * Test if a not modified attribute with accessor and mutator method is clean
     */
    public function testNotModifiedAttributeWithAccessorAndMutatorMethodIsClean(): void
    {
        $model = TestModelWithAccessorAndMutatorMethod::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with accessor and mutator method is clean
     */
    public function testModifiedButEqualAttributeWithAccessorAndMutatorMethodIsClean(): void
    {
        $model = TestModelWithAccessorAndMutatorMethod::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with accessor and mutator method is dirty
     */
    public function testModifiedAttributeWithAccessorAndMutatorMethodIsDirty(): void
    {
        $model = TestModelWithAccessorAndMutatorMethod::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with accessor and mutator cast is accessible as array
     */
    public function testAttributeWithAccessorAndMutatorCastIsCastedAsArray(): void
    {
        $model = TestModelWithAccessorAndMutatorCast::create();
        $this->assertIsArray($model->json);
    }

    /**
     * Test if a not modified attribute with accessor and mutator cast is clean
     */
    public function testNotModifiedAttributeWithAccessorAndMutatorCastIsClean(): void
    {
        $model = TestModelWithAccessorAndMutatorCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with accessor and mutator cast is clean
     */
    public function testModifiedButEqualAttributeWithAccessorAndMutatorCastIsClean(): void
    {
        $model = TestModelWithAccessorAndMutatorCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with accessor and mutator cast is dirty
     */
    public function testModifiedAttributeWithAccessorAndMutatorCastIsDirty(): void
    {
        $model = TestModelWithAccessorAndMutatorCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "TestModel::class" cast is "TestModel::class"
     */
    public function testAttributeWithModelCastIsCastedAsArray(): void
    {
        $model = TestModelWithModelCast::create();
        $this->assertInstanceOf(TestModelCastable::class, $model->json);
    }

    /**
     * Test if a not modified attribute with model cast is clean
     */
    public function testNotModifiedAttributeWithModelCastIsClean(): void
    {
        $model = TestModelWithModelCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified but equal attribute with model cast is clean
     */
    public function testModifiedButEqualAttributeWithModelCastIsClean(): void
    {
        $model = TestModelWithModelCast::modifiedButEqual();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with model cast is dirty
     */
    public function testModifiedAttributeWithModelCastIsDirty(): void
    {
        $model = TestModelWithModelCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "AsEnumArrayObject::class" cast is casted as "ArrayObject::class"
     * with "TestEnum::class" values
     */
    public function testAttributeWithAsEnumArrayObjectCastIsCastedAsArrayObject(): void
    {
        $model = TestModelWithAsEnumArrayObjectCast::create();
        $this->assertInstanceOf(ArrayObject::class, $model->json);
        collect($model->json)->every(fn($enum) => $this->assertInstanceOf(TestEnum::class, $enum));
    }

    /**
     * Test if a not modified attribute with "AsEnumArrayObject::class" cast is clean
     */
    public function testNotModifiedAttributeWithAsEnumArrayObjectCastIsClean(): void
    {
        $model = TestModelWithAsEnumArrayObjectCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "AsEnumArrayObject::class" cast is dirty
     */
    public function testModifiedAttributeWithAsEnumArrayObjectCastIsDirty(): void
    {
        $model = TestModelWithAsEnumArrayObjectCast::modified();
        $this->assertTrue($model->isDirty());
    }

    /**
     * Test if attribute with "AsEnumCollection::class" cast is casted as "Collection::class"
     * with "TestEnum::class" values
     */
    public function testAttributeWithAsEnumCollectionCastIsCastedAsEnumCollection(): void
    {
        $model = TestModelWithAsEnumCollectionCast::create();
        $this->assertInstanceOf(Collection::class, $model->json);
        $model->json->every(fn($enum) => $this->assertInstanceOf(TestEnum::class, $enum));
    }

    /**
     * Test if a not modified attribute with "AsEnumCollection::class" cast is clean
     */
    public function testNotModifiedAttributeWithAsEnumCollectionCastIsClean(): void
    {
        $model = TestModelWithAsEnumCollectionCast::notModified();
        $this->assertTrue($model->isClean());
    }

    /**
     * Test if a modified and not equal attribute with "AsEnumCollection::class" cast is dirty
     */
    public function testModifiedAttributeWithAsEnumCollectionCastIsDirty(): void
    {
        $model = TestModelWithAsEnumCollectionCast::modified();
        $this->assertTrue($model->isDirty());
    }

}

abstract class TestModel extends Model
{

    protected $table = 'test_json_cast';

    public $timestamps = false;

    protected $guarded = [];

    static public function booted()
    {
        static::creating(
            fn($model) => $model->json = [
                'name' => fake()->name(),
                'description' => fake()->sentence(10, true),
                'tags' => fake()->words(3),
            ]
        );
    }

    public function getAttributeAsArray(): array
    {
        return $this->getAttribute('json');
    }

    public function setAttributeFromArray(array $array): void
    {
        $this->setAttribute('json', $array);
    }

    static public function notModified(): TestModel
    {
        $model = static::create();
        $attribute = $model->getAttributeAsArray();

        $model->setAttributeFromArray($attribute);
        return $model;
    }

    static public function modifiedButEqual(): TestModel
    {
        $model = static::create();
        $attribute = $model->getAttributeAsArray();

        $name = $attribute['name'];
        unset($attribute['name']);
        $attribute['name'] = $name;

        $key = key($attribute['tags']);
        $value = current($attribute['tags']);
        unset($attribute['tags'][$key]);
        $attribute['tags'][$key] = $value;

        $model->setAttributeFromArray($attribute);
        return $model;
    }

    static public function modified(): TestModel
    {
        $model = static::create();
        $attribute = $model->getAttributeAsArray();

        $attribute['tags'][0] = $attribute['tags'][0] . ' (changed)';

        $model->setAttributeFromArray($attribute);
        return $model;
    }
}

class TestModelWithArrayCast extends TestModel
{
    protected $casts = ['json' => 'array'];
}

class TestModelWithJsonCast extends TestModel
{
    protected $casts = ['json' => 'json'];
}

class TestModelWithCollectionCast extends TestModel
{
    protected $casts = ['json' => 'collection'];

    public function getAttributeAsArray(): array
    {
        return $this->getAttribute('json')->all();
    }

    public function setAttributeFromArray(array $array): void
    {
        $this->setAttribute('json', collect($array));
    }
}

class TestModelWithObjectCast extends TestModel
{
    protected $casts = ['json' => 'object'];

    public function getAttributeAsArray(): array
    {
        return get_object_vars($this->getAttribute('json'));
    }

    public function setAttributeFromArray(array $array): void
    {
        $this->setAttribute('json', json_decode(json_encode($array)));
    }

}

class TestModelWithAsArrayObjectCast extends TestModel
{
    protected $casts = ['json' => AsArrayObject::class];

    public function getAttributeAsArray(): array
    {
        return $this->getAttribute('json')->toArray();
    }

    public function setAttributeFromArray(array $array): void
    {
        $this->setAttribute('json', new ArrayObject($array));
    }
}

class TestModelWithAsCollectionCast extends TestModelWithCollectionCast
{
    protected $casts = ['json' => AsCollection::class];
}

class TestModelWithCustomJsonCast extends TestModelWithJsonCast
{
    protected $casts = ['json' => CustomJsonCast::class];
}

abstract class TestModelWithEnumsCast extends TestModel
{
    static public function booted()
    {
        static::creating(fn($model) => $model->json = [
            TestEnum::TestEnumValueA,
            TestEnum::TestEnumValueB,
        ]);
    }

    static public function modified(): TestModel
    {
        $model = static::create();
        $attribute = $model->getAttributeAsArray();

        $attribute[] = TestEnum::TestEnumValueC;

        $model->setAttributeFromArray($attribute);
        return $model;
    }

}

class TestModelWithAsEnumArrayObjectCast extends TestModelWithEnumsCast
{
    protected $casts = ['json' => AsEnumArrayObject::class . ':' . TestEnum::class];

    public function getAttributeAsArray(): array
    {
        return $this->getAttribute('json')->toArray();
    }

    public function setAttributeFromArray(array $array): void
    {
        $this->setAttribute('json', new ArrayObject($array));
    }
}

class TestModelWithAsEnumCollectionCast extends TestModelWithEnumsCast
{
    protected $casts = ['json' => AsEnumCollection::class . ':' . TestEnum::class];

    public function getAttributeAsArray(): array
    {
        return $this->getAttribute('json')->toArray();
    }

    public function setAttributeFromArray(array $array): void
    {
        $this->setAttribute('json', collect($array));
    }
}

class TestModelWithAccessorAndMutatorMethod extends TestModel
{
    public function getJsonAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setJsonAttribute($value)
    {
        $this->attributes['json'] = json_encode($value);
    }
}

class TestModelWithAccessorAndMutatorCast extends TestModel
{
    protected function json(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => json_decode($value, true),
            set: fn(array $value) => json_encode($value),
        );
    }
}

class CustomJsonCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): array
    {
        return json_decode($value, true);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return json_encode($value);
    }
}

class TestModelWithModelCast extends TestModel
{
    protected $casts = ['json' => TestModelCastable::class];

    public function getAttributeAsArray(): array
    {
        return $this->getAttribute('json')->toArray();
    }

    public function setAttributeFromArray(array $array): void
    {
        $this->setAttribute('json', new TestModelCastable($array));
    }
}

class TestModelCastable implements Castable, Arrayable
{

    private $keys;
    protected $name;
    protected $description;
    protected $tags;

    public function __construct($attributes)
    {
        $this->keys = array_keys($attributes);
        $this->name = $attributes['name'];
        $this->description = $attributes['description'];
        $this->tags = $attributes['tags'];
    }

    public function toArray()
    {
        return collect($this->keys)->mapWithKeys(
            fn($key) => [$key => $this->{$key}]
        )->all();
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new class implements CastsAttributes {
            /**
             * Cast the given value.
             *
             * @param  array<string, mixed>  $attributes
             * @return TestModelCastable
             */
            public function get(Model $model, string $key, mixed $value, array $attributes): TestModelCastable
            {
                return new TestModelCastable(json_decode($value, true));
            }

            /**
             * Prepare the given value for storage.
             *
             * @param  array<string, mixed>  $attributes
             */
            public function set(Model $model, string $key, mixed $value, array $attributes): string
            {
                if ($value instanceof TestModelCastable) {
                    $value = $value->toArray();
                }
                return json_encode($value);
            }
        };
    }

}

enum TestEnum
{
    case TestEnumValueA;
    case TestEnumValueB;
    case TestEnumValueC;

}