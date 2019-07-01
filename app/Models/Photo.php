<?php

namespace App\Models;

use Exception;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\UploadedFile;

use Intervention\Image\Facades\Image;

use App\Models\Traits\AssociableTrait;
use App\Models\Traits\TranslationTrait;

use App\Models\Users\User;

class Photo extends Model
{
    use TranslationTrait;
    use AssociableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * The database table used by language pivot.
     *
     * @var string
     */
    protected $translation_table = 'language_photo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename',
        'type'
    ];

    protected  $translatable = [
        'title',
        'alt',
        'description'
    ];

    const STORAGE_PATH = "public/images";
    const THUMBNAILS_STORAGE_PATH = "public/images/thumbnails";
    const THUMBNAILS_SIZE = 120;

    public static $associable_models = [
        // code  => class name
        'page_component' => "App\Models\Pages\Sections\Components\Component",
        'setting_shape' => "App\Models\Settings\Shape",
        'seo' => "App\Models\Seo\Seo",
        'user' => "App\Models\Users\User"
    ];

    public static $create_associable_models = [
        // code
        'user',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'thumbnail_url',
        'url',
        "title",
        'alt',
        'description',
        "pivot_use",
        "pivot_class",
        "pivot_order",
    ];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->getImageThumbnailUrl();
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getUrlAttribute()
    {
        return $this->getImageUrl();
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getTitleAttribute()
    {
        return $this->translation()->title;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getAltAttribute()
    {
        return $this->translation()->alt;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getDescriptionAttribute()
    {
        return $this->translation()->description;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getPivotUseAttribute()
    {
        return $this->pivot ? $this->pivot->use : null ;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getPivotClassAttribute()
    {
        return $this->pivot ? $this->pivot->class : null ;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getPivotOrderAttribute()
    {
        return $this->pivot ? $this->pivot->order : null ;
    }

    /**
     * Crea si no existe una carpeta
     * @param  string $path carpeta a verificar
     * @return string       carpeta a verificar
     */
    public static function existsOrCreatePath($path)
    {
        File::exists($path) or File::makeDirectory($path);
        return $path;
    }

    /**
    * Crea si no existe la carpeta donde se guardara la Thumbnail la imagen
    * @return string   directorio de la Thumbnail la imagen
    */
    public static function getImagesThumbnailsPath()
    {
        $thumbnails_path = storage_path("app/". static::THUMBNAILS_STORAGE_PATH );
        return  static::existsOrCreatePath($thumbnails_path);
    }

    /**
     * Crea si no existe de las imagenes
     * @return string           ruta
     */
    public static function getImagesPath()
    {
        return static::existsOrCreatePath( storage_path("app/".static::STORAGE_PATH) ) ;
    }

    /**
     * crea una nueva imagen a partir de un archivo
     * @param  UploadedFile $image archivo de imagen
     * @return Photo|null              regresa el objeto de photo en caso de craese correctamente
     */
    public static function createImageFile(UploadedFile $img_file)
    {
        $file_path = $img_file->store(static::STORAGE_PATH);

        if (!$file_path) {
            return ;
        }

        try {
        	// creamos el objeto de imagen
            $imageFile = Image::make( storage_path("app/".$file_path)  );

        	// thunmbail
            $imageFile->resize(static::THUMBNAILS_SIZE, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } catch (Exception $e) {
            Storage::delete($file_path);
            return ;
        }

        try {
            $imageFile->save( static::getImagesThumbnailsPath()."/".$imageFile->basename );
        } catch (Exception $e) {
            Storage::delete($file_path);
            return ;
        }

        return $file_path;
    }


    public static function existsPhoto($file_name)
    {
        $photos = static::GetPhotoCollectionByFileName($file_name);
        return $photos->count() > 0;
    }

    public function scopeGetPhotoCollectionByFileName($query, $file_name)
    {
        return $query->where(['filename'=> $file_name])->get();
    }

    /**
     * url de la imagen
     * @return string url de la imagen
     */
    public function getImagePublicPath()
    {
        $public_path = str_replace("public", "storage", static::STORAGE_PATH);
        return str_replace(static::STORAGE_PATH, $public_path, $this->filename);
    }

    /**
     * url de la imagen
     * @return string url de la imagen
     */
    public function getImageUrl()
    {
        return url($this->getImagePublicPath());
    }

    /**
     * url de la imagen
     * @return string url de la imagen
     */
    public function getImageThumbnailPublicPath()
    {
        $public_path = str_replace("public", "storage", static::THUMBNAILS_STORAGE_PATH);
        return str_replace(static::STORAGE_PATH,$public_path,  $this->filename);
    }

    /**
     * url de la imagen
     * @return string url de la imagen
     */
    public function getImageThumbnailUrl()
    {
        return url($this->getImageThumbnailPublicPath());
    }

    /**
     * borra losarchivos de una imagen
     * @return boolean true en caso de borrar ambos archivos
     */
    public function deleteImageFiles()
    {
        return Storage::delete($this->filename) && Storage::delete(str_replace(static::STORAGE_PATH, static::THUMBNAILS_STORAGE_PATH, $this->filename))  ;
    }

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * si una imagen puede ser borrada
     * @return boolean si una imagen tienen objetos asociados regresa false
     */
    public function isDeletable()
    {
        $total = 0;
        $total += $this->users->count();
        return $total == 0;
    }

}
