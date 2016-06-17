<?php
class SyncTest extends LocalWebTestCase {
	public function testHello() {
    	$this->client->get('/hello/William', array(), array('SERVER_NAME' => 'local.dev', 'PHP_AUTH_USER' => 'auth', 'PHP_AUTH_PW' => 'auth123'));
      	$this->assertEquals(200, $this->client->response->status());
      	$this->assertSame('Hello, William', $this->client->response->body());
    }
}