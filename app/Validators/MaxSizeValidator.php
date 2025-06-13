<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MaxSizeValidator extends AbstractValidator
{
    protected string $message = 'Размер файла не должен превышать :max_file_size KB';

    public function rule(): bool
    {
        // Если файл не загружен или не массив - пропускаем валидацию 
        if (empty($this->value) || !is_array($this->value) || !isset($this->value['size'])) {
            return true;
        }

        $maxSizeKB = (int)($this->args[0] ?? 0);
        
        // Если не указан max_size - используем значение по умолчанию
        if ($maxSizeKB <= 0) {
            $maxSizeKB = 2048;
        }

        // Добавляем параметр для подстановки в сообщение об ошибке
        $this->messageKeys[':max_file_size'] = $maxSizeKB;

        // Конвертируем байты в килобайты и сравниваем
        $fileSizeKB = $this->value['size'] / 1024;

        return $fileSizeKB <= $maxSizeKB;
    }
}