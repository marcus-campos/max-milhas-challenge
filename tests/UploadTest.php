<?php

use PHPUnit\Framework\TestCase;

class UploadTest extends TestCase
{
    public function setUp()
    {
        if (!session_id()) @session_start();


        // Tried with parent::setUp() here and at the end
        // parent::setUp();
        $localFile = __DIR__ . '/files/avatar-1.jpg';

        //print($local_file);

        $_FILES = array(
            'arquivo' => array (
                'tmp_name' => $localFile,
                'name' => 'avatar-1.jpg',
                'type' => 'image/jpeg',
                'size' => 3070,
                'error' => 0,
            ),
        );

        parent::setUp();
    }

    public function testUpload()
    {
        $manager = new \App\Controllers\ManagerController();
        $manager->redirect = false;
        $manager->copy = true;

        $result = $manager->add();

        if($result)
            $this->assertTrue(true);
        else
            $this->assertTrue(false);

    }
}