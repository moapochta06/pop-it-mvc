<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MaxValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать не более :max символов';

    public function rule(): bool
    {
        $value = $this->value;
        
        // Получаем максимальную длину из аргументов
        $max = (int)($this->args[0] ?? null);
        
        if ($max <= 0) {
            return false;
        }
        // Добавляем параметр max в messageKeys для подстановки в сообщение
        $this->messageKeys[':max'] = $max;
        
        return mb_strlen((string)$value) <= $max;
    }
}