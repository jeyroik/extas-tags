<?php
namespace extas\interfaces\tags;

/**
 * Interface IHasTag
 *
 * @package extas\interfaces
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasTag
{
    public const FIELD__TAG = 'tag';

    /**
     * @return string
     */
    public function getTag(): string;

    /**
     * @param string $tag
     * @return $this
     */
    public function setTag(string $tag);
}
