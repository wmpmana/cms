<?php
namespace craft\gql\resolvers\elements;

use craft\elements\Asset as AssetElement;
use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class Asset
 */
class Asset extends BaseElement
{
    /**
     * @inheritdoc
     */
    public static function resolve($source, array $arguments, $context, ResolveInfo $resolveInfo)
    {
        // If this is the begining of a resolver chain, start fresh
        if ($source === null) {
            $query = AssetElement::find();
        // If not, get the prepared element query
        } else {
            $fieldName = $resolveInfo->fieldName;
            $query = $source->$fieldName;
        }

        $arguments = self::prepareArguments($arguments);

        foreach ($arguments as $key => $value) {
            $query->$key($value);
        }

        return $query->all();
    }

    /**
     * @inheritdoc
     */
    public static function getArrayableArguments(): array
    {
        return array_merge(parent::getArrayableArguments(), [
            'volumeId',
            'folderId',
            'kind',
            'filename',
        ]);
    }
}
