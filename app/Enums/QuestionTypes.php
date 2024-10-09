<?php

namespace App\Enums;

enum QuestionTypes: string
{
    case NAME = 'name';
    case PHONE = 'phone';
    case EMAIL = 'email';
    case URL = 'url';
    case FILE = 'file';
    case SHORTTEXT = 'shorttext';
    case LONGTEXT = 'longtext';
    case SELECT = 'select';
}
