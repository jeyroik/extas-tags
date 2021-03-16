<?php
namespace extas\components\tags;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\tags\IHasTags;
use extas\interfaces\tags\ITag;
use extas\interfaces\tags\ITagMap;

/**
 * Trait THasTags
 *
 * @method IRepository tagMaps()
 * @method IRepository tags()
 *
 * @method string getTagTargetId()
 * @method string getTagTargetCategory()
 *
 * @package extas\components\tags
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasTags
{
    /**
     * @return array
     */
    public function getTags(): array
    {
        $maps = $this->tagMaps()->all([
            ITagMap::TARGET_ID => $this->getTagTargetId(),
            ITagMap::TARGET_CATEGORY => $this->getTagTargetCategory()
        ]);

        $tagsIds = array_column($maps, ITagMap::FIELD__TAG);

        return $this->tags()->all([ITag::FIELD__ALIASES => $tagsIds]);
    }

    /**
     * @param string $tag
     * @return $this
     * @throws MissedOrUnknown
     */
    public function addTag(string $tag)
    {
        $tagObject = $this->tags()->one([ITag::FIELD__ALIASES => $tag]);

        if (!$tagObject) {
            throw new MissedOrUnknown('tag "' . $tag . '"');
        }

        $this->tagMaps()->create(new TagMap([
            TagMap::FIELD__TAG => $tag,
            TagMap::TARGET_ID => $this->getTagTargetId(),
            TagMap::TARGET_CATEGORY => $this->getTagTargetCategory()
        ]));

        return $this;
    }
}
