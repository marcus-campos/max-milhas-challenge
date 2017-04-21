<?php

use PHPUnit\Framework\TestCase;

class GalleryDBTest extends TestCase
{
    /**
     *
     */
    public function testDestroyAll()
    {
        $result = $this->destroyAll();
        $this->assertTrue($result);
    }

    /**
     * @return string
     */
    public function testCopyFile()
    {
        $localFile = __DIR__ . '/files/avatar-1.jpg';
        $extension = $this->getExtension($localFile); //Ger extension info

        $path = publicPath('storage/'.uniqid().'.').$extension;

        $result = copy($localFile, $path);

        $this->assertTrue($result);

        return $path;
    }

    /**
     * @depends testCopyFile
     */
    public function testDestroyFile($path)
    {
        $result = unlink($path);

        $this->assertTrue($result);
    }

    /**
     * @param $fileName
     * @return mixed
     */
    public function getExtension($fileName)
    {
        return pathinfo($fileName, PATHINFO_EXTENSION); //Get extension info
    }

    /**
     * @return bool
     */
    public function destroyAll()
    {
        $gallery = new \App\Models\Gallery();
        $result = false;

        if(count($photos = $gallery->all()) > 0) //Check find
        {
            foreach ($photos as $photo) {
                if (deleteFile(publicPath($photo['path']))) { //Try to delete file
                    $gallery->delete($photo['id']); //Delete database value
                }
                else
                    return false;
            }
            $result = true;
        }
        else
            $result = true;

        return $result;
    }
}
