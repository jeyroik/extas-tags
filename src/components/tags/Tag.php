<?php
namespace extas\components\tags;

use extas\components\Item;
use extas\components\THasAliases;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\tags\ITag;

/**
 * Class Tag
 *
 * @package extas\components\tags
 * @author jeyroik <jeyroik@gmail.com>
 */
class Tag extends Item implements ITag
{
    use THasName {
        THasName::setName as nativeSetName;
    }
    use THasDescription;
    use THasAliases;

    /**
     * @param string $name
     * @return $this|Tag
     */
    public function setName(string $name)
    {
        $this->nativeSetName($name);
        $this->addAlias($name);

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
