<?php
namespace adamjsmith\guestbook\application\models;

use adamjsmith\guestbook\library\Model;

class Message extends Model
{
    protected static $tableName = "messages";
    protected static $primaryKey = "message_id";
}