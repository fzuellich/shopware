<?php declare(strict_types=1);

namespace Shopware\SeoUrl\Gateway\Resource;

use Shopware\Framework\Write\Flag\Required;
use Shopware\Framework\Write\Field\FkField;
use Shopware\Framework\Write\Field\IntField;
use Shopware\Framework\Write\Field\ReferenceField;
use Shopware\Framework\Write\Field\StringField;
use Shopware\Framework\Write\Field\BoolField;
use Shopware\Framework\Write\Field\DateField;
use Shopware\Framework\Write\Field\SubresourceField;
use Shopware\Framework\Write\Field\LongTextField;
use Shopware\Framework\Write\Field\LongTextWithHtmlField;
use Shopware\Framework\Write\Field\FloatField;
use Shopware\Framework\Write\Field\TranslatedField;
use Shopware\Framework\Write\Field\UuidField;
use Shopware\Framework\Write\Resource;

class SeoUrlResource extends Resource
{
    protected const UUID_FIELD = 'uuid';
    protected const SEO_HASH_FIELD = 'seoHash';
    protected const SHOP_UUID_FIELD = 'shopUuid';
    protected const NAME_FIELD = 'name';
    protected const FOREIGN_KEY_FIELD = 'foreignKey';
    protected const PATH_INFO_FIELD = 'pathInfo';
    protected const SEO_PATH_INFO_FIELD = 'seoPathInfo';
    protected const IS_CANONICAL_FIELD = 'isCanonical';
    protected const CREATED_AT_FIELD = 'createdAt';

    public function __construct()
    {
        parent::__construct('seo_url');
        
        $this->primaryKeyFields[self::UUID_FIELD] = (new UuidField('uuid'))->setFlags(new Required());
        $this->fields[self::SEO_HASH_FIELD] = (new StringField('seo_hash'))->setFlags(new Required());
        $this->fields[self::SHOP_UUID_FIELD] = (new StringField('shop_uuid'))->setFlags(new Required());
        $this->fields[self::NAME_FIELD] = (new StringField('name'))->setFlags(new Required());
        $this->fields[self::FOREIGN_KEY_FIELD] = (new StringField('foreign_key'))->setFlags(new Required());
        $this->fields[self::PATH_INFO_FIELD] = (new LongTextField('path_info'))->setFlags(new Required());
        $this->fields[self::SEO_PATH_INFO_FIELD] = (new LongTextField('seo_path_info'))->setFlags(new Required());
        $this->fields[self::IS_CANONICAL_FIELD] = (new BoolField('is_canonical'))->setFlags(new Required());
        $this->fields[self::CREATED_AT_FIELD] = (new DateField('created_at'))->setFlags(new Required());
    }
    
    public function getWriteOrder(): array
    {
        return [
            \Shopware\SeoUrl\Gateway\Resource\SeoUrlResource::class
        ];
    }    
    
    public function getDefaults(string $type): array {
        if($type === self::FOR_UPDATE) {
            return [
                self::UPDATED_AT_FIELD => new \DateTime(),
            ];
        }

        if($type === self::FOR_INSERT) {
            return [
                self::UPDATED_AT_FIELD => new \DateTime(),
                self::CREATED_AT_FIELD => new \DateTime(),
            ];
        }

        throw new \InvalidArgumentException('Unable to generate default values, wrong type submitted');
    }
}