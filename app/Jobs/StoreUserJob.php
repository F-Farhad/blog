<?php

namespace App\Jobs;

use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class StoreUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $password = Str::random(10);
        $this->data['password'] = Hash::make($password);
        $user = User::firstOrCreate(['email'=> $this->data['email']], $this->data); //создаем нового пользователя или возвращаем если уже есть. То есть заботимся о том что бы
                                                                    //пользователи были уникальными
                                        //Так выглядит полная работа данного метода с указанием 2 массивов
        //$category = Category::firstOrCreate(['title' => $data['title']], ['title' => $data['title']]);
            // Первый массив определяем по каким ключам стоит проверять уникальность. Если title не уникален, то он вернет, обьект
            // существующий в бд. Во втором массиве указываются все атрибуты по которым будет создана запись в бд, указывается обязательно
            // https://www.youtube.com/watch?v=FMpJ8-5pnUQ&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=8
            // 5 минута
        
        Mail::to($this->data['email'])->send(new PasswordMail($password));    //работа с почтой https://www.youtube.com/watch?v=sGY35rfCSbA&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=28
        
        event(new Registered($user)); //данный метод служит в ситуации когда админ создает руками пользователя, он нужен для того что бы
                                //было отправлено письмо с паролеме и подтвержением почты 
                                //3:00 https://www.youtube.com/watch?v=njFqr4Si6H4&list=PLd2_Os8Cj3t8StX6GztbdMIUXmgPuingB&index=29
    }
}
