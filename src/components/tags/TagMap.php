<?php
namespace extas\components\tags;

use extas\components\Item;
use extas\components\THasCreatedAt;
use extas\interfaces\tags\ITagMap;

/**
 * Class TagMap
 *
 * @package extas\components\tags
 * @author jeyroik <jeyroik@gmail.com>
 */
class TagMap extends Item implements ITagMap
{
    use THasTag;
    use THasCreatedAt;

    /**
     * @return string
     */
    public function getTargetId(): string
    {
        return $this->config[static::TARGET_ID] ?? '';
    }

    /**
     * @return string
     */
    public function getTargetCategory(): string
    {
        return $this->config[static::TARGET_CATEGORY] ?? '';
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setTargetId(string $id): ITagMap
    {
        $this->config[static::TARGET_ID] = $id;

        return $this;
    }

    /**
     * @param string $category
     * @return $this
     */
    public function setTargetCategory(string $category): ITagMap
    {
        $this->config[static::TARGET_CATEGORY] = $category;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
