<?php

namespace App\Http\Controllers\generator\DTO;

use App\Http\Utils\DataBaseConstants;
use Throwable;

class OptionsGeneratorDTO
{
    public string $type;
    public int $size;
    public string $format;
    public string $prefixe;
    public string $suffixe;

    public static function build($optionsInputs, $type)
    {
        $options = new OptionsGeneratorDTO();
        $options->setType($type);
        $options->setSize(self::matchSize($optionsInputs, $type));
        $options->setFormat(self::matchFormat($optionsInputs));
        $options->setPrefixe($optionsInputs->prefixe ?? '');
        $options->setSuffixe($optionsInputs->suffixe ?? '');
        return $options;
    }

    public static function buildV2($optionsInputs, $type)
    {
        $options = new OptionsGeneratorDTO();
        $options->setType($type);
        $options->setSize(self::matchSize($optionsInputs, $type));
        $options->setFormat(self::matchFormatV2($optionsInputs, $type));
        $options->setPrefixe($optionsInputs->prefixe ?? '');
        $options->setSuffixe($optionsInputs->suffixe ?? '');
        return $options;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getPrefixe(): string
    {
        return $this->prefixe;
    }

    /**
     * @param string $prefixe
     */
    public function setPrefixe(string $prefixe): void
    {
        $this->prefixe = $prefixe;
    }

    /**
     * @return string
     */
    public function getSuffixe(): string
    {
        return $this->suffixe;
    }

    /**
     * @param string $suffixe
     */
    public function setSuffixe(string $suffixe): void
    {
        $this->suffixe = $suffixe;
    }


    private static function matchSize($options, $type)
    {
        try {
            return DataBaseConstants::ID_TYPE_SIZE[$type][strtolower($options->size)];
        } catch (Throwable $e) {
            return match ($type) {
                'uid' => 6,
                'sku' => 8,
                'serial' => 3
            };
        }

    }

    private static function matchFormat($options)
    {
        try {
            return strtolower($options->format);
       } catch (Throwable $e) {
           return "DA";
        }

    }

    private static function matchFormatV2($options, $type)
    {
        try {
            return DataBaseConstants::ID_TYPE_FORMAT[$type][$options->format];
        } catch (Throwable $e) {
            return "DA";
        }

    }

}
