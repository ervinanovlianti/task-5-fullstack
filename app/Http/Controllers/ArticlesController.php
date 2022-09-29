<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        $data = Articles::paginate();
        return response([
            'success' => true,
            'message' => 'List All Article',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'required',
                'content'   => 'required',
                'category_id'   => 'required',
            ],
            [
                'title.required' => 'Masukkan Title Artikel !',
                'content.required' => 'Masukkan Content Artikel !',
            ]
        );

        if ($validator->fails()) {

            return response()->json($validator->errors(), 401);
        } else {

            //upload image
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('image'), $imageName);
            // $image->storeAs('public/image', $imageName);

            $data = Articles::create([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
                'image'   => $imageName,
                'user_id'   => auth()->id(),
                'category_id'   => $request->input('category_id')
            ]);

            if ($data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menyimpan Data!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Menyimpan Data!',
                ], 401);
            }
        }
    }

    public function show(Request $request, $id)
    {
        $data = Articles::whereId($id)->first();


        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Artikel!',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Artikel Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }

    public function update(Request $request, $id)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'title'     => 'required',
                'content'   => 'required',
                'category_id'   => 'required',
            ],
            [
                'title.required' => 'Masukkan Title Artikel !',
                'content.required' => 'Masukkan Content Artikel !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ], 401);
        } else {

            $data = Articles::whereId($id)->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
                'image'   => $request->input('image'),
                'category_id'   => $request->input('category_id')
            ]);

            if ($data) {
                return response()->json([
                    'success' => true,
                    'message' => 'Artikel Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Artikel Gagal Diupdate!',
                ], 401);
            }
        }
    }

    public function destroy($id)
    {
        $data = Articles::findOrFail($id)->delete();

        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Artikel Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Artikel Gagal Dihapus!',
            ], 400);
        }
    }
}
