<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Comment;
use App\Article;


class CommentController extends Controller
{

    /**
     * Обработка формы - AJAX
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function store(Request $request)
    {

		$data = $request->except('_token', 'comment_article_ID', 'comment_parent');

		//добавляем поля с названиями как в таблице (модели)
		$data['article_id'] = $request->input('article_id');
		$data['parent_id'] = $request->input('comment_parent');
		
		//устанавливаем статус в зависимости от настройки
		$data['status'] = true;

		$user = Auth::user();

		if($user) {
			$data['user_id'] = $user->id;
		}

		$validator = Validator::make($data,[
			'article_id' => 'integer|required',
			'text' => 'required',
            'user_id' => 'required'
		]);

		$comment = new Comment($data); 

		if ($validator->fails()) {
			return response()->json(['error'=>$validator->errors()->all()]);
		}

		$article = Article::find($data['article_id']);
		$article->comments()->save($comment);

		$data['id'] = $comment->id;
		$data['avatar'] = $comment->user['avatar'];
		$data['name'] = $comment->user['name'];

		$view_comment = view(env('THEME').'.comments.new_comment')->with('data', $data)->render();

        return response()->json(['success'=>true, 'comment'=>$view_comment, 'data'=>$data]);
	}
}
