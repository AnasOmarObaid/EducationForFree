<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{

    /**
     * storeImage
     *
     * @param  mixed $file
     * @param  mixed $folder
     * @param  mixed $driver
     * @return void
     */
    public function storeImage($file, $folder, $driver = 'public')
    {
        // store the images
        $path = $file->store($folder, $driver);

        // create image in database and return the id
        return Image::create([
            'path' => $path,
        ])->id;
    } //-- end create()

    /**
     * check if there is image to make change
     * @param Request $request|null
     * @return $this|boolean|string|null
     */

    /**
     * updateImage
     *
     * @param  mixed $file
     * @param  mixed $old_image
     * @param  mixed $path
     * @param  mixed $folder
     * @return void
     */
    public function updateImage($file, $old_image, $path, $folder)
    {

        if ($path == $folder . '/default.png')
            return $this->storeImage($file, $folder);

        // check if the image is default or not and delete it
        $this->checkAndDelete($path, $folder . '/default.png', $old_image);

        // store the image
        return $this->storeImage($file, $folder);
    } //-- end updateImage()


    /**
     * deleteImage
     *
     * @param  mixed $path
     * @param  mixed $driver
     * @return void
     */
    public function deleteImage($path, $driver = 'public')
    {
        // delete the photo from folder
        return Storage::disk($driver)->delete($path);
    } //-- end deleteImage


    /**
     * checkAndDelete
     *
     * @param  mixed $path
     * @param  mixed $default
     * @param  mixed $old_image
     * @return void
     */
    public function checkAndDelete($path, $default, $old_image)
    {
        // delete the old image from database in any case

        if ($path == $default)
            return;

        // delete the image from disk
        $this->deleteImage($path);

        // delete the old image from database
        $old_image->delete();
    } //-- end checkDefault
}//-- end ImageTrait
