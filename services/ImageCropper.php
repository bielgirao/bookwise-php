<?php
    
    class ImageCropper
    {
        /**
         * Receive the $_FILES['image'], crop it at the center keeping applying the correct aspect‑ratio,
         * resize it and save into the correct directory.
         *
         * @param array $file      $_FILES element
         * @param int   $tw        Final Width (568)
         * @param int   $th        Final Height  (872)
         * @param string $dir      Directory to save the image (ex: "images/")
         * @return string          Relative path of saved file
         * @throws Exception
         */
        public static function cropAndSave(array $file, int $tw, int $th, string $dir): string
        {
            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new Exception("Invalid upload");
            }
            
            $tmp  = $file['tmp_name'];
            $type = mime_content_type($tmp);
            if (!in_array($type, ['image/jpeg','image/png'], true)) {
                throw new Exception("Only JPG and PNG are supported");
            }
            
            
            if ($type == 'image/jpeg') {
                $src = imagecreatefromjpeg($tmp);
                $ext = 'jpg';
            } else {
                $src = imagecreatefrompng($tmp);
                $ext = 'png';
            }
            
            $w = imagesx($src);
            $h = imagesy($src);
            $ratioSrc = $w / $h;
            $ratioTgt = $tw / $th; // 568/872 = 71/109
            
            if ($ratioSrc > $ratioTgt) {
                $cropH = $h;
                $cropW = (int)($h * $ratioTgt);
            } else {
                $cropW = $w;
                $cropH = (int)($w / $ratioTgt);
            }
            $cropX = (int)(($w - $cropW) / 2);
            $cropY = (int)(($h - $cropH) / 2);
            
            $cropped = imagecrop($src, [
                'x'      => $cropX,
                'y'      => $cropY,
                'width'  => $cropW,
                'height' => $cropH,
            ]);
            
            $final = imagecreatetruecolor($tw, $th);
            if ($ext === 'png') {
                imagealphablending($final, false);
                imagesavealpha($final, true);
            }
            imagecopyresampled(
                $final, $cropped,
                0, 0, 0, 0,
                $tw, $th,
                $cropW, $cropH
            );
            
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $name = md5(uniqid('', true));
            $path = "images/{$name}.{$ext}";
            
            if ($ext === 'jpg') {
                imagejpeg($final, $path, 90);
            } else {
                imagepng($final, $path);
            }
            
            imagedestroy($src);
            imagedestroy($cropped);
            imagedestroy($final);
            
            return $path;
        }
    }