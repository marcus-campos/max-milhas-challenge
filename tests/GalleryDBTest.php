<?php

use PHPUnit\Framework\TestCase;

class GalleryDBTest extends TestCase
{
    private $model;

    public function setUp()
    {
        $this->model = new \App\Models\Gallery();
    }

    public function testPhotoLife()
    {
        $photo = $this->model;

        $savedPhotoId = $this->savePhoto($photo); //Test save
        $this->deletePhoto($photo, $savedPhotoId);
    }

    /**
     * @param $photo
     * @return mixed
     */
    public function savePhoto($photo)
    {
        $name = uniqid();
        $path =  sha1(uniqid()).'png';
        $createdAt = date('d-m-Y H:i:s');

        $result = $photo->save([
            'name'       => $name,
            'path'       => $path,
            'created_at' => $createdAt
        ]);

        $this->assertEquals($name, $result['name']);
        $this->assertEquals($path, $result['path']);
        $this->assertEquals($createdAt, $result['created_at']);

        return $result['id'];

    }

    /**
     * @param $photo
     * @param $id
     */
    public function deletePhoto($photo, $id)
    {
        $result = $photo->delete($id);

        $this->assertTrue($result);
    }
}
