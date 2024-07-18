<?php

use PHPUnit\Framework\TestCase;
//use App\Theme\Admin\Model\Article\Basis as aaaa;

class model_article_basis_Test extends TestCase {
  protected function setUp(): void {
    $_SERVER['HTTP_HOST']      = 'localhost';
    $_SERVER['REQUEST_SCHEME'] = 'http';
    $_SERVER['REQUEST_URI']    = '/';
    require_once('setting/config.php');
    require_once(PATH . 'setting/db_config.php');
    require_once(PATH . 'setting/db.php');
    require_once(PATH . 'app/theme/admin/model/article/basis.php');
  }
  protected function tearDown(): void {
    // データベースのクリーンアップなど
  }
  public function test_article_list_get() {
    $article_list_res = model_article_basis::article_list_get(3, 1);
    // 結果が配列で返ってきていることを確認
    $this->assertIsArray($article_list_res);
    // 結果の配列が1要素だけ含まれていることを確認
    $this->assertCount(3, $article_list_res);
  }
  public function test_article_paging_data_get() {
    $new_article_paging_data_array = model_article_basis::article_paging_data_get(2, 1);
    //    var_dump($new_article_paging_data_array);
  }
  /*
  public function test_article_get() {
  }
  public function test_article_previous_next_get() {
  }
  public function test_category_article_list_get() {
  }
  public function test_category_data_get() {
  }
  public function test_writer_article_get() {
  }
  public function test_related_articles_res_get() {
  }
  */
  /*
  public function testSomethingfdfd() {
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
    */
}
