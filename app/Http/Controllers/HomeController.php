<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home', ['articles' => Articles::all()]);
    }
    public function show_detail($id)
    {
        return view('detail', ['article' => Articles::find($id), 'users' => User::all(), 'categories' => Categories::all()]);
    }
    
    public function add()
    {
        return view('add', ['id' => Auth::id(), 'categories' => Categories::all()]);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $imageName = $image->hashName();
        $image->move(public_path('image'), $imageName);

        //create articles
        $articles = Articles::create([
            'image'     => $imageName,
            'title'     => $request->title,
            'content'   => $request->content,
            'user_id'   => $request->user_id,
            'category_id' => $request->category_id,
        ]);

        // return response
        // return new ArticlesResource(true, 'Data Articles Berhasil Ditambahkan!', $articles);
        return redirect('/home');
    }

    public function edit($id)
    {
        return view('update', ['article' => Articles::find($id), 'users' => User::all(), 'categories' => Categories::all()]);
    }

    public function update(Request $request, $id)
    {
        $articles = Articles::find($id);
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->move(public_path('image'), $image->hashName());

            //delete old image
            Storage::delete(public_path('image') . $articles->image);

            //update articles with new image
            $articles->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        } else {

            //update Articles without image
            $articles->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        return redirect('/home');
    }

    public function destroy($id)
    {
        $article = Articles::find($id);
        //delete image
        Storage::delete(public_path('image') . $article->image);

        $article->delete();

        return redirect('/home');
    }
}
