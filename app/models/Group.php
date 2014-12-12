<?php
/**
 * hualian工程
 * 
 * Groups.php文件
 * 
 * User: Administrator
 * DateTime: 2014/12/10 16:38
 *
 * @property integer $id
 * @property string $name
 * @property string $permissions
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Groups whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Groups whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Groups wherePermissions($value)
 * @method static \Illuminate\Database\Query\Builder|\Groups whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Groups whereUpdatedAt($value)
 */

class Group extends Eloquent{
	protected $table = 'groups';

} 