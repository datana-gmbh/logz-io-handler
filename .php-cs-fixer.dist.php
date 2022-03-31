<?php

declare(strict_types=1);

use Ergebnis\PhpCsFixer;

$config = PhpCsFixer\Config\Factory::fromRuleSet(new PhpCsFixer\Config\RuleSet\Php81(''), [
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'continue',
            'declare',
            'default',
            'do',
            'exit',
            'for',
            'foreach',
            'goto',
            'if',
            'include',
            'include_once',
            'require',
            'require_once',
            'return',
            'switch',
            'throw',
            'try',
            'while',
        ],
    ],
    'concat_space' => [
        'spacing' => 'none',
    ],
    'date_time_immutable' => false,
    'error_suppression' => false,
    'final_class' => false,
    'mb_str_functions' => false,
    'native_function_invocation' => [
        'exclude' => [],
        'include' => [
            '@compiler_optimized',
        ],
        'scope' => 'all',
        'strict' => false,
    ],
    'php_unit_internal_class' => false,
    'php_unit_test_annotation' => [
        'style' => 'annotation',
    ],
    'php_unit_test_class_requires_covers' => false,
]);

$config->getFinder()
    ->in('src')
    ->in('tests');
;

$config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php_cs.cache');

return $config;
