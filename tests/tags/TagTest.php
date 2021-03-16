<?php
namespace tests\tags;

use Dotenv\Dotenv;
use extas\components\Item;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\tags\Tag;
use extas\components\tags\TagMap;
use extas\components\tags\THasTags;
use extas\components\THasMagicClass;
use extas\components\THasName;
use extas\interfaces\tags\IHasTags;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['tags', 'name', Tag::class],
            ['tagMaps', 'name', TagMap::class]
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testBasicTag()
    {
        $tag = new Tag();
        $tag->setName('test');
        $this->assertEquals(['test'], $tag->getAliases());
    }

    public function testBasicTagMap()
    {
        $map = new TagMap();
        $map->setTag('test')->setTargetId('me')->setTargetCategory('test');
        $this->assertEquals('test', $map->getTag());
        $this->assertEquals('me', $map->getTargetId());
        $this->assertEquals('test', $map->getTargetCategory());
    }

    public function testHasTags()
    {
        $this->getMagicClass('tags')->create(new Tag([
            Tag::FIELD__NAME => 'test',
            Tag::FIELD__ALIASES => ['test', 'test me']
        ]));

        $this->getMagicClass('tagMaps')->create(new TagMap([
            TagMap::FIELD__TAG => 'test me',
            TagMap::TARGET_ID => 'test',
            TagMap::TARGET_CATEGORY => 'me'
        ]));

        $hasTags = new class extends Item implements IHasTags {
            use THasName;
            use THasTags;

            public function getTagTargetId(): string
            {
                return $this->getName();
            }

            public function getTagTargetCategory(): string
            {
                return $this->__subject();
            }

            protected function getSubjectForExtension(): string
            {
                return 'me';
            }
        };

        $hasTags->setName('test');
        $tags = $hasTags->getTags();
        $this->assertCount(1, $tags);

        $tag = array_shift($tags);
        $this->assertEquals('test', $tag->getName());

        $this->getMagicClass('tags')->create(new Tag([
            Tag::FIELD__NAME => 'another',
            Tag::FIELD__ALIASES => ['another']
        ]));

        $hasTags->addTag('another');
        $tags = $hasTags->getTags();
        $this->assertCount(2, $tags);

        $this->expectExceptionMessage('Missed or unknown tag "unknown"');
        $hasTags->addTag('unknown');
    }
}
