<?php
namespace App\Services;

class ServiceProduct{
    /**
     * delete product
     *
     * @param $id
     *
     * @return delete product by id
     */
    public static function delete($id,$model){
        $object = $model::findOrFail($id);
        $message = "Product not found";
        if ($object) {
            $object->delete();
            $message = "Delete success!";
        }
        $data = [
            'message' => $message
        ];
        return $data;
    }
    /**
     *  upload image
     * 
     * @param Request $request
     * @param string $key, $input, $storage, $path
     * 
     * @return Response
     */
    public function uploadImage($request, $key, $input, $storage,$path)
    {
        if ($request->hasFile($input)) {
            $file = $request->file($input);
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path($storage);
            $file->move($destinationPath, $file_name);
            $key->avatar = $path.$file_name;
        }

    }
}