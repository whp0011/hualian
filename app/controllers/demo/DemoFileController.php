<?php

/**
 * hualian工程
 *
 * DemoFileUploadController.php文件
 *
 * User: Administrator
 * DateTime: 2015/1/6 13:53
 */
class DemoFileController extends BaseController
{
    public function upload()
    {
        $validator = Validator::make(Input::all(), [
                'img' => 'required|mimes:jpeg,bmp,png|max:2048'
            ]
        );
        if ($validator->fails()) {
            echo 'fail validator';
            var_dump($validator->failed());
        } else {
            $url = app_path() . '/files/imgs';
//            echo ASSETS;EXIT;
//            echo $url;exit;
            $storage = new \Upload\Storage\FileSystem($url);
            $file = new \Upload\File('img', $storage);

            $new_filename = uniqid();
            $file->setName($new_filename);

// Validate file upload
// MimeType List => http://www.webmaster-toolkit.com/mime-types.shtml
            $file->addValidations(array(
                // Ensure file is of type "image/png"
//                new \Upload\Validation\Mimetype('image/png','image/jpeg'),

                //You can also add multi mimetype validation
                //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                // Ensure file is no larger than 5M (use "B", "K", M", or "G")
//                new \Upload\Validation\Size('5M')
            ));

// Access data about the file that has been uploaded
            $data = array(
                'name' => $file->getNameWithExtension(),
                'extension' => $file->getExtension(),
                'mime' => $file->getMimetype(),
                'size' => $file->getSize(),
//                'md5' => $file->getMd5(),
//                'dimensions' => $file->getDimensions()
            );

            // Try to upload file
            try {
                // Success!
                $file->upload();
                echo 'true';
            } catch (\Exception $e) {
                // Fail!
                $errors = $file->getErrors();
                var_dump($errors);
            }
        }

    }
} 