<?php
/*
 * @Date         : 2022-03-02 14:49:25
 * @LastEditors  : Jack Zhou <jack@ks-it.co>
 * @LastEditTime : 2022-03-02 17:22:16
 * @Description  : 
 * @FilePath     : /recruitment-php-code-test/tests/App/DemoTest.php
 */

namespace Test\App;

use PHPUnit\Framework\TestCase;


class DemoTest extends TestCase {

//    public function test_foo() {
//
//    }

    /**
     * 测试获取用户数据
     * result 可以是来自某个连接api的返回json
     */
    public function test_get_user_info()
    {
        $result = '{ "error": 0, "data": { "id": 1, "username": "hello world" }}';
        $result_arr = json_decode($result, true);
        $this->assertEquals(true,is_array($result_arr));
        if (in_array('error', $result_arr) && $result_arr['error'] == 0) {
            if (in_array('data', $result_arr)) {
                $this->assertEquals(0,$result_arr['error']);
                $this->assertEquals(1,$result_arr['data']['id']);
                $this->assertEquals('hello world',$result_arr['data']['username']);
            }
        }
    }
}