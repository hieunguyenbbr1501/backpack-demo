<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Str;
use Auth;
use Image;
use Storage;

class Post extends Model
{
    use CrudTrait;
   
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'posts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'title', 'thumbnail', 'content','user_id','publish','last_user_id'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function user(){
        return $this->belongsTo('App\Models\BackpackUser', 'user_id');
    }
    public function modifyuser(){
        return $this->belongsTo('App\Models\BackpackUser','last_user_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'post_tag','');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setTitleAttribute($value){
        $attribute_name = 'slug';
        $this->attributes['title'] = $value;
        $this->attributes[$attribute_name] = Str::slug($value);
    }
    public function getLinkTitle(){
        return "<a href='/" .$this->slug ."'>".$this->title."</a>";
    }
    public function setThumbnailAttribute($value){
        $attribute_name = 'thumbnail';
        $disk = config('backpack.base.root_disk_name'); // use Backpack's root disk; or your own
        $destination_path = 'public/uploads/posts/thumbnails';

        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the public path to the database
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
        else{
            $this->attributes[$attribute_name] = $value;
        }
}
public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

   

}
