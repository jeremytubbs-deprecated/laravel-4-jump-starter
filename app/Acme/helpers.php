<?php

//generate slug for provided field on provided model
function getSlug($title, $model)
{
    $slug = Str::slug($title);
    $slugCount = count($model::whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get());

    return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
}

//check if user has been soft deleted by the admin
function check_soft_deletes($value, $field, $model)
{
	$deleted = $model::onlyTrashed()->where($field, $value)->first();

	return $deleted;
}
