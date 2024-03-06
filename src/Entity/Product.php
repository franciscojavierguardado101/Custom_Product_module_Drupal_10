<?php

namespace Drupal\my_product\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\commerce_price\Price;
use Drupal\image\Entity\Image;

/**
 * Defines the Product entity.
 *
 * @ingroup product
 */
class Product extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityInterface $entity, $clone) {
    parent::preCreate($entity, $clone);
    $entity->setNewRevision();
  }

  /**
   * {@inheritdoc}
   */
  public function getBaseFieldDefinitions() {
    $fields = parent::getBaseFieldDefinitions();

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Product Name'))
      ->setRequired(TRUE);

    $fields['field_description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'));

    $fields['field_price'] = BaseFieldDefinition::create('commerce_price')
      ->setLabel(t('Price'))
      ->setRequired(TRUE);

    $fields['field_images'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Images'))
      ->setSetting('target_type', 'image')
      ->setSetting('style', 'medium')
      ->setCardinality(FieldInterface::CARDINALITY_UNLIMITED);

    return $fields;
  }

  /**
   * Gets the product price as a formatted string.
   *
   * @return string
   *   The formatted price string.
   */
  public function getFormattedPrice() {
    $price = $this->get('field_price')->value;
    return Price::create($price['amount'], $price['currency_code'])->format();
  }

  /**
   * {@inheritdoc}
   */
  public function getEntityType() {
    return $this->entityType;
  }

  /**
   * {@inheritdoc}
   */
  public static function entityTypeLabel() {
    return t('Product');
  }
}
