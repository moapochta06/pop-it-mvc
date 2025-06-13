<?php
namespace Validators;

use Src\Validator\AbstractValidator;

class ImageValidator extends AbstractValidator 
{
    protected string $message = 'Поле :field должно быть изображением (JPEG или PNG)';
    
    public function rule(): bool
    {
        // Если значение не массив или не файл
        if (!is_array($this->value) || !isset($this->value['tmp_name'])) {
            return false;
        }

        // Если файл не был загружен
        if (empty($this->value['tmp_name']) || $this->value['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Проверка MIME-типа
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $this->value['tmp_name']);
        finfo_close($finfo);
        
        return in_array($mime, $allowedTypes);
    }
}
