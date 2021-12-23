<?php
/**
 * Styles
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  HubSpot\Client\Cms\Blogs\BlogPosts
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Blog Post endpoints
 *
 * Use these endpoints for interacting with Blog Posts, Blog Authors, and Blog Tags
 *
 * The version of the OpenAPI document: v3
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace HubSpot\Client\Cms\Blogs\BlogPosts\Model;

use \ArrayAccess;
use \HubSpot\Client\Cms\Blogs\BlogPosts\ObjectSerializer;

/**
 * Styles Class Doc Comment
 *
 * @category Class
 * @package  HubSpot\Client\Cms\Blogs\BlogPosts
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Styles implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Styles';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'vertical_alignment' => 'string',
        'background_color' => '\HubSpot\Client\Cms\Blogs\BlogPosts\Model\RGBAColor',
        'background_image' => '\HubSpot\Client\Cms\Blogs\BlogPosts\Model\BackgroundImage',
        'background_gradient' => '\HubSpot\Client\Cms\Blogs\BlogPosts\Model\Gradient',
        'max_width_section_centering' => 'int',
        'force_full_width_section' => 'bool',
        'flexbox_positioning' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'vertical_alignment' => null,
        'background_color' => null,
        'background_image' => null,
        'background_gradient' => null,
        'max_width_section_centering' => 'int32',
        'force_full_width_section' => null,
        'flexbox_positioning' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'vertical_alignment' => 'verticalAlignment',
        'background_color' => 'backgroundColor',
        'background_image' => 'backgroundImage',
        'background_gradient' => 'backgroundGradient',
        'max_width_section_centering' => 'maxWidthSectionCentering',
        'force_full_width_section' => 'forceFullWidthSection',
        'flexbox_positioning' => 'flexboxPositioning'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'vertical_alignment' => 'setVerticalAlignment',
        'background_color' => 'setBackgroundColor',
        'background_image' => 'setBackgroundImage',
        'background_gradient' => 'setBackgroundGradient',
        'max_width_section_centering' => 'setMaxWidthSectionCentering',
        'force_full_width_section' => 'setForceFullWidthSection',
        'flexbox_positioning' => 'setFlexboxPositioning'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'vertical_alignment' => 'getVerticalAlignment',
        'background_color' => 'getBackgroundColor',
        'background_image' => 'getBackgroundImage',
        'background_gradient' => 'getBackgroundGradient',
        'max_width_section_centering' => 'getMaxWidthSectionCentering',
        'force_full_width_section' => 'getForceFullWidthSection',
        'flexbox_positioning' => 'getFlexboxPositioning'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const VERTICAL_ALIGNMENT_TOP = 'TOP';
    const VERTICAL_ALIGNMENT_MIDDLE = 'MIDDLE';
    const VERTICAL_ALIGNMENT_BOTTOM = 'BOTTOM';
    const FLEXBOX_POSITIONING_TOP_LEFT = 'TOP_LEFT';
    const FLEXBOX_POSITIONING_TOP_CENTER = 'TOP_CENTER';
    const FLEXBOX_POSITIONING_TOP_RIGHT = 'TOP_RIGHT';
    const FLEXBOX_POSITIONING_MIDDLE_LEFT = 'MIDDLE_LEFT';
    const FLEXBOX_POSITIONING_MIDDLE_CENTER = 'MIDDLE_CENTER';
    const FLEXBOX_POSITIONING_MIDDLE_RIGHT = 'MIDDLE_RIGHT';
    const FLEXBOX_POSITIONING_BOTTOM_LEFT = 'BOTTOM_LEFT';
    const FLEXBOX_POSITIONING_BOTTOM_CENTER = 'BOTTOM_CENTER';
    const FLEXBOX_POSITIONING_BOTTOM_RIGHT = 'BOTTOM_RIGHT';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVerticalAlignmentAllowableValues()
    {
        return [
            self::VERTICAL_ALIGNMENT_TOP,
            self::VERTICAL_ALIGNMENT_MIDDLE,
            self::VERTICAL_ALIGNMENT_BOTTOM,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getFlexboxPositioningAllowableValues()
    {
        return [
            self::FLEXBOX_POSITIONING_TOP_LEFT,
            self::FLEXBOX_POSITIONING_TOP_CENTER,
            self::FLEXBOX_POSITIONING_TOP_RIGHT,
            self::FLEXBOX_POSITIONING_MIDDLE_LEFT,
            self::FLEXBOX_POSITIONING_MIDDLE_CENTER,
            self::FLEXBOX_POSITIONING_MIDDLE_RIGHT,
            self::FLEXBOX_POSITIONING_BOTTOM_LEFT,
            self::FLEXBOX_POSITIONING_BOTTOM_CENTER,
            self::FLEXBOX_POSITIONING_BOTTOM_RIGHT,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['vertical_alignment'] = $data['vertical_alignment'] ?? null;
        $this->container['background_color'] = $data['background_color'] ?? null;
        $this->container['background_image'] = $data['background_image'] ?? null;
        $this->container['background_gradient'] = $data['background_gradient'] ?? null;
        $this->container['max_width_section_centering'] = $data['max_width_section_centering'] ?? null;
        $this->container['force_full_width_section'] = $data['force_full_width_section'] ?? null;
        $this->container['flexbox_positioning'] = $data['flexbox_positioning'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['vertical_alignment'] === null) {
            $invalidProperties[] = "'vertical_alignment' can't be null";
        }
        $allowedValues = $this->getVerticalAlignmentAllowableValues();
        if (!is_null($this->container['vertical_alignment']) && !in_array($this->container['vertical_alignment'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'vertical_alignment', must be one of '%s'",
                $this->container['vertical_alignment'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['background_color'] === null) {
            $invalidProperties[] = "'background_color' can't be null";
        }
        if ($this->container['background_image'] === null) {
            $invalidProperties[] = "'background_image' can't be null";
        }
        if ($this->container['background_gradient'] === null) {
            $invalidProperties[] = "'background_gradient' can't be null";
        }
        if ($this->container['max_width_section_centering'] === null) {
            $invalidProperties[] = "'max_width_section_centering' can't be null";
        }
        if ($this->container['force_full_width_section'] === null) {
            $invalidProperties[] = "'force_full_width_section' can't be null";
        }
        if ($this->container['flexbox_positioning'] === null) {
            $invalidProperties[] = "'flexbox_positioning' can't be null";
        }
        $allowedValues = $this->getFlexboxPositioningAllowableValues();
        if (!is_null($this->container['flexbox_positioning']) && !in_array($this->container['flexbox_positioning'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'flexbox_positioning', must be one of '%s'",
                $this->container['flexbox_positioning'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets vertical_alignment
     *
     * @return string
     */
    public function getVerticalAlignment()
    {
        return $this->container['vertical_alignment'];
    }

    /**
     * Sets vertical_alignment
     *
     * @param string $vertical_alignment vertical_alignment
     *
     * @return self
     */
    public function setVerticalAlignment($vertical_alignment)
    {
        $allowedValues = $this->getVerticalAlignmentAllowableValues();
        if (!in_array($vertical_alignment, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'vertical_alignment', must be one of '%s'",
                    $vertical_alignment,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['vertical_alignment'] = $vertical_alignment;

        return $this;
    }

    /**
     * Gets background_color
     *
     * @return \HubSpot\Client\Cms\Blogs\BlogPosts\Model\RGBAColor
     */
    public function getBackgroundColor()
    {
        return $this->container['background_color'];
    }

    /**
     * Sets background_color
     *
     * @param \HubSpot\Client\Cms\Blogs\BlogPosts\Model\RGBAColor $background_color background_color
     *
     * @return self
     */
    public function setBackgroundColor($background_color)
    {
        $this->container['background_color'] = $background_color;

        return $this;
    }

    /**
     * Gets background_image
     *
     * @return \HubSpot\Client\Cms\Blogs\BlogPosts\Model\BackgroundImage
     */
    public function getBackgroundImage()
    {
        return $this->container['background_image'];
    }

    /**
     * Sets background_image
     *
     * @param \HubSpot\Client\Cms\Blogs\BlogPosts\Model\BackgroundImage $background_image background_image
     *
     * @return self
     */
    public function setBackgroundImage($background_image)
    {
        $this->container['background_image'] = $background_image;

        return $this;
    }

    /**
     * Gets background_gradient
     *
     * @return \HubSpot\Client\Cms\Blogs\BlogPosts\Model\Gradient
     */
    public function getBackgroundGradient()
    {
        return $this->container['background_gradient'];
    }

    /**
     * Sets background_gradient
     *
     * @param \HubSpot\Client\Cms\Blogs\BlogPosts\Model\Gradient $background_gradient background_gradient
     *
     * @return self
     */
    public function setBackgroundGradient($background_gradient)
    {
        $this->container['background_gradient'] = $background_gradient;

        return $this;
    }

    /**
     * Gets max_width_section_centering
     *
     * @return int
     */
    public function getMaxWidthSectionCentering()
    {
        return $this->container['max_width_section_centering'];
    }

    /**
     * Sets max_width_section_centering
     *
     * @param int $max_width_section_centering max_width_section_centering
     *
     * @return self
     */
    public function setMaxWidthSectionCentering($max_width_section_centering)
    {
        $this->container['max_width_section_centering'] = $max_width_section_centering;

        return $this;
    }

    /**
     * Gets force_full_width_section
     *
     * @return bool
     */
    public function getForceFullWidthSection()
    {
        return $this->container['force_full_width_section'];
    }

    /**
     * Sets force_full_width_section
     *
     * @param bool $force_full_width_section force_full_width_section
     *
     * @return self
     */
    public function setForceFullWidthSection($force_full_width_section)
    {
        $this->container['force_full_width_section'] = $force_full_width_section;

        return $this;
    }

    /**
     * Gets flexbox_positioning
     *
     * @return string
     */
    public function getFlexboxPositioning()
    {
        return $this->container['flexbox_positioning'];
    }

    /**
     * Sets flexbox_positioning
     *
     * @param string $flexbox_positioning flexbox_positioning
     *
     * @return self
     */
    public function setFlexboxPositioning($flexbox_positioning)
    {
        $allowedValues = $this->getFlexboxPositioningAllowableValues();
        if (!in_array($flexbox_positioning, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'flexbox_positioning', must be one of '%s'",
                    $flexbox_positioning,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['flexbox_positioning'] = $flexbox_positioning;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


