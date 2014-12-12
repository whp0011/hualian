<?php
/**
 * hualian工程
 * 
 * Articles.php文件
 * 
 * User: Administrator
 * DateTime: 2014/12/10 16:30
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $image
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Articles whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Articles whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Articles whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\Articles whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\Articles whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\Articles whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Articles whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Articles whereUpdatedAt($value)
 */

class Article extends Eloquent{
	protected $table = 'articles';
	protected $guarded  = array();

} 