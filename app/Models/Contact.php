<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Метод добавляет данные к двум связанным таблицам
     * (phones и emails) у контакта
     *
     * @param array $data
     * @return void
     */
    public function relationsBulkInsert(array $data): void
    {
        $emailsArray = [];
        $phonesArray = [];
        
        foreach ($data['emails'] as $v) {
            $emailsArray[] = ['value' => $v];
        }

        foreach ($data['phones'] as $v) {
            $phonesArray[] = ['value' => $v];
        }

        $this->emails()->createMany($emailsArray);
        $this->phones()->createMany($phonesArray);

        return ;
    }

    /**
     * Метод "обновляет" данные у связанных таблиц контакта
     * (согласен, не самое идеальное решение >_<")
     * 
     * @param array $data
     * @return void
     */
    public function relationsBulkUpdate(array $data)
    {
        $this->phones()->delete();
        $this->emails()->delete();

        $this->relationsBulkInsert($data);
    }
}