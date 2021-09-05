<?php
declare(strict_types=1);

namespace app\core;

class FileDriver
{

    protected array $type              = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
    protected const PATH_FILE          = 'upload/';
    protected const KEY_ARRAY_SIZE     = 'size';
    protected const KEY_ARRAY_NAME     = 'name';
    protected const KEY_ARRAY_TMP_NAME = 'tmp_name';

        /**
     * FileDriver constructor.
     * @param array $file
     */
    public function __construct(private array $file){}

    /**
     * @return bool
     */
    public function isFile(): bool
    {
        return !($this->file[self::KEY_ARRAY_NAME] === '') ;
    }

    /**
     * @return bool
     */
    public function checkSize(): bool
    {
        return !($this->file[self::KEY_ARRAY_SIZE] === 0);
    }


    public function checkType(): bool
    {
        $getMime     = explode('.', $this->file[self::KEY_ARRAY_NAME]);
        $currentType = strtolower(end($getMime));
        return in_array($currentType, $this->type);
    }

    /**
     * @return string|bool
     */
    public function saveFile(): string|bool
    {
        if ($this->checkSize() === false or $this->checkType() === false) {
            return false;
        }
        $name = Support::rand() . $this->file[self::KEY_ARRAY_NAME];
        copy($this->file[self::KEY_ARRAY_TMP_NAME], self::PATH_FILE . $name);
        return $name;
    }
}