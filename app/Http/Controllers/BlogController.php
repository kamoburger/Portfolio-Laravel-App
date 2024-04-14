<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Exception;
use PhpParser\Node\Stmt\Return_;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $blogs = json_encode(Blog::all(), JSON_UNESCAPED_UNICODE);
            return $blogs;
        } catch (Exception $e) {
            return response()->json(
                ["errors" => ["db" => ["データベースに接続出来ません"]]],
            400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            Blog::create($request->all());
        } catch (Exception $e) {
            return response()->json(
                ["errors" => ["db" => ["データベースに接続出来ません"]]],
            400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }

        // return response()->json(
        //     [
        //         "title" => $request->input("title"),
        //         "content" => $request->input("content")
        //     ]
        // );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $blog = Blog::find($id);
            if (is_null($blog)) {
                return response()->json(
                    ["errors" => ["id" => ["該当IDの記事が見つかりません"]]],
                400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            } else {
                return $blog;
            }
        } catch (Exception $e) {
            return response()->json(
                ["errors" => ["db" => ["データベースに接続出来ません"]]],
            400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, UpdateBlogRequest $request)
    {
        try {
            $blog = Blog::find($id);
            if (is_null($blog)) {
                return response()->json(
                    ["errors" => ["id" => ["該当IDの記事が見つかりません"]]],
                400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            } else {
                $blog->fill(
                    [
                        "title" => $request->all()["title"],
                        "content" => $request->all()["content"]
                    ]
                );
                $blog->save();
            }
        } catch (Exception $e) {
            return response()->json(
                ["errors" => ["db" => ["データベースに接続出来ません"]]],
            400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $blog = Blog::find($id);
            if (is_null($blog)) {
                return response()->json(
                    ["errors" => ["id" => ["該当IDの記事が見つかりません"]]],
                400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
            } else {
                Blog::destroy($id);
            }
        } catch (Exception $e) {
            return response()->json(
                ["errors" => ["db" => ["データベースに接続出来ません"]]],
            400, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
}
