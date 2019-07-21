<?php
namespace adamjsmith\guestbook\application\models;

use adamjsmith\guestbook\library\Model;

class Setting extends Model
{
    protected static $tableName = "settings";
    protected static $primaryKey = "setting_id";
}