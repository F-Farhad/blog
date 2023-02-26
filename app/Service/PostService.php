<?php

namespace App\Service;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService{

    public function store($data){
        try{
            DB::beginTransaction();
            $tag_ids = $data['tag_ids'];                                                                        //https://www.youtube.com/watch?v=YfqXlvFtgIk&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=21
            unset($data['tag_ids']);                    //сохранять картинки следует в папку storage/public, после данную папку следует расшарить в папку public, для этого создается ссылка на папку storage php artisan storage:link 
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);   //https://www.youtube.com/watch?v=oCwP0PsHmUk&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=17
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $post = Post::firstOrCreate($data); //создаем новую категорию или возвращаем если уже есть. То есть заботимся о том что бы
                                            //имена были уникальными
            $post->tags()->attach($tag_ids);
                                            //Так выглядит полная работа данного метода с указанием 2 массивов
            //$category = Category::firstOrCreate(['title' => $data['title']], ['title' => $data['title']]);
                // Первый массив определяет по каким ключам стоит проверять уникальность. Если title не уникален, то он вернет, обьект
                // существующий в бд. Во втором массиве указываются все атрибуты по которым будет создана запись в бд, указывается обязательно
                // https://www.youtube.com/watch?v=FMpJ8-5pnUQ&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=8
                // 5 минута
            DB::commit();
        }catch(Exception $exception){
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post){
        try{    
            DB::beginTransaction();         //начинаем транзакцию
            $tag_ids = $data['tag_ids'];                                                                        //https://www.youtube.com/watch?v=YfqXlvFtgIk&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=21
            unset($data['tag_ids']);   
            
            if(isset($data['preview_image'])){ //сохранять картинки следует в папку storage/public, после данную папку следует расшарить в папку public, для этого создается ссылка на папку storage php artisan storage:link 
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);   //https://www.youtube.com/watch?v=oCwP0PsHmUk&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=17
            }
            if(isset($data['main_image'])){
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }
            $post->update($data);
            $post->tags()->sync($tag_ids);  //метод sync удаляет все привязки которые есть у модели и создает новые, которые ему передают
            
            DB::commit();       //если все хорошо комитем ее
            return $post;
        }catch(Exception $exception){
            DB::rollBack();     //если что откатываемся
            abort(500);
        }
        
    }
}