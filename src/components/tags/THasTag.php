<?php
namespace extas\components\tags;

use extas\interfaces\tags\IHasTag;

/**
 * Trait THasTag
 *
 * @property $config
 *
 * @package extas\components\tags
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasTag
{
    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->config[IHasTag::FIELD__TAG] ?? '';
    }

    /**
     * @param string $tag
     * @return $this
     */
    public function setTag(string $tag)
    {
        $this->config[IHasTag::FIELD__TAG] = $tag;

        return $this;
    }
}
