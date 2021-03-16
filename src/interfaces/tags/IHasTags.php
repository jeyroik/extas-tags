<?php
namespace extas\interfaces\tags;

use extas\components\exceptions\MissedOrUnknown;

/**
 * Interface IHasTags
 *
 * @package extas\interfaces\tags
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasTags
{
    /**
     * @param string $tag
     * @return $this
     * @throws MissedOrUnknown
     */
    public function addTag(string $tag);

    /**
     * @return ITag[]
     */
    public function getTags(): array;

    /**
     * @return string
     */
    public function getTagTargetId(): string;

    /**
     * @return string
     */
    public function getTagTargetCategory(): string;
}
