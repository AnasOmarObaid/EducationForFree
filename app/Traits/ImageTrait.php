<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    /**
     * Create image in database and store in folder
     * @param Request $request|null
     * @return $this|boolean|string|null
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

    public function updateImage($file, $image, $path, $folder)
    {

        if ($path == $folder . '/default.png')
            return $this->storeImage($file, $folder);

        // delete the image from disk
        $this->deleteImage($path);

        // remove the row from database
        $image->delete();

        // store the image
        return $this->storeImage($file, $folder);
    } //-- end updateImage()


    /**
     * delete the image
     * @param Request $request|null
     * @return $this|boolean|string|null
     */

    public function deleteImage($path, $driver = 'public')
    {
        // delete the photo from folder
        return Storage::disk($driver)->delete($path);
    } //-- end deleteImage
}//-- end ImageTrait
