
<?php

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
//use RectorLaravel\Set\LaravelLevelSetList;
use Rector\Php71\Rector\FuncCall\RemoveExtraParametersRector;
use Rector\Php70\Rector\Ternary\TernaryToNullCoalescingRector;
use Rector\Transform\Rector\FuncCall\FuncCallToStaticCallRector;
use Rector\Php56\Rector\FuncCall\PowToExpRector;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Php53\Rector\Ternary\TernaryToElvisRector;
use RectorLaravel\Rector\StaticCall\MinutesToSecondsInCacheRector;
use Rector\Transform\Rector\String_\StringToClassConstantRector;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Php54\Rector\Array_\LongArrayToShortArrayRector;
use Rector\Php71\Rector\List_\ListToArrayDestructRector;
use Rector\Php73\Rector\FuncCall\SetCookieRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnNeverTypeRector;
use Rector\Php80\Rector\NotIdentical\StrContainsRector;

return static function (RectorConfig $rectorConfig): void {

  $rectorConfig->paths([
    __DIR__ . '/app',
    __DIR__ . '/setting',
    __DIR__ . '/index.php',

  ]);

  $rectorConfig->sets([
    LevelSetList::UP_TO_PHP_72,
  ]);

  $rectorConfig->skip([
    RemoveExtraParametersRector::class,          // (数字) を () にするバグ
    TernaryToNullCoalescingRector::class,        // ? を ?? にする
    //        FuncCallToStaticCallRector::class,           // str_random(数字) を /Illuminate/Support/Str::random(数字) にする
    PowToExpRector::class,                       // pow を ** にする
    RenameMethodRector::class,                   // メソッドリネームにバグがあるのでスキップ
    TernaryToElvisRector::class,                 // 三項演算子を省略形にする
    MinutesToSecondsInCacheRector::class,        // キャッシュの数字を勝手に変えるバグ
    StringToClassConstantRector::class,          // ストリング型を::classに変換する
    StringClassNameToClassConstantRector::class, // ストリング型を::classに変換する
    NullToStrictStringFuncCallArgRector::class,  // ストリングに決めつける
    LongArrayToShortArrayRector::class,          // arryを[]に変換
    ListToArrayDestructRector::class,            // listを[]に変換
    SetCookieRector::class,                      // set関数に配列を追加する
    ReturnNeverTypeRector::class,                // 関数のリターンの宣言を追加する
    StrContainsRector::class,                    // 互換性のない関数に変換する
  ]);
};
