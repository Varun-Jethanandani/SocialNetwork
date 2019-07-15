<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

use DB;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Image as ImageResource;
use App\Http\Resources\Video as VideoResource;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('cover_image')){
            $post = new Post;
            $post->user_id = $request->input('user_id');
            $mime = $request->file('cover_image')->getMimeType();
            if(strstr($mime, "video/")){
                $post->post_type = 1;
            }else{
                $post->post_type = 2;
            }
            
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);//This is from basic php
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            $file_path = $fileNameToStore;            

            $post->file_path=$file_path;

            if($post->save()){
                return new PostResource($post);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id){
        $post = Post::findOrfail($post_id);
        return new PostResource($post);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        //
        $post = Post::findOrfail($post_id);
        $post->is_deleted = 1;

        if($post->save()){
            return new PostResource($post);
        }
    }

    public function likePostButton(){
        return view('like');
    }

    public function likePosts(Request $request){
        $post_id = $request->post_id;
        
        $user_id = 2;

        $isLiked = DB::select('select * from post_likes where post_id = :post_id AND user_id = :user_id', ['post_id' => $post_id,'user_id' => $user_id]);
      
        if($isLiked){
            $is_deleted = $isLiked[0]->is_deleted;            
            if(!$is_deleted){ 
                $updateLike = DB::update('update post_likes set is_deleted = 1 where post_id = ? AND user_id = ?',[$post_id,$user_id]);
            }else{
                $updateLike = DB::update('update post_likes set is_deleted = 0 where post_id = ? AND user_id = ?',[$post_id,$user_id]);
            }    
        }else{
            $result = DB::insert('insert into post_likes (post_id, user_id,created_at,updated_at,is_deleted) values (?, ?, ?, ?, ?)', [$post_id, $user_id,now(),now(),0]);
        }
        $post = Post::findOrfail($post_id);
        if(isset($result) || $is_deleted){
            $post->no_of_likes = $post->no_of_likes + 1;            
        }else{
            $post->no_of_likes = $post->no_of_likes -1;            
        }   
        $post->save();
        return new PostResource($post);     
    }
}
