<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    
    public function testNoBlogPostWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response -> assertSeeText('No post found');
        $response -> assertSeeText('Laravel App');

    }

    public function testSee1BlogPostPostWhenThereIs1WithNoComments(){
        $title = 'New Title';
        $content = 'Content of the blog Post!!!!!';
        
        
        // // arrange 
        // $post = new BlogPost();
        // $post -> title = $title;
        // $post -> content = $content;
        // $post -> save();

        $post = $this -> createDummyBlog($title, $content);

        // Act 
        $response = $this -> get('/posts');
        $response_show  = $this -> get(route('posts.show', ['post' => $post -> id]));

        // Assert 
        $response -> assertSeeText($title);
        $response -> assertSeeText('No Commetns yet!');
        
        $response_show -> assertSeeText($title);
        $response_show -> assertSeeText($content);
        
        $this -> assertDatabaseHas('blog_posts', [
            'title' => $title,
            'content' => $content
        ]);


    }

    public function testSee1BlogPostWithComments(){
        $title = 'New Title';
        $content = 'Content of the blog Post!!!!!';
        $number_of_comments = 4;
        
        $post = $this -> createDummyBlog($title, $content);
        
        Comment::factory($number_of_comments) -> create(['blog_post_id' => $post -> id ]);
        
        $response = $this -> get('/posts');
        $response -> assertSeeText($number_of_comments . " comments");

    }

    public function testStoreValid(){
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this -> post('/posts', $params)
            -> assertStatus(302)
            -> assertSessionHas('status');
        
        $this -> assertEquals(session('status'), 'Post successfully created');

    }

    public function testStoreInvalid(){
        $params = [
            'title' => 'a',
            'content' => 'b'
        ];

        $this -> post('/posts', $params) 
            -> assertStatus(302)
            -> assertSessionHas('errors');


        $messages = session('errors');
        $messages_array =  $messages -> getMessages();
        $this -> assertEquals($messages_array['title'][0], 'The title must be at least 5 characters.');
        $this -> assertEquals($messages_array['content'][0], 'The content must be at least 10 characters.');

    }


    public function testUpdateValid(){
        $title = 'New Title';
        $content = 'Content of the blog Post!!!!!';
        
        
        // // arrange 
        // $post = new BlogPost();
        // $post -> title = $title;
        // $post -> content = $content;
        // $post -> save();

        $post = $this -> createDummyBlog($title, $content);

        $this -> assertDatabaseHas('blog_posts', $post -> getAttributes());
        

        $new_title = "This is a new title";
        $new_content = 'This is the content of the post with new title';

        $params = [
            'title' => $new_title,
            'content' => $new_content
        ];

        $this -> put("/posts/{$post -> id}", $params) 
            -> assertStatus(302)
            -> assertSessionHas('status');

        $this -> assertEquals(session('status'), 'Blog post was updated');
        $this -> assertDatabaseMissing('blog_posts', $post -> getAttributes());
        $this -> assertDatabaseHas('blog_posts', [
            'title' => $new_title,
            'content' => $new_content
        ]);

    }


    public function testDelete(){
        $title = 'Some title';
        $content = "Content of some title";

        $post = $this -> createDummyBlog($title, $content);

        $this -> assertDatabaseHas('blog_posts', $post -> getAttributes());

        $this -> delete("/posts/{$post -> id}") 
            -> assertStatus(302)
            -> assertSessionHas('status');

        $this -> assertDatabaseMissing('blog_posts', $post -> getAttributes());
        $this -> assertEquals(session('status'), 'Post deleted successfully');
    }

    private function createDummyBlog($title = null, $content = null): BlogPost{
        $title = $title ??  'New Title';
        $content = $content ?? 'Content of the blog Post!!!!!';
        
        
        // arrange 
        return BlogPost::factory() -> setBothTitleContent($title, $content) -> create();
        
    }

    
}
