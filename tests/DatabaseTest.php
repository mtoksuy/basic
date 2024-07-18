<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase {
  protected function setUp(): void {
    $_SERVER['HTTP_HOST']      = 'localhost';
    $_SERVER['REQUEST_SCHEME'] = 'http';
    $_SERVER['REQUEST_URI']    = '/';
    require_once('setting/config.php');
    require_once(PATH . 'setting/db_config.php');
    require_once(PATH . 'setting/db.php');
  }
  protected function tearDown(): void {
    // データベースのクリーンアップなど
  }
  public function testSomething() {
    $article_res = model_db::phpunitquery("
      SELECT COUNT(*) 
      FROM article 
      WHERE del = 0
    ");
    // 結果が配列で返ってきていることを確認
    $this->assertIsArray($article_res);

    // 結果の配列が1要素だけ含まれていることを確認
    $this->assertCount(1, $article_res);

    // COUNT(*) の結果が '6' であることを確認
    $this->assertEquals(6, intval($article_res[0]['COUNT(*)']));
  }
}
