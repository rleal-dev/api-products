<?php

namespace Domain\Auth\Enums;

enum LogoutType: string
{
    case ALL_TOKENS = 'ALL_TOKENS';
    case CURRENT_TOKEN = 'CURRENT_TOKEN';
}
