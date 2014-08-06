<?php
class ParamiracleTest extends WP_UnitTestCase {

  /**
   * Run a simple test to ensure that the tests are running
   */
  function test_tests() {
    $this->assertTrue( true );
  }

  function test_init_hook_was_added() {
    $this->assertGreaterThan( 0, has_filter( 'query_vars', array( 'Paramiracle', 'query_vars' ) ) );
  }

}
