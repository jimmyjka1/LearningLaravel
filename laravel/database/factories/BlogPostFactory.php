<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this -> faker -> sentence(10),
            'content' => $this -> faker -> paragraphs(5, true)
        ];
    }

    public function setBothTitleContent($title = 'Default', $content = 'Default Content'){
        return $this -> state([
            'title' => $title,
            'content' => $content
            // 'content' => 'Content of the blog post'
        ]);
    }

    public function setTitle(){
        return $this -> state([
            'title' => 'New title'
        ]);

    }


    public function setContent(){
        return $this -> state([
            'content' => 'Content of the blog post'
        ]);
    }
}
