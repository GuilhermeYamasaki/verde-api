<?php

namespace App\Enums;

enum DispatchedJobStatus: string
{
    case CREATED = 'criado';
    case PROCESSING = 'processando';
    case SUCCESS = 'sucesso';
    case FAILED = 'falha';
}
