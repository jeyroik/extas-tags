<?php
namespace extas\interfaces\tags;

use extas\interfaces\IHasCreatedAt;
use extas\interfaces\IItem;

/**
 * Interface ITagMap
 *
 * @package extas\interfaces\tags
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITagMap extends IItem, IHasTag, IHasCreatedAt
{
    public const SUBJECT = 'extas.tag.map';

    public const TARGET_ID = 'target_id';
    public const TARGET_CATEGORY = 'target_category';

    /**
     * @return string
     */
    public function getTargetId(): string;

    /**
     * @return string
     */
    public function getTargetCategory(): string;

    /**
     * @param string $id
     * @return $this
     */
    public function setTargetId(string $id): ITagMap;

    /**
     * @param string $category
     * @return $this
     */
    public function setTargetCategory(string $category): ITagMap;
}
