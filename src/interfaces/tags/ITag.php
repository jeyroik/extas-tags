<?php
namespace extas\interfaces\tags;

use extas\interfaces\IHasAliases;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;

/**
 * Interface ITag
 *
 * @package extas\interfaces\tags
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITag extends IItem, IHasDescription, IHasName, IHasAliases
{
    public const SUBJECT = 'extas.tag';
}
